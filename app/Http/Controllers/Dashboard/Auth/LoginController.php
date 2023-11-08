<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\CheckCodeRequest;
use App\Http\Requests\Dashboard\Auth\ForgotPasswordRequest;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Http\Requests\Dashboard\Auth\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //
    public function loginPage(){
        if(Auth::guard('admin')->user()){
            return redirect()->back();
        }else{
            return view('dashboard.auth.login');
        }
   
    }

    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect('dashboard');
        }else{
            flash()->addError('Wrong Attempt !');
            return redirect()->back();
        }
    }

    public function forgotPasswordPage(){
        return view('dashboard.auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request){
      
        $admin = Admin::where('email',$request->email)->first();
        $code = rand(10000,99999);
        session(['admin' => $admin , 'code'=>$code]);
        $admin->code= $code;
        $admin->code_expired_at = Carbon::now()->addMinutes(10);
        $admin->save();
        Mail::to($admin)->send(new ResetPassword($admin));
        flash()->addSuccess('We have emailed your code to reset password.');
        return redirect()->route('admin.code.page');
    }

    public function codePage(){
        return view('dashboard.auth.code');
    }

    public function checkCode(CheckCodeRequest $request){

        if($request->session()->has('admin')){
            $admin = $request->session()->get('admin');
           
        }
        $now = Carbon::now();
        if($admin->code == $request->code && $admin->code_expired_at > $now){
            return redirect()->route('admin.resetPassword.page');
        }else{
            flash()->addError('code is invalid');
            return redirect()->back();
        }
    }


    public function resetPasswordPage(Request $request){
        
        if($request->session()->has('code')){
            return view('dashboard.auth.reset-password');
        }else{
            return redirect()->route('admin.code.page');
        }
    }

    public function resetPassword(ResetPasswordRequest $request){
        if($request->session()->has('admin')){
            $admin = $request->session()->get('admin'); 
        }
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.login.page');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('dashboard/login-page');
    }
}
