<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('CreateProduct', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/product_images', $filename);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'photo' => $filename,
            'category_id' => $request->category_id,
        ]);

        return redirect('/')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('EditProduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/product_images', $filename);
        
        Product::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'photo' => $filename,
            'category_id' => $request->category_id,
        ]);

        return redirect('/home')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->photo) {
            Storage::delete('public/product_images/' . $product->photo);
        }
        $product->delete();

        return redirect('/')->with('success', 'Product deleted successfully.');
    }
}
