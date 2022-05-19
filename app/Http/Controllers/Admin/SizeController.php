<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::orderBy('created_at', 'desc')->get();

        return view('admin.size.index', [
            'sizes' => $sizes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
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
            'size' => ['required', "unique:sizes,size"]
        ]);

        $size = $request->input('size', null);

        $sizeObj = new Size();
        
        $sizeObj->size = $size;
        $res = $sizeObj->save();

        flash('Size created successfully')->success();
        return redirect()->route('sizes.index');
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
        // if size is not found return 404 error
        $size = Size::findOrFail($id);

        return view('admin.size.edit', [
            'size' => $size
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
            'size' => ['required', "unique:sizes,size, $id"]
        ]);

        $name = $request->input('size', null);

        $size = Size::findOrFail($id);
        
        $size->size = $name;
        $res = $size->save();

        flash('Size updated successfully')->success();
        return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        flash('Size deleted successfully')->success();
        return redirect()->route('sizes.index');
    }
}
