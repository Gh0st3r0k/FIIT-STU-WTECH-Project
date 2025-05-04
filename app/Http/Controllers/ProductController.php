<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at'); // например: name, price
        $direction = $request->get('direction', 'asc'); // asc или desc

        $products = Product::orderBy($sort, $direction)->get();

        return view('general.catalog.products', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.catalog')->with('success', 'Product added successfully');

    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return redirect()->route('admin.product.show', $product->id)->with('success', 'Product updated!');
    }



    public function uploadImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
            $product->save();
        }

        return back();
    }

    public function deleteImage($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
            $product->image = null;
            $product->save();
        }

        return back();
    }

    public function adminShow($id)
    {
        $product = Product::findOrFail($id);
        return view('general.product_card.admin-product_card', compact('product'));
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/catalog')->with('success', 'Product deleted successfully.');
    }


    public function adminIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('general.catalog.admin-catalog', compact('products'));
    }

}