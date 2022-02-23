<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SendMailToAdmin;
use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Braintree;
use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Braintree\Gateway;

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

        $cart_products = json_decode($request->input('cart'));

        //$cart_total = (json_decode($request->input('cart-total')));
        //$cart_total = $request->input('amount');
        //$cart_total = number_format($request->input('amount'), 2);
        $cart_total = (float) number_format($request->input('amount'), 2);
        //dd($request, $cart_products, $cart_total);

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'last_name' => ['required', 'min:3', 'max:200'],
            'phone' => ['required', 'min:9', 'max:30'],
            'email' => ['required', 'max:200'],
            'address' => ['required', 'min:3', 'max:200'],
            'notes' => ['nullable'],
            'amount' => ['required', 'numeric'],
            'status' => ['nullable'],
        ]);


        $order = Order::create($validated);


        //ddd($request->input('payload', false));

        //controllare se il pagamento è andato a buon fine e cambiare lo stato dell'ordine da false a true
        $order->status = true;
        $order->save();


        // $payload = $request->input('payload', false);
        //dd($payload);

        /* 
        //Email al cliente
        Mail::to($request->email)->send(new SendMail($order));

        //Email al ristoratore
        $id_restaurant = $cart_products[0]->restaurant_id;
        $restaurant = Restaurant::where('id', $id_restaurant)->get();
        $user = User::where('id', $restaurant[0]->user_id)->get();
       
        Mail::to($user[0]['email'])->send(new SendMailToAdmin($order)); */

        // creo i records nella tabella pivot
        for ($i = 0; $i < sizeof($cart_products); $i++) {
            $order->products()->attach([
                $cart_products[$i]->id => [
                    'quantity' => $cart_products[$i]->qty,
                    'restaurant_id' => $cart_products[$i]->restaurant_id,
                ],
            ]);
        }

        //$order->products()->attach([product.id => ['quantity' => numero.quantità], product.id => ['quantity' => numero.quantità]]);
        //Order::find(1)->products()->sync([1, 2, 3],);

        return view('guest.welcome');
    }
}
