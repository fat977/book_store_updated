<?php

namespace App\Http\Controllers\Website\OrderProcess;

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

class CheckoutController extends Controller
{
    //
    use calcPrice , bookOrder;
    //
    public function checkout(){

        if(Auth::check()){
            $user_id =Auth::user()->id;
            $carts = Cart::query()->where('user_id',$user_id)->get();
            $user = User::with('books_carts')->find($user_id);
            return view('website.orders.checkout.index',compact('carts','user'));  
        }else{
            return view('auth.register');
        }
       
    }

    public function placeOrder(Request $request){
        if($request->payment_method == 'PayPal'){
            $request->session()->put('payment','PayPal');
            return view('website.orders.paypal.index');
        }else{
            $request->session()->put('payment','COD');
        }

        $user_id =Auth::user()->id;
        $user = User::with('books_carts','addresses')->find($user_id);
        if(empty($user->addresses[0]->id) || empty($user->phone)){
            return redirect()->route('profile.edit');
        }
    
        $this->addBookOrder();

        Cart::query()->where('user_id',$user_id)->delete();
        Event::dispatch(new NewOrderEvent($user));
     
        flash()->addSuccess('Ordered is placed successfully');
        return redirect()->route('order.history');
    }

    public function history(){
        if(Auth::check()){
            $address_id =Auth::user()->addresses[0]->id;
            $orders = Order::query()->where('address_id',$address_id)->get();
            return view('website.orders.history',compact('orders'));
        }else{
            return view('auth.register');
        }
        
    }

    public function orderDetails($id){
        $order = Order::with('address','books')->where('id',$id)->first();
        return view('website.orders.details',compact('order'));
    }
}
