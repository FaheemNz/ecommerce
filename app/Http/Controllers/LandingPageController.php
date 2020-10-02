<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = (new Product)->getRandomProducts(8);
        return view('welcome', compact('products'));
    }
}
