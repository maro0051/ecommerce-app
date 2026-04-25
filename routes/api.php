<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', function (Request $request) {
    $query = Product::query();
    
    if ($request->has('search') && $request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
    
    if ($request->has('min_price') && $request->min_price) {
        $query->where('price', '>=', $request->min_price);
    }
    
    if ($request->has('max_price') && $request->max_price) {
        $query->where('price', '<=', $request->max_price);
    }
    
    $products = $query->paginate($request->per_page ?? 15);
    
    return response()->json([
        'success' => true,
        'data' => $products
    ]);
});

Route::get('/products/{product}', function (Product $product) {
    return response()->json([
        'success' => true,
        'data' => $product
    ]);
});