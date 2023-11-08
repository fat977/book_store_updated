<?php

use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Author\AuthorController;
use App\Http\Controllers\Dashboard\Banner\BannerController;
use App\Http\Controllers\Dashboard\Book\Downloaded\DownloadableBookController;
use App\Http\Controllers\Dashboard\Book\Purchased\BookOffer\BookOfferController;
use App\Http\Controllers\Dashboard\Book\Purchased\Offer\OfferController;
use App\Http\Controllers\Dashboard\Book\Purchased\PurchasedBookController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\User\Address\CityController;
use App\Http\Controllers\Dashboard\User\Address\RegionController;
use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix'=>'dashboard','as'=>'admin.'],function(){
    
    Route::get('login-page',[LoginController::class,'loginPage'])->name('login.page');
    Route::post('login',[LoginController::class,'login'])->name('login');

    Route::get('forgot-password-page',[LoginController::class,'forgotPasswordPage'])->name('forgotPassword.page');
    Route::post('forgot-password',[LoginController::class,'forgotPassword'])->name('forgotPassword');

    Route::get('code-page',[LoginController::class,'codePage'])->name('code.page')->middleware('check-code');
    Route::post('code',[LoginController::class,'checkCode'])->name('checkCode');

    Route::get('reset-password-page',[LoginController::class,'resetPasswordPage'])->name('resetPassword.page')->middleware('check-code');
    Route::post('reset-password',[LoginController::class,'resetPassword'])->name('resetPassword');

    Route::group(['middleware'=>'auth:admin'],function(){
        Route::get('/',IndexController::class )->name('dashboard');
        Route::post('logout',[LoginController::class,'logout'])->name('logout');

        Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
            Route::get('/',[ProfileController::class,'index'])->name('index');
            Route::post('update-personal-data/{id}',[ProfileController::class,'updatePersonalData'])->name('updatePersonalData');
            Route::post('update-password/{id}',[ProfileController::class,'updatePassword'])->name('updatePassword');
        });

        Route::group(['prefix'=>'book'],function(){
            Route::resource('purchased_books',PurchasedBookController::class);
            Route::resource('downloadable_books',DownloadableBookController::class);

            Route::resource('offers',OfferController::class);

            Route::group(['prefix'=>'offer','as'=>'offer.'],function(){
                Route::get('create/{id}',[BookOfferController::class,'createOffer'])->name('create');
                Route::post('store/{id}',[BookOfferController::class,'storeOffer'])->name('store');
                Route::get('edit/{purchased_book_id}/{offer_id}',[BookOfferController::class,'editOffer'])->name('edit');
                Route::post('update/{purchased_book_id}/{offer_id}',[BookOfferController::class,'updateOffer'])->name('update');
                Route::post('delete/{purchased_book_id}/{offer_id}',[BookOfferController::class,'deleteOffer'])->name('delete');
            });
        });

        Route::resource('banners',BannerController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('authors',AuthorController::class);
  
        Route::resource('admins',AdminController::class);
        Route::get('MarkAsRead_all',[AdminController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

        Route::resource('users',UserController::class);
        Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/delete_permanently/{id}', [UserController::class, 'deletePermanently'])->name('user.deletePermanently');
        Route::resource('cities',CityController::class);
        Route::resource('regions',RegionController::class);
    });

    Route::group(['prefix'=>'orders','as'=>'orders.'],function(){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::get('view/{id}',[OrderController::class,'viewOrder'])->name('view');
        Route::post('update-orders/{id}',[OrderController::class,'updateOrder'])->name('update');
        //Route::get('MarkAsRead_all',[OrderController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

    });
});

