<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $orders = Order::with('products')
            ->where('user_id', $user->id)
            ->where('status', 'delivered')
            ->get();

        return view('general.profile.user-profile', compact('orders', 'user'));
    }
}
