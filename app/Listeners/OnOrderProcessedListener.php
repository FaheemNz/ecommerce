<?php

namespace App\Listeners;

use App\Events\OnOrderProcessed;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class OnOrderProcessedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OnOrderProcessed  $event
     * @return void
     */
    public function handle(OnOrderProcessed $event)
    {   
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'billing_email' => $event->request->email,
            'billing_name' => $event->request->name,
            'billing_address' => $event->request->address,
            'billing_city' => $event->request->city,
            'billing_province' => $event->request->province,
            'billing_postalcode' => $event->request->postalcode,
            'billing_phone' => $event->request->phone,
            'billing_name_on_card' => $event->request->name_on_card,
            'billing_discount' => 200,
            'billing_discount_code' => 'ABC_DEF',
            'billing_subtotal' => Cart::subtotal(),
            'billing_tax' => Cart::tax(),
            'billing_total' => Cart::total(),
            'error' => $event->error,
        ]);
        
        // Prepare for bulk Insert & Update into order_product pivot table
        foreach(Cart::content() as $cartItem){
            $cartContent[] = ['order_id' => $order->id, 'product_id' => $cartItem->id, 'quantity' => $cartItem->qty];
            $product = Product::find($cartItem->id);
            $product->update(['quantity' => $product->quantity - $cartItem->qty]);
        }
        
        // Insert
        OrderProduct::insert($cartContent);
        
        // Send Email to the User
        //$order->sendOrderProcessedEmail();
    }
}
