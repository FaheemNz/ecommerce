<?php

namespace App\Http\Controllers;

use App\Events\OnOrderProcessed;
use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(CheckoutRequest $checkoutRequest)
    {   
        try {
            $charges = Stripe::charges()->create([
                'amount' => Cart::total() / 100,
                'currency' => 'USD',
                'source' => $checkoutRequest['stripeToken'],
                'description' => 'Order',
                'receipt_email' => $checkoutRequest['email'],
                'metadata' => [
                    //'contents' => '',
                    //'quantity' => Cart::instance('default')->count()
                ]
            ]);

            event(new OnOrderProcessed($checkoutRequest, null));

            return redirect('thankyou')->with('success_message', 'Payment Recieved!');
        } catch (CardErrorException $e) {
            event(new OnOrderProcessed($checkoutRequest, $e->getMessage()));
            
            return redirect()->back()->withErrors($e->getMessage());
        } finally {
            Cart::instance('default')->destroy();
        }
    }
}
