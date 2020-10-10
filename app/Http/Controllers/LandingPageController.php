<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = (new Product)->getFeaturedProducts(8);
        return view('welcome', compact('products'));
    }
}
