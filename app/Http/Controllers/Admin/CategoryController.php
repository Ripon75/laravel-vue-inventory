<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "unique:categories,name"]
        ]);

        $name = $request->input('name', null);

        $categoryObj = new Category();
        
        $categoryObj->name = $name;
        $categoryObj->slug = Str::slug($name, '-');
        $res = $categoryObj->save();

        flash('Category created successfully')->success();
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // if category is not found return 404 error
        $category = Category::findOrFail($id);

        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', "unique:categories,name, $id"]
        ]);

        $name = $request->input('name', null);

        $category = Category::findOrFail($id);
        
        $category->name = $name;
        $category->slug = Str::slug($name, '-');
        $res = $category->save();

        flash('Category updated successfully')->success();
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = category::findOrFail($id);
        $category->delete();

        flash('Category deleted successfully')->success();
        return redirect()->route('categories.index');
    }

    public function getCategoryJson()
    {
        $categories = Category::get();

        return response()->json([
            'success' => true,
            'data'    => $categories
        ], 200);
    }
}
