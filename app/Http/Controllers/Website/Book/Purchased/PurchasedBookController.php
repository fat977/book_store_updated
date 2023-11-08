<?php

namespace App\Http\Controllers\Website\Book\Purchased;

use App\Http\Controllers\Controller;
use App\Http\traits\calcDiscount;
use App\Models\Offer;
use App\Models\PurchasedBook;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchasedBookController extends Controller
{
    //
    public function books(){
        $books = PurchasedBook::query()->where('status',1)->with('author','offers')->paginate(3);
        return view('website.books.purchasable_books.books',compact('books'));
    }

    public function bookDetails($book_id){
        $book = PurchasedBook::query()->where('id',$book_id)->with(['category','author'])->first();
        //$disacountedBooks = DB::table('books_discounts')->get();
        
        //calculate rate avg
        $rating = Review::where('purchased_book_id',$book->id)->count();
        $rating_sum = Review::where('purchased_book_id',$book->id)->sum('value');

        if($rating > 0){
            $rating_avg = $rating_sum / $rating;
        }else{
            $rating_avg=0;
        }

        //get reviews
        $reviews = Review::where('purchased_book_id',$book->id)->get();

        //check if user rate this book or not
        if(Auth::check()){
            $user_rating =  Review::where('purchased_book_id',$book->id)->where('user_id',Auth::user()->id)->first();
        }else{
            $user_rating =  Review::where('purchased_book_id',$book->id)->first();
        }
         //similar books
        $similarBooks = PurchasedBook::with('author')->where('category_id', $book->category->id)
        ->where('id', '!=', $book_id)->get();
        return view('website.books.purchasable_books.details',
        compact('book','similarBooks','reviews','user_rating','rating_avg','rating'));
    }

    public function bookList(){
        $books = PurchasedBook::select('name')->where('status',1)->get();
        $data = [];
        foreach($books as $book){
            $data[]= $book['name'];

        }
        return $data;
    }

    public function search(Request $request){
        $search_book = $request->name;
        if($search_book != " "){
            $book = PurchasedBook::where("name","LIKE","%$search_book%")->first();

            if($book){
                return redirect('purchasable_books/details/'.$book['id']);
            }else{
                return redirect()->back()->with('error_message','no book matched your search');
            }
        }else{
            return redirect()->back();
        }
    }

    public function sort(Request $request){

        if($request->sort_by == 'book_oldest'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.id','Asc')->where('status',1)->paginate(3);  
        }
        if($request->sort_by == 'book_newest'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.id','Desc')->where('status',1)->paginate(3);  
        }
        if($request->sort_by == 'price_highest'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.price','Desc')->where('status',1)->paginate(3);  
        }
        if($request->sort_by == 'price_lowest'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.price','Asc')->where('status',1)->paginate(3);  
        }
        if($request->sort_by == 'name_a_z'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.name','Asc')->where('status',1)->paginate(3);  
        }
        if($request->sort_by == 'name_z_a'){
            $books= PurchasedBook::with('author')->orderBy('purchased_books.name','Desc')->where('status',1)->paginate(3);  
        }
        return view('website.books.purchasable_books.books',compact('books'));
    }

    public function bookOffer($offer_id){
        $offerBooks = PurchasedBook::join('books_discounts','purchased_books.id','books_discounts.id')
        ->where('books_discounts.offer_id',$offer_id)->paginate();

        //$offerBooks = DB::table('books_discounts')->where('offer_id',$offer_id)->paginate();
        return view('website.books.purchasable_books.offers.offered_books',compact('offerBooks'));
    }
}
