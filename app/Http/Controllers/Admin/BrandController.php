<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
         $brands = Brand::orderBy('created_at', 'desc')->get();

        return view('admin.brand.index', [
            'brands' => $brands
        ]);
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "unique:brands,name"]
        ]);

        $name = $request->input('name', null);

        $brandObj = new Brand();
        
        $brandObj->name = $name;
        $brandObj->slug = Str::slug($name, '-');
        $res = $brandObj->save();

        flash('Brand created successfully')->success();
        return redirect()->route('brands.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // if brand is not found return 404 error
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', "unique:brands,name, $id"]
        ]);

        $name = $request->input('name', null);

        $brand = brand::findOrFail($id);
        
        $brand->name = $name;
        $brand->slug = Str::slug($name, '-');
        $res = $brand->save();

        flash('brand updated successfully')->success();
        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        flash('brand deleted successfully')->success();
        return redirect()->route('brands.index');
    }

    public function getBrandJson()
    {
        $brands = Brand::get();

        return response()->json([
            'success' => true,
            'data'    => $brands
        ], 200);
    }
}
