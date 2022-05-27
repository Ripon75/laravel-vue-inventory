<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands     = Brand::orderBy('name', 'asc')->get();
        $sizes      = Size::get();
        
        return view('admin.product.create', [
            'categories' => $categories,
            'brands'     => $brands,
            'sizes'      => $sizes
        ]);
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
