<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\ProductInBasket;
use App\Models\Basket;

class BasketController extends Controller
{
    public function view()
    {
        $items = [];
        $total = 0;

        if (Auth::check()) {
            $userId = Auth::id();

            $basket = DB::table('basket')
                ->where('id_user', $userId)
                ->first();

            if ($basket) {
                $productRows = DB::table('product_in_basket')
                    ->where('id_basket', $basket->id)
                    ->get();

                foreach ($productRows as $row) {
                    $product = Product::find($row->id_product);

                    if ($product) {
                        $subtotal = $product->price * $row->count;

                        $items[] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->images->first()
                                ? '/storage/' . ltrim($product->images->first()->path, '/')
                                : asset('img/placeholder.png'),
                            'count' => $row->count,
                            'subtotal' => $subtotal,
                        ];

                        $total += $subtotal;
                    }
                }
            }
        }

        return view('general.basket.user-basket', compact('items', 'total'));
    }

    public function updateQuantity(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $count = (int)$request->input('count');

        if (!$userId || !$productId) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $basket = DB::table('basket')->where('id_user', $userId)->first();
        if (!$basket) {
            return response()->json(['error' => 'Basket not found'], 404);
        }

        if ($count === 0) {
            DB::table('product_in_basket')
                ->where('id_basket', $basket->id)
                ->where('id_product', $productId)
                ->delete();

            return response()->json(['message' => 'Product removed']);
        } else {
            DB::table('product_in_basket')
                ->where('id_basket', $basket->id)
                ->where('id_product', $productId)
                ->update(['count' => $count]);

            return response()->json(['message' => 'Quantity updated']);
        }
    }

    
    public function add(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['guest' => true]);
        }

        // Найти корзину пользователя по user_id
        $basket = Basket::firstOrCreate(
            ['id_user' => $user->id],
            ['id_user' => $user->id]
        );

        // Найти товар в корзине
        $existing = ProductInBasket::where('id_basket', $basket->id)
                                ->where('id_product', $request->product_id)
                                ->first();

        if ($existing) {
            $existing->count += 1;
            $existing->save();
        } else {
            ProductInBasket::create([
                'id_basket' => $basket->id,
                'id_product' => $request->product_id,
                'count' => 1
            ]);
        }

        return response()->json(['success' => true]);
    }

    





}
