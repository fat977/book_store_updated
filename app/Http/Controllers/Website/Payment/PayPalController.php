<?php

namespace App\Http\Controllers\Website\Payment;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\traits\bookOrder;
use App\Http\traits\calcPrice;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PurchasedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    //
    use bookOrder ,calcPrice;
    public function createTransaction()
    {
        return view('website.orders.paypal.index');
    }

    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" =>  $this->totalPrice()
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrongs.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        //dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $startTime = date("Y-m-d");
            $delivered_at = date('Y-m-d',strtotime('+1 day',strtotime($startTime)));
    
            $user_id =Auth::user()->id;
            $user = User::with('books_carts','addresses')->find($user_id);
            if(empty($user->addresses[0]->id)){
                return redirect()->route('profile.edit');
            }
            //dd($user);
            $this->addBookOrder();
            Cart::query()->where('user_id',$user_id)->delete();
            Event::dispatch(new NewOrderEvent($user));

            return redirect()
                ->route('payment.success')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function success(){
        return view('website.orders.paypal.success');
    }
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


}
