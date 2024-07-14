<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'sale_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::find($request->product_id);

        // Check if the product quantity is enough
        if ($product->quantity < $request->quantity) {
            return response()->json(['error' => 'Insufficient product quantity'], 400);
        }

        // Determine the cost per unit
        $totalCost = 0;
        $totalQuantity = 0;
        foreach ($product->purchases as $purchase) {
            $totalCost += $purchase->quantity * $purchase->cost_per_unit;
            $totalQuantity += $purchase->quantity;
        }
        $costPerUnit = $totalQuantity > 0 ? $totalCost / $totalQuantity : $product->price;

        // Update the product's quantity
        $product->quantity -= $request->quantity;
        $product->save();

        // Create the sale record
        $sale = Sale::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'sale_price' => $request->sale_price,
            'cost_per_unit' => $costPerUnit,
            'transaction_date' => $request->transaction_date,
        ]);

        return response()->json($sale, 201);
    }

    public function index()
    {
        $sales = Sale::with('product')->get();

        return response()->json($sales);
    }
}
