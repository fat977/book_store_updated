<?php

namespace App\Http\Controllers\Website\Book\Purchased;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PurchasedBook;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function storeReview(Request $request)
    {
        //
        if(Auth::check()){
            $data = $request->except('_token');
            $book_id = $data['book_id'];
            $user_id =Auth::user()->id;

            if(empty(Auth::user()->addresses[0]->id)){
                return redirect()->route('profile.edit');
            }else{
                $verified_purchase = Order::where('orders.address_id',Auth::user()->addresses[0]->id)->
                join('books_orders','orders.id','books_orders.order_id')
                ->where('books_orders.purchased_book_id',$book_id)->first();
    
                if($verified_purchase){
                    $existing_review = Review::where('user_id',$user_id)->where('purchased_book_id',$book_id)->first();
                    $book = PurchasedBook::query()->where('id', $book_id)->first();
    
                    if($existing_review){
                        return view('website.books.purchasable_books.reviews.edit-review',compact('existing_review','book'));
                    }else{
                        Review::create([
                            'user_id'=>$user_id,
                            'purchased_book_id'=>$book_id,
                            'review'=> $data['review'],
                            'value'=> $data['book_rating']
                        ]); 
                    } 
                }else{
                    flash()->addError('You can not rate this product without purchase !');
                    return redirect()->back();
                }
                flash()->addSuccess('Review is added successfully');
                return redirect()->back();
            }
           
        }else{
            return view('auth.register');
        }
    }

    public function editReview($id)
    {
        $book = PurchasedBook::where('id',$id)->where('status',1)->first();
        if($book){
            $book_id =$book->id;
            $existing_review = Review::where('user_id',Auth::user()->id)->where('purchased_book_id',$book_id)->first();
            //dd($review);
            if($existing_review){
                return view('website.books.purchasable_books.reviews.edit-review',compact('existing_review','book'));
            }
        }
    }

    public function updateReview(Request $request){
        $user_review = $request->input('review');
        $stars = $request->input('value');
        $book_id = $request->input('book_id');
        if($user_review != ''){
            Review::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->update([
                'review'=> $user_review,
                'value' => $stars
            ]);
            flash()->addSuccess('Review is updated successfully');
            return redirect()->back();
        }else{
            flash()->addError('You can not submit an empty review');
            return redirect()->back();
        }
    }

    public function deleteReview(Request $request)
    {
        //
        if(Auth::check()){
            $book_id = $request->input('book_id');
            if(Review::where('purchased_book_id',$book_id)->where('user_id',Auth::id())->exists()){
                Review::where('purchased_book_id',$book_id)->where('user_id',Auth::id())->delete();
                flash()->addSuccess('Review is deleted successfully');
                return redirect()->back();
            }
        }
    }
}
