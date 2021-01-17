<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as StoreCart;

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
        if($product->quantity == 0){
            return response()->json(['message' => 'Item not available'], 200);
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
        $newQuantity = request()->input('quantity');
        $totalQuantity = request()->input('totalQuantity');

        if ($newQuantity > $totalQuantity) {
            return response()->json(['error' => 'Product quantity cant be updated! Check inStock status.'], 400);
        }

        $cartUpdated = (new Cart)->updateCart($rowId, $newQuantity);

        if ($cartUpdated) {
            return response()->json([
                'qty' => StoreCart::count(),
                'total' => presentPrice(StoreCart::total()),
                'subtotal' => presentPrice(StoreCart::subTotal()),
                'tax' => presentPrice(StoreCart::tax())
            ], 202);
        }
    }
}
