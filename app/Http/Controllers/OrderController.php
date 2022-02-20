<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Braintree_Transaction;

class OrderController extends Controller
{
    public function checkout()
    {

        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '88zhvyrjnfvrndyw',
            'publicKey' => '56g7zcjrywn646q9',
            'privateKey' => '831d7fd5cd83e327972f1b71275e7562',
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('guest.checkout.checkout', compact('token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {;
        $cart_products = (json_decode($request->input('cart')));
        $cart_total = (json_decode($request->input('cart-total')));
        dd($request, $cart_products, $cart_total);

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'last_name' => ['required', 'min:3', 'max:200'],
            'phone' => ['required', 'min:9', 'max:30'],
            'email' => ['required', 'max:200'],
            'address' => ['required', 'min:3', 'max:200'],
            'notes' => ['nullable'],
        ]);

        //$order = Order::create($validated);
        Order::find(1)->products()->sync([1, 2, 3],);
    }
}
