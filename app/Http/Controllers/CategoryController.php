<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('CreateCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('EditCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Category::find($id)->update([
            'name' => $request->name,
        ]);

        return redirect('/')->with('success', 'Category updated successfully.');
    }
    

    // Delete a category
    public function destroy($id)
    {
        Category::find($id)->delete();
        Category::destroy($id);
        return redirect('/')->with('success', 'Category deleted successfully.');
    }
}
