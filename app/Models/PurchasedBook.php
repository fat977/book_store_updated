<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PurchasedBook extends Model
{
    use HasFactory ,HasTranslations;
    protected $guarded = [];
    public $translatable = ['name','desc','publisher'];
    protected $touches = ['offers'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public static function book_categories(){
        $bookCategories = PurchasedBook::with('category')->get();
        //dd( $bookCategories);
        return $bookCategories;
    }
    public function author(){
        return $this->belongsTo(Author::class,'author_id');
    }

    public function offers(){
        return $this->belongsToMany(Offer::class,'books_offers')->withPivot('price')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class,'carts')->withPivot('quantity')->withTimestamps();
    }

    public function user_reviews(){
        return $this->belongsToMany(User::class,'reviews')->withPivot('value','review','created_at')->withTimestamps();
    }

    public static function getDiscountPrice($book_id){
        $book = PurchasedBook::with('offers')->where('id',$book_id)->first();
        //dd($book);
        foreach($book->offers as $offer){
            if($offer->discount > 0){
                return $price_after_discount = $book->price - (($offer->discount * $book->price) / 100);
            }else{
                return $price_after_discount =0;
            }
        }
    }
}
