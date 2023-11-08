<?php

namespace App\Listeners;

use App\Events\WelcomeMessage;
use App\Mail\NewUserRegisteration;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeMessage $event): void
    {
        //
        $user = Auth::user();
        $url =  url('/');      
        //dd($user);
        Mail::to($user->email)->send(new NewUserRegisteration($event->user,$url));
    }
}
