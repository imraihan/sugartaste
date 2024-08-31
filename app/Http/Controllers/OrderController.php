<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'color'=> '',
            'size'=> ''
        ]);

        // Create a new order (or update an existing one)
        $order = ProductOrder::create([
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total' => $validated['total'],
            'color' => $validated['color'],
            'size' => $validated['size'],
            // Add any other fields needed for the order
        ]);

        // Return a response
        return response()->json(['success' => true, 'order' => $order]);
    }
}
