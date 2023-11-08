<?php

namespace App\Http\Controllers\Dashboard\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        if ($request->has('history')) {
            $orders = Order::query()->where('status',1)->get();
        }else{
            $orders = Order::query()->where('status',0)->orderByDesc('id')->get();
        }
        return view('dashboard.orders.index',compact('orders'));
    }

    public function viewOrder($id){
        $order = Order::with('address','books')->where('id',$id)->first();
/*         $admin_id =Auth::guard('admin')->user()->id;
        $getNotificationId = DB::table('notifications')->where('data->id',$id)->where('notifiable_id',$admin_id)->pluck('id');
        //dd($getNotificationId);
        DB::table('notifications')->where('id',$getNotificationId)->update([
            'read_at'=>now()
        ]); */
        return view('dashboard.orders.view-order',compact('order'/* ,'getNotificationId' */));
    }

    public function updateOrder(Request $request,$id){
        Order::query()->where('id',$id)->update(['status'=> $request->input('status')]);
        flash()->addSuccess('Order is updated successfully');
        return redirect()->route('admin.orders.index');
    }

 /*    public function MarkAsRead_all(){
        $userUnReadNotifications = Auth::guard('admin')->user()->unreadNotifications;
        if($userUnReadNotifications){
            $userUnReadNotifications->markAsRead();
            return redirect()->back();
        }
    } */
}
