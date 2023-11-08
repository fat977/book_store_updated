<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DownloadableBook;
use App\Models\Offer;
use App\Models\PurchasedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        //
        $downloadable_books = DownloadableBook::query()->where('status',1)->get();
        $purchasable_books = PurchasedBook::query()->where('status',1)->get();
        $trendyBooks = PurchasedBook::with('author')->join('trendy_books','purchased_books.id','trendy_books.purchased_book_id')
        ->where('trendy_books.book_count','>',3)->get();
        $offers = Offer::all();
        foreach($offers as $offer){
            if($offer->end_at < Date('Y-m-d H:i:s')){
                Offer::query()->where('end_at','<', Date('Y-m-d H:i:s'))->delete();    
            }
        }
        return view('website.index',compact('trendyBooks','downloadable_books','purchasable_books','offers'));
    }
}
