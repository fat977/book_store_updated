<?php

namespace App\Http\Controllers\Website\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $wishlists = Wishlist::query()->where('user_id',$user_id)->get();
            $user = User::with('books_wishlists')->find($user_id);
            //dd($user);
            return view('website.wishlists.index',compact('wishlists','user'));  
        }else{
            return view('auth.register');
        }
    }

    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $data = $request->except('_token');
            $book_id = $data['purchased_book_id'];
            $user_id =Auth::user()->id;
        
            //check if book is exist or not
            $existBook = Wishlist::query()->where(['user_id'=> $user_id , 'purchased_book_id'=>$book_id])->exists();
            if($existBook){
                flash()->addError('Book is already exists in wishlist');
                return redirect()->back();
            }

            Wishlist::create([
                'user_id'=>$user_id,
                'purchased_book_id'=>$book_id,
            ]);  
            flash()->addSuccess('Book is added to wishlist successfully');
            return redirect()->back();
        }else{
            return view('auth.register');
        }
    }

    public function deleteWishlistItem(Request $request){
        if(Auth::check()){
            $book_id = $request->book_id;
            if(Wishlist::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->exists()){
                Wishlist::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->delete();
                return response()->json(['status'=>'Book is deleted successfully']);
            }
        }else{
            flash()->addError('Login to continue');
            return redirect()->back();
        }   
    }

    public function wishlistCount(){
        $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishlistCount]);
    }
}
