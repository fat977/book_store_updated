<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    //
    public function sendEmail(Request $request){
        $token = $request->header('Authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $user->token = $token;
        $url = url('api/users/verify');
        Mail::to($user)->send(new EmailVerification($user,$url));
        return response()->json(
            [
                'message'=>"we send email verification link , check your inbox",
                'errors'=>(object)[],
                'data'=>(object)[],
            ],200);

    }

    public function verify(Request $request){
        $token = $request->header('Authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $now = date('Y-m-d H:i:s');
        $user->email_verified_at = $now;
        $user->save();
        $user->token = $token;
        return response()->json(
            [
                'message'=>"You could do actions now",
                'errors'=>(object)[],
                'data'=>(object)[],
            ],200);
    }
}
