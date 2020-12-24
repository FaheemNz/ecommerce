<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    public function store()
    {
        $coupon = Coupon::where('code', request()->input('coupon_code'))->first();

        if (!$coupon) return redirect()->back()->withErrors('Invalid coupon code.');

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
        ]);
        
        return redirect()->back()->with('success_message', 'Coupon Applied successfully!');
    }

    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success_message', 'Coupon removed!');
    }
}
