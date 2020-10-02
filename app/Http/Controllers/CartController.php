<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as StoreCart;

class CartController extends Controller
{
    public function index()
    {
        $mightAlsoLikeProducts = (new Product)->getRandomProducts(4);
        return view('cart', compact('mightAlsoLikeProducts'));
    }

    public function store(Product $product)
    {
        $cart = new Cart;

        if ($cart->itemAlreadyExists($product->id)) {
            return redirect()->route('cart.index')
                ->with('success_message', 'Item is already added in the cart!');
        }

        $cart->add($product);
        return redirect()->route('cart.index')->with('success_message', 'Item added to the cart');
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
