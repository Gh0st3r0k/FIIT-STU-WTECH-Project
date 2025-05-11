<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use App\Models\CategoryType;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'asc');

        $products = Product::with('images')->orderBy($sort, $direction)->get();

        return view('general.catalog.products', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'] ?? '',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.catalog')->with('success', 'Product added successfully.');
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.product.show', $product->id)->with('success', 'Product updated!');
    }

    public function uploadImage(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }


    public function deleteImage($productId, $imageId)
    {
        $image = ProductImage::where('product_id', $productId)->where('id', $imageId)->firstOrFail();

        // Удаляем файл из storage
        Storage::disk('public')->delete($image->path);

        // Удаляем из базы
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
    public function adminShow($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('general.product_card.admin-product_card', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $product->delete();

        return redirect('/admin/catalog')->with('success', 'Product deleted successfully.');
    }

    // public function adminIndex()
    // {
    //     $products = Product::with('images')->orderBy('created_at', 'desc')->get();
    //     return view('general.catalog.admin-catalog', compact('products'));
    // }

    public function userShow($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Дополнительно загружаем несколько других товаров для блока "You may like"
        $products = Product::with('images')->where('id', '!=', $id)->latest()->take(4)->get();

        return view('general.product_card.user-product_card', compact('product', 'products'));
    }

    public function catalog(Request $request)
    {
        $query = Product::query();

        // Цена
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Тип (категория)
        if ($request->has('type')) {
            $query->whereIn('category_type', $request->input('type'));
        }

        // Новизна (5 дней)
        if ($request->boolean('is_new')) {
            $query->where('created_at', '>=', \Carbon\Carbon::now()->subDays(5));
        }

        $products = $query->get();
        $categories = \App\Models\CategoryType::all();

        // return view('user-catalog', compact('products', 'categories'));
        return view('general.catalog.user-catalog', compact('products', 'categories'));

    }

    public function adminCatalog(Request $request)
    {
        $query = Product::with('images');

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->has('type')) {
            $query->whereIn('category_type', $request->input('type'));
        }

        if ($request->boolean('is_new')) {
            $query->where('created_at', '>=', Carbon::now()->subDays(5));
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $categories = CategoryType::all();

        return view('general.catalog.admin-catalog', compact('products', 'categories'));
    }



}



