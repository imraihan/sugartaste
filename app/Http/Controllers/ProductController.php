<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        // Eager load all the necessary relationships
        $products = Product::with(['productBenefit', 'productMoreDetails', 'productDetails', 'productImages'])->get();
        
        return view('product.show', compact('products'));
    }
}
