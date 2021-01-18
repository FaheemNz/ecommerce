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

    public function show(Product $product)
    {
        $product = $product->load('comments:id,body,rating,commentable_id,user_id,created_at');
        $mightAlsoLikeProducts = $product->getFeaturedProducts();

        return view('product', [
            'product' => $product,
            'mightAlsoLikeProducts' => $mightAlsoLikeProducts,
            'stockLevel' => $this->getStockLevel($product)
        ]);
    }

    protected function getStockLevel(Product $product)
    {
        $threshold = setting('site.stock_threshold');
        
        if ($product->quantity > $threshold) {
            $stockLevel = '<span class="badge badge-success">In Stock</span>';
        } else if($product->quantity <= $threshold && $product->quantity > 0){
            $stockLevel = '<span class="badge badge-warning">Low Stock</span>';
        } else {
            $stockLevel = '<span class="badge badge-danger">Not Available</span>';    
        }
        
        return $stockLevel;
    }
}
