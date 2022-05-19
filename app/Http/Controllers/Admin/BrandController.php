<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $brands = Brand::orderBy('created_at', 'desc')->get();

        return view('admin.brand.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if brand is not found return 404 error
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        flash('brand deleted successfully')->success();
        return redirect()->route('brands.index');
    }
}
