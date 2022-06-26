<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            $item             = new ProductStock();
            $item->product_id = $request->product_id;
            $item->date       = $request->date;
            $item->status     = $request->stock_type;
            $item->quantity   = $item->quantity;
            $item->size_id    = $item->size_id;
            $item->save();
        }
    }
}
