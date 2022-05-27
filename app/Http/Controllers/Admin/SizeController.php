<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{

    public function index()
    {
        $sizes = Size::orderBy('created_at', 'desc')->get();

        return view('admin.size.index', [
            'sizes' => $sizes
        ]);
    }

    public function create()
    {
        return view('admin.size.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => ['required', "unique:sizes,size"]
        ]);

        $size = $request->input('size', null);

        $sizeObj = new Size();
        
        $sizeObj->size = $size;
        $res = $sizeObj->save();

        flash('Size created successfully')->success();
        return redirect()->route('sizes.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // if size is not found return 404 error
        $size = Size::findOrFail($id);

        return view('admin.size.edit', [
            'size' => $size
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => ['required', "unique:sizes,size, $id"]
        ]);

        $name = $request->input('size', null);

        $size = Size::findOrFail($id);
        
        $size->size = $name;
        $res = $size->save();

        flash('Size updated successfully')->success();
        return redirect()->route('sizes.index');
    }


    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        flash('Size deleted successfully')->success();
        return redirect()->route('sizes.index');
    }

    public function getSizeJson()
    {
        $sizes = Size::get();

        return response()->json([
            'success' => true,
            'data'    => $sizes
        ], 200);
    }
}
