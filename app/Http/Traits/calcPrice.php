<?php
namespace App\Http\traits;

use App\Models\PurchasedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait calcPrice{
    public function totalPrice(){
        $user_id =Auth::user()->id;
        $user = User::with('books_carts','addresses')->find($user_id);

        $total_price =0;
        foreach ($user->books_carts as $book){
            $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id);
            if($getDiscountPrice > 0){
           
                $total_price += $getDiscountPrice * $book->pivot->quantity;
            }else{
                $total_price += $book->price * $book->pivot->quantity;
            }
        }
        return $total_price+= $user->addresses[0]->region->city->shipping;    
    }
    
}