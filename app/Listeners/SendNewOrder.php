<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Mail\NewOrder;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendNewOrder
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
    public function handle(NewOrderEvent $event): void
    {
        //
        $user = Auth::user();
        $order = Order::with('books')->where('address_id',$user->addresses[0]->id)
        ->where('status',0)->latest()->first();
        //dd($order);
        Mail::to($user->email)->send(new NewOrder($event->user,$order));
    }
}
