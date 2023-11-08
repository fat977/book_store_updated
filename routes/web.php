<?php

use App\Http\Controllers\Website\Book\Downloaded\DownloadableBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\Book\Purchased\PurchasedBookController;
use App\Http\Controllers\Website\Book\Purchased\ReviewController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\OrderProcess\CartController;
use App\Http\Controllers\Website\OrderProcess\CheckoutController;
use App\Http\Controllers\Website\Payment\PayPalController;
use App\Http\Controllers\Website\Wishlist\WishlistController;
use App\Models\DownloadableBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/',IndexController::class)->name('website');

Route::group(['prefix'=>'purchasable_books','as'=>'purchase.'],function(){
    Route::get('/',[PurchasedBookController::class,'books'])->name('books');
    Route::get('/details/{book_id}',[PurchasedBookController::class,'bookDetails'])->name('book.details');
    // search
    Route::get('purchased-list',[PurchasedBookController::class,'bookList']);
    Route::post('search-purchased',[PurchasedBookController::class,'search'])->name('search');
    // sort
    Route::get('/sort-by',[PurchasedBookController::class,'sort']);

    //get books which have offers
    Route::get('books_with_offer/{offer_id}',[PurchasedBookController::class,'bookOffer'])->name('offer');
});

Route::group(['prefix'=>'downloadable_books','as'=>'download.'],function(){
    Route::get('/',[DownloadableBookController::class,'books'])->name('books');
    Route::get('/details/{book_id}',[DownloadableBookController::class,'bookDetails'])->name('book.details');
    Route::group(['middleware'=>['check-auth','check-authorize']],function(){
        //likes
        Route::post('book-like',[DownloadableBookController::class,'like']);
        //dislikes
        Route::post('book-dislike',[DownloadableBookController::class,'dislike']);
        //downloads
        Route::get('/download/{file}', [DownloadableBookController::class, 'download'])->name('file');
        Route::post('/add-to-download', [DownloadableBookController::class,'addToDownload']);
    });
    // search
    Route::get('downloadable-list',[DownloadableBookController::class,'bookList']);
    Route::post('search-downloadable',[DownloadableBookController::class,'search'])->name('search');
    // sort
    Route::get('/sort-by',[DownloadableBookController::class,'sort']);
});

/* Route::get('/session', function (Request $request) {
    if($request->session()->has('payment'))
           echo $request->session()->get('payment');
        else
           echo 'No data in the session';

})->name('dashboard'); */

Route::middleware('check-auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// error
Route::get('/error', function () {
    return view('website.pages.error');
});

Route::group(['middleware'=>['check-auth','check-authorize']],function(){
    Route::resource('carts',CartController::class);
    Route::post('delete-cart-item', [CartController::class,'deleteCartItem']);
    Route::get('store-directly/{book_id}',[CartController::class,'storeDirectly'])->name('carts.store_directly');
    Route::get('load-cart-count', [CartController::class,'cartCount'])->name('carts.count');
    Route::post('update-cart-item', [CartController::class,'updateCartItem']);
});

//checkout
Route::group(['prefix'=>'orders','as'=>'order.','middleware'=>['check-authorize','check-auth']],function(){
    Route::get('checkout',[CheckoutController::class,'checkout'])->name('checkout');
    Route::post('place-order',[CheckoutController::class,'placeOrder'])->name('placeOrder');
    Route::get('history',[CheckoutController::class,'history'])->name('history');
    Route::get('details/{id}',[CheckoutController::class,'orderDetails'])->name('details');
});

Route::group(['prefix'=>'reviews','as'=>'review.','middleware'=>['check-authorize','check-auth']],function(){
    Route::post('store-review',[ReviewController::class,'storeReview'])->name('store');
    Route::get('edit-review/{id}',[ReviewController::class,'editReview'])->name('edit');
    Route::post('update-review',[ReviewController::class,'updateReview'])->name('update');
    Route::post('delete-review',[ReviewController::class,'deleteReview'])->name('delete');
});

//PayPal
Route::group(['middleware'=>['check-authorize','check-auth']],function(){
    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
    Route::get('payment-success',[PayPalController::class,'success'])->name('payment.success');
});

//wishlist
Route::group(['prefix'=>'wishlists','as'=>'wishlists.','middleware'=>'check-authorize','check-auth'],function(){
    Route::get('index',[WishlistController::class,'index'])->name('index');
    Route::post('store',[WishlistController::class,'store'])->name('store');
    Route::post('delete-wishlist-item', [WishlistController::class,'deleteWishlistItem']);
    Route::get('load-wishlist-count', [WishlistController::class,'wishlistCount'])->name('count');
});

require __DIR__.'/auth.php';
