<?php

namespace App\Http\Controllers\Dashboard\Book\Purchased\BookOffer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Book\Offer\BookOfferRequest;
use App\Http\traits\calcDiscount;
use App\Models\Offer;
use App\Models\PurchasedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookOfferController extends Controller
{
    //
    public function createOffer($id){
        $book = PurchasedBook::findOrFail($id);
        $offers = Offer::all();
        return view('dashboard.books.purchased_books.books_offers.create',compact('book','offers'));
    }

    public function storeOffer(BookOfferRequest $request,$id){
        $data = $request->validated();
        $data['created_at']=date('Y-m-d H:i:s');
        //$data['price'] = $this->priceAfterDiscount($id);
        DB::table('books_offers')->insert($data);
        flash()->addSuccess('Book Offer is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.purchased_books.index');
        } 
    }

    public function editOffer($purchased_book_id,$offer_id){
        $data = DB::table('books_offers')->where(['purchased_book_id'=>$purchased_book_id,'offer_id'=>$offer_id])->first();
        $offers = Offer::all();
        return view('dashboard.books.purchased_books.books_offers.edit',compact('data','offers'));
    }

    public function updateOffer(BookOfferRequest $request,$purchased_book_id,$offer_id){
        $data = $request->validated();
        
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('books_offers')->where(['purchased_book_id'=>$purchased_book_id,'offer_id'=>$offer_id])->update($data);
        flash()->addSuccess('Book Offer is updated successfully');
        return redirect()->back();
       
    }

    public function deleteOffer($purchased_book_id,$offer_id){
        DB::table('books_offers')->where(['purchased_book_id'=>$purchased_book_id,'offer_id'=>$offer_id])->delete();;
        
        flash()->addSuccess('Book Offer is deleted successfully');
        return redirect()->back();
    }
}
