<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = (new Product)->getRandomProducts(12);
        return view('shop', compact('products'));
    }

    public function show(Product $product)
    {
        $mightAlsoLikeProducts = (new Product)->getRandomProducts(4, ['slug', '!=', $product->slug]);
        return view('product', [
            'product' => $product,
            'mightAlsoLikeProducts' => $mightAlsoLikeProducts
        ]);
    }
}
