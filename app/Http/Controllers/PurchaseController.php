<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost_per_unit' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::find($request->product_id);

        // Calculate the total cost and total quantity before the new purchase
        $totalCostBefore = $product->quantity * $product->price;
        $totalQuantityBefore = $product->quantity;

        // Calculate the total cost and total quantity after the new purchase
        $totalCostAfter = $totalCostBefore + ($request->quantity * $request->cost_per_unit);
        $totalQuantityAfter = $totalQuantityBefore + $request->quantity;

        // Calculate the new average cost
        $newAverageCost = $totalQuantityAfter > 0 ? $totalCostAfter / $totalQuantityAfter : 0;

        // Update the product's quantity and average cost
        $product->quantity = $totalQuantityAfter;
        $product->price = $newAverageCost;
        $product->save();

        // Create the purchase record
        $purchase = Purchase::create($request->all());

        return response()->json($purchase, 201);
    }

    public function index()
    {
        $purchases = Purchase::all();

        return response()->json($purchases);
    }
}
