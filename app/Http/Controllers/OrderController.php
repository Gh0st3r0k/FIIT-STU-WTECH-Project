<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserNonRegistration;
use App\Models\Order;
use App\Models\ProductInOrder;
use App\Models\ProductInBasket;
use App\Models\Basket;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function auth(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'delivery_method' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $user = auth()->user();
        if (!$user) return response()->json(['message' => 'Unauthorized'], 401);

        $order = Order::create([
            'user_id' => $user->id,
            'non_user_id' => null,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'status' => 'processing',
            'delivery_method' => $data['delivery_method'],
            'payment_method' => $data['payment_method'],
            'created_at' => now()
        ]);

        $basketId = Basket::where('id_user', $user->id)->value('id');
        $items = ProductInBasket::where('id_basket', $basketId)->get();

        foreach ($items as $item) {
            ProductInOrder::create([
                'order_id' => $order->id,
                'product_id' => $item->id_product,
                'count' => $item->count
            ]);
        }


        if ($user) {
            $basketId = \DB::table('basket')
                ->where('id_user', $user->id)
                ->value('id');
        
            if ($basketId) {
                ProductInBasket::where('id_basket', $basketId)->delete();
            }
        }
        

        return response()->json(['message' => 'Order placed successfully (auth).']);
    }

    public function guest(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'delivery_method' => 'required|string',
            'payment_method' => 'required|string',
            'basket' => 'required|array',
        ]);

        $nonUser = UserNonRegistration::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
        ]);

        $order = Order::create([
            'user_id' => null,
            'non_user_id' => $nonUser->id,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'status' => 'processing',
            'delivery_method' => $data['delivery_method'],
            'payment_method' => $data['payment_method'],
            'created_at' => now()
        ]);

        foreach ($data['basket'] as $item) {
            ProductInOrder::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'count' => $item['count']
            ]);
        }

        return response()->json(['message' => 'Order placed successfully (guest).']);
    }
}
