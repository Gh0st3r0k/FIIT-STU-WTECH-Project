<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BasketController extends Controller
{
    public function add(Request $request)
    {
        $email = session('user.email');
        if (!$email) {
            return response()->json(['error' => 'User not logged in'], 403);
        }

        $productId = $request->input('product_id');

        $basket = [];
        $path = 'basket.json';

        if (Storage::exists($path)) {
            $json = Storage::get($path);
            $basket = json_decode($json, true);
        }

        if (!isset($basket[$email])) {
            $basket[$email] = [];
        }

        // Проверка: есть ли товар
        $found = false;
        foreach ($basket[$email] as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $basket[$email][] = [
                'product_id' => $productId,
                'quantity' => 1
            ];
        }

        Storage::put($path, json_encode($basket, JSON_PRETTY_PRINT));

        return response()->json(['success' => true]);
    }




    public function view()
{
    $email = session('user.email');
    if (!$email) {
        return redirect('/user/login')->with('error', 'Not logged in');
    }

    $basketPath = 'basket.json';
    $productPath = public_path('data/products.json');

    $basket = Storage::exists($basketPath)
        ? json_decode(Storage::get($basketPath), true)
        : [];

    $products = file_exists($productPath)
        ? json_decode(file_get_contents($productPath), true)
        : [];

    $userBasket = $basket[$email] ?? [];

    // Собираем товары
    $items = [];
    $total = 0;

    foreach ($userBasket as $entry) {
        $product = collect($products)->firstWhere('id', $entry['product_id']);
        if ($product) {
            $qty = $entry['quantity'];
            $subtotal = $product['price'] * $qty;
            $total += $subtotal;

            $items[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }

    return view('general.basket.user-basket', [
        'items' => $items,
        'total' => $total
    ]);
}

}


