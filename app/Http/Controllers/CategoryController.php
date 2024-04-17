<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,

        ]);

        return redirect('/dashboard/category')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $category = Category::find($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect('/dashboard/category')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
