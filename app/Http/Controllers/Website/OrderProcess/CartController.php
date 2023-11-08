<?php

namespace App\Http\Controllers\Website\OrderProcess;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\PurchasedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $carts = Cart::query()->where('user_id',$user_id)->get();
            $user = User::with('books_carts','addresses')->find($user_id);
          
            return view('website.orders.cart.index',compact('carts','user'));  
        }else{
            return view('auth.register');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $user = User::with('books_carts','addresses')->find($user_id);
            if(empty($user->addresses[0]->id) || empty($user->phone)){
                return redirect()->route('profile.edit');
            }
            $data = $request->except('_token');
            $book_id = $data['purchased_book_id'];
            $user_id =Auth::user()->id;
        
            //check if book is exist or not
            $existBook = Cart::query()->where(['user_id'=> $user_id , 'purchased_book_id'=>$book_id])->exists();
            if($existBook){
                flash()->addError('Book is already exists in cart');
                return redirect()->back();
            }

             // check quantity
             $bookQuantity = PurchasedBook::query()->where('id',$book_id)->select('quantity')->first();
             if( $bookQuantity->quantity < $request->quantity){
                 flash()->addError('This quantity not available');
                 return redirect()->back();
             }else{
                Cart::create([
                    'user_id'=>$user_id,
                    'purchased_book_id'=>$book_id,
                    'quantity'=> $request->quantity
                ]);  
            }
            flash()->addSuccess('Book is added to cart successfully');
            return redirect()->back();
        }else{
            return view('auth.register');
        }
    }

    public function storeDirectly(Request $request,$book_id)
    {
        //
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $user = User::with('books_carts','addresses')->find($user_id);
            if(empty($user->addresses[0]->id) || empty($user->phone)){
                return redirect()->route('profile.edit');
            }
            // check quantity
            $bookQuantity = PurchasedBook::query()->where('id',$book_id)->select('quantity')->first();
            if( $bookQuantity->quantity < 1){
                flash()->addError('This quantity not available');
                return redirect()->back();
            }
            //check if book is exist or not
            $existBook = Cart::query()->where(['user_id'=> $user_id , 'purchased_book_id'=>$book_id])->exists();
            if($existBook){
                flash()->addError('Book is already exists in cart');
                return redirect()->back();
            }
            Cart::create([
                'user_id'=>$user_id,
                'purchased_book_id'=>$book_id,
                'quantity'=> 1
            ]);  
            flash()->addSuccess('Book is added to cart successfully');
            return redirect()->back();
        }else{
            return view('auth.register');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteCartItem(Request $request){
        if(Auth::check()){
            $book_id = $request->book_id;
            if(Cart::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->exists()){
                Cart::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->delete();
                return response()->json(['status'=>'Book is deleted successfully']);
            }
        }else{
            flash()->addError('Login to continue');
            return redirect()->back();
        }   
    }

    public function cartCount(){
   
        $cartCount = Cart::where('user_id',Auth::id())->sum('quantity');
        return response()->json(['count'=>$cartCount]);
        
    }

    public function updateCartItem(Request $request){
        if($request->ajax()){

            $book_id = $request->book_id;
            $book_qty = $request->book_qty;
            $purchasedBook = PurchasedBook::query()->where('id',$book_id)->first();
            if(Auth::check()){
                if(Cart::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)->exists()){
                    if($purchasedBook->quantity >= $book_qty){
                        Cart::where('purchased_book_id',$book_id)->where('user_id',Auth::user()->id)
                        ->update(['quantity'=>$book_qty]);
                        return response()->json(['status'=>'Book quantity is updated successfully']);
                    }else{
                        flash()->addError('Quantity not available');
                        return redirect()->back();
                    }
                }
            }else{
                flash()->addError('Login to continue');
                return redirect()->back();
            }
        }

    }
}
