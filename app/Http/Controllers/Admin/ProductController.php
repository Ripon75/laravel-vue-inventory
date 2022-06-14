<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductSizeStock;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Size;
use Auth;

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
        $validator = Validator::make($request->all(), [
            'category_id'  => ['required', 'integer'],
            'brand_id'     => ['required', 'integer'],
            'name'         => ['required'],
            'sku'          => ['required', "unique:products"],
            'image'        => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg'],
            'cost_price'   => ['required'],
            'retail_price' => ['required'],
            'year'         => ['required'],
            'status'       => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation error'
            ], 401);
        }

        $categoryId  = $request->input('category_id', null);
        $brandId     = $request->input('brand_id', null);
        $name        = $request->input('name', null);
        $sku         = $request->input('sku', null);
        $costPrice   = $request->input('cost_price', 0);
        $retailPrice = $request->input('retail_price', 0);
        $year        = $request->input('year', null);
        $status      = $request->input('status', null);
        $description = $request->input('description', null);


        $productObj = new Product();

        $productObj->user_id      = Auth::id();
        $productObj->category_id  = $categoryId;
        $productObj->brand_id     = $brandId;
        $productObj->name         = $name;
        $productObj->sku          = $sku;
        $productObj->cost_price   = $costPrice;
        $productObj->retail_price = $retailPrice;
        $productObj->year         = $year;
        $productObj->status       = $status;
        $productObj->description  = $description;
        // For image
        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext  = $file->getClientOriginalExtension();
            $name = Str::random(5) . '.' . $ext;
            $file->storeAs('public/images/products', $name);
            $productObj->image = $name;
        }

        $res = $productObj->save();

        // Store product size stock
        $items = $request->items;
        if ($items) {
            foreach(json_decode($items) as $item) {
                $sizeStockObj             = new ProductSizeStock();
                $sizeStockObj->product_id = $productObj->id;
                $sizeStockObj->size_id    = $item->size_id;
                $sizeStockObj->location   = $item->location;
                $sizeStockObj->quantity   = $item->quantity;
                $sizeStockObj->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product create successfully done.'
        ], 201);
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
