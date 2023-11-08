<?php

use App\Http\Controllers\API\Auth\EmailVerificationController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Book\Purchased\PurchasedBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'users'],function(){
    Route::post('register',RegisterController::class);
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::post('send-email',[EmailVerificationController::class,'sendEmail']);
        Route::post('verify',[EmailVerificationController::class,'verify']);
    });
    Route::post('login',[LoginController::class,'login']);
    Route::delete('logout',[LoginController::class,'logout']);
    Route::delete('logout-all-devices',[LoginController::class,'logoutAllDevices']);
});

//Route::group(['middleware'=>'auth:admin'],function(){
    Route::group(['prefix'=>'book'],function(){
        Route::resource('purchased_books',PurchasedBookController::class);
    });
//});
