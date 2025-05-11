<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function updateStatus(Request $request, Order $order)
    {
        $order->status = 'delivered';
        $order->save();

        return response()->json(['message' => 'Status updated']);
    }

    public function index()
    {
        $orders = Order::with(['products'])->where('status', 'processing')->get();
        return view('general.basket.admin-basket', compact('orders'));
    }
}
