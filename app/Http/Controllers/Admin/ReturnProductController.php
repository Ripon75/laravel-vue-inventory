<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSizeStock;
use App\Models\ReturnProduct;

class ReturnProductController extends Controller
{
    public function returnProduct()
    {
        return view('admin.returnProduct.return');
    }

    public function returnProductSubmit(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer'],
            'date'       => ['required'],
            'items'      => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation error'
            ], 401);
        }

        //store return product stock
        foreach ($request->items as $item) {
            if ($item['quantity'] && $item['quantity'] > 0) {
                $itemObj             = new ReturnProduct();
                $itemObj->product_id = $request->product_id;
                $itemObj->date       = $request->date;
                $itemObj->quantity   = $item['quantity'];
                $itemObj->size_id    = $item['size_id'];
                $res = $itemObj->save();
                // Update product size stock
                if ($res) {
                    $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])->first();

                    // stock in
                    $psq->quantity = $psq->quantity + $item['quantity'];
                    $psq->save();
                }
            }
        }
        flash('Return product update successfully')->success();

        return response()->json([
            'success' => true,
            'message' => 'Return product successfully done.'
        ], 201);
    }

    public function history()
    {
        $returnProducts = ReturnProduct::orderBy('created_at', 'DESC')->get();

        return view('admin.returnProduct.history', [
            'returnProducts' => $returnProducts
        ]);
    }
}
