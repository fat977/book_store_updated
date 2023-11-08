<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Download;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $orders = Order::query()->where('status',0)->count();
        $users = User::query()->where('email_verified_at','!=',null)->count();
        $downloads = Download::count();
        $categories = Category::count();
        return view('dashboard.index',compact('orders','users','downloads','categories'));
    }
}
