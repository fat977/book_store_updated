<?php
namespace App\Http\traits;

use App\Models\Offer;
use App\Models\Order;
use App\Models\PurchasedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

trait bookOrder{
    use calcPrice;
    public function addBookOrder(){
        $user_id =Auth::user()->id;
        $user = User::with('books_carts','addresses')->find($user_id);

        $startTime = date("Y-m-d");
        $delivered_at = date('Y-m-d',strtotime('+1 day',strtotime($startTime)));

        $order = new Order();
        $order->payment_method = Session::get('payment');
        $order->status = 0;
        $order->delivered_at= $delivered_at;
        $order->address_id=$user->addresses[0]->id;
        $order->total_price = $this->totalPrice();
        $order->save();

        foreach ($user->books_carts as $book){
            $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id);
            if($getDiscountPrice > 0){
           
                $price = $getDiscountPrice * $book->pivot->quantity;
            }else{
                $price = $book->price * $book->pivot->quantity;
            }
           
            DB::table('books_orders')->insert([
                'purchased_book_id'=>$book->id,
                'order_id'=>$order->id,
                'price'=>$price,
                'quantity'=>$book->pivot->quantity,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            
            $newQuantity = ($book->quantity) - ($book->pivot->quantity);
            //dd($newQuantity);
            PurchasedBook::query()->where('id',$book->id)->update(['quantity'=>$newQuantity]);
        }
    }
}