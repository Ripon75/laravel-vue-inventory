<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductStock;
use App\Models\ProductSizeStock;

class StockController extends Controller
{
    public function stock()
    {
        return view('admin.stock.stock');
    }

    public function stockSubmit(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer'],
            'date'       => ['required'],
            'stock_type' => ['required'],
            'items'      => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation error'
            ], 401);
        }

        //store product stock
        foreach ($request->items as $item) {
            if ($item['quantity'] && $item['quantity'] > 0) {
                $itemObj             = new ProductStock();
                $itemObj->product_id = $request->product_id;
                $itemObj->date       = $request->date;
                $itemObj->status     = $request->stock_type;
                $itemObj->quantity   = $item['quantity'];
                $itemObj->size_id    = $item['size_id'];
                $res = $itemObj->save();
                // Update product size stock
                if ($res) {
                    $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])->first();
                    if ( $request->stock_type === 'in') {
                        // stock in
                        $psq->quantity = $psq->quantity + $item['quantity'];
                    }else {
                        // stock out
                        $psq->quantity = $psq->quantity - $item['quantity'];
                    }
                    $psq->save();
                }
            }
        }
        flash('Product update successfully')->success();

        return response()->json([
            'success' => true,
            'message' => 'Product create successfully done.'
        ], 201);
    }

    public function stockHistory()
    {
        $stocks = ProductStock::orderBy('created_at', 'DESC')->get();

        return view('admin.stock.history', [
            'stocks' => $stocks
        ]);
    }
}
