<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(ProductFilter $filters)
    {
        $products = Product::filter($filters)->paginate();
        return view('shop', [
            'products' => $products
        ]);
    }

    public function show()
    {
        $product = Product::with('comments:id,body,rating,commentable_id,user_id,created_at')->where('id', 1)->first();
        $mightAlsoLikeProducts = $product->getFeaturedProducts();
        
        return view('product', [
            'product' => $product,
            'mightAlsoLikeProducts' => $mightAlsoLikeProducts,
        ]);
    }
}
