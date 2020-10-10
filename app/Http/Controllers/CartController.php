<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as StoreCart;
use Illuminate\Contracts\Cache\Store;

class CartController extends Controller
{
    public function index()
    {
        $mightAlsoLikeProducts = (new Product)->getFeaturedProducts(4);
        return view('cart', compact('mightAlsoLikeProducts'));
    }

    public function store(Product $product)
    {
        $cart = new Cart;

        if ($cart->itemAlreadyExists($product->id)) {
            return response()->json(['message' => 'Item already exists in the cart'], 200);
        }

        $cart->add($product);
        return response()->json(['message' => 'Item has been added in the cart', 'newCount' => StoreCart::count()], 201);
    }

    public function destroy(string $rowId)
    {
        (new Cart)->remove($rowId);
        return back()->with('success_message', 'Item has been removed.');
    }

    public function update(string $rowId)
    {
        $updatedCart = (new Cart)->updateCart($rowId, request()->input('quantity'));

        if ($updatedCart) {
            return response()->json(
                [
                    'qty' => StoreCart::count(),
                    'total' => presentPrice(StoreCart::total()),
                    'subtotal' => presentPrice(StoreCart::subTotal()),
                    'tax' => presentPrice(StoreCart::tax())
                ],
                202
            );
        }
    }
}
