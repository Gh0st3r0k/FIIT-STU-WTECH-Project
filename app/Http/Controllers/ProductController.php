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

        $products = Product::with('images')
            ->orderBy($sort, $direction)
            ->paginate(12)
            ->withQueryString();


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

        Storage::disk('public')->delete($image->path);

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


    public function userShow($id)
    {
        $product = Product::with('images')->findOrFail($id);

        $products = Product::with('images')->where('id', '!=', $id)->latest()->take(4)->get();

        return view('general.product_card.user-product_card', compact('product', 'products'));
    }

    public function catalog(Request $request)
    {
        $query = Product::query();

        // Поиск по имени
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        // Фильтрация по цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Категории (типы)
        if ($request->has('type')) {
            $query->whereIn('category_type', $request->input('type'));
        }

        // Новизна (последние 5 дней)
        if ($request->boolean('is_new')) {
            $query->where('created_at', '>=', \Carbon\Carbon::now()->subDays(5));
        }

        // Сортировка
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        // Пагинация + сохранение параметров фильтрации
        $products = $query->orderBy($sort, $direction)
            ->paginate(12)
            ->withQueryString();

        // Категории и рекомендации
        $categories = \App\Models\CategoryType::all();
        $recommended = Product::inRandomOrder()->take(4)->get();

        return view('general.catalog.user-catalog', compact('products', 'categories', 'recommended'));
    }


    public function adminCatalog(Request $request)
    {
        $query = Product::with('images');

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

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

        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        $products = $query->orderBy($sort, $direction)
            ->paginate(12)
            ->withQueryString();

        $categories = CategoryType::all();

        return view('general.catalog.admin-catalog', compact('products', 'categories'));
    }

    public function main(Request $request)
    {
        $query = Product::with('images');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'ILIKE', "%{$search}%");
        }

        if ($request->has('sort') && in_array($request->sort, ['price', 'created_at'])) {
            $direction = $request->direction === 'asc' ? 'asc' : 'desc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);

        return view('general.main_page.main', compact('products'));
    }





}



