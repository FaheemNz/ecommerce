<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class SaveForLaterController extends Controller
{
    public function store($id)
    {
        $wasStored = (new Cart('saveForLater'))->saveForLater($id);
        $message = $wasStored ? 'Item has been saved for later.' : 'Item already exists in the save for later list.';
        return redirect()->route('cart.index')->with('success_message', $message);
    }

    public function destroy($rowId)
    {
        (new Cart('saveForLater'))->remove($rowId);
        return redirect()->route('cart.index')->with('success_message', 'Item has been removed from save from later list.');
    }

    public function update(string $id)
    {
        (new Cart('default'))->moveBackToCart($id);
        return redirect()->route('cart.index')->with('success_message', 'Item has been moved back to the cart');
    }
}
