<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        $userOrders = auth()->user()->orders()->with('products:products.id,products.name')->paginate();
        return view('profile.orders')->with('userOrders', $userOrders);
    }
}
