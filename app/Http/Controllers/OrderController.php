<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    {
        //
    }
}