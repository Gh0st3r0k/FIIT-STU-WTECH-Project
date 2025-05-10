<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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


}
