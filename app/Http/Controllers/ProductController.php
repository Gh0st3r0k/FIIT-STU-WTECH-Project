<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductImage;

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

    // public function uploadImage(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('products', 'public');
    //         ProductImage::create([
    //             'product_id' => $product->id,
    //             'path' => $path,
    //         ]);
    //     }

    //     return back();
    // }
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

    public function adminIndex()
    {
        $products = Product::with('images')->orderBy('created_at', 'desc')->get();
        return view('general.catalog.admin-catalog', compact('products'));
    }
}



// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Product;

// class ProductController extends Controller
// {
//     public function index(Request $request)
//     {
//         $sort = $request->get('sort', 'created_at'); // например: name, price
//         $direction = $request->get('direction', 'asc'); // asc или desc

//         $products = Product::orderBy($sort, $direction)->get();

//         return view('general.catalog.products', compact('products'));
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'description' => 'nullable|string',
//             'image' => 'nullable|image|max:2048',
//         ]);

//         if ($request->hasFile('image')) {
//             $path = $request->file('image')->store('products', 'public');
//             $data['image'] = $path;
//         }

//         Product::create($data);

//         return redirect()->route('admin.catalog')->with('success', 'Product added successfully');

//     }

//     public function update(Request $request, $id)
//     {
//         $product = Product::findOrFail($id);

//         $product->name = $request->input('name');
//         $product->price = $request->input('price');
//         $product->description = $request->input('description');

//         $product->save();

//         return redirect()->route('admin.product.show', $product->id)->with('success', 'Product updated!');
//     }



//     public function uploadImage(Request $request, $id)
//     {
//         $product = Product::findOrFail($id);

//         if ($request->hasFile('image')) {
//             $path = $request->file('image')->store('products', 'public');
//             $product->image = $path;
//             $product->save();
//         }

//         return back();
//     }

//     public function deleteImage($id)
//     {
//         $product = Product::findOrFail($id);

//         if ($product->image) {
//             Storage::disk('public')->delete($product->image);
//             $product->image = null;
//             $product->save();
//         }

//         return back();
//     }

//     public function adminShow($id)
//     {
//         $product = Product::findOrFail($id);
//         return view('general.product_card.admin-product_card', compact('product'));
//     }


//     public function destroy($id)
//     {
//         $product = Product::findOrFail($id);
//         $product->delete();

//         return redirect('/admin/catalog')->with('success', 'Product deleted successfully.');
//     }


//     public function adminIndex()
//     {
//         $products = Product::orderBy('created_at', 'desc')->get();
//         return view('general.catalog.admin-catalog', compact('products'));
//     }

// } -->