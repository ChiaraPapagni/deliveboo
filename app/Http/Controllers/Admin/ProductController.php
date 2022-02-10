<?php

//TODO - I need to make Auth validation for every user interactible function




namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // return view('admin.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('admin.products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ddd()$request->all());

        $validated = $request->validate(
            [
                'name' => ['required', 'unique:products', 'max:200'],
                'ingredients' => ['nullable'],
                'price' => ['required'],
                'product_image' => ['nullable'],
                'visible' => ['nullable'], //TODO Set Visible to Default value true
            ]
        );
        //RESTAURANT_ID
        $_product = Product::create($validated);

        //return redirect()->route('admin.products.index', $_products);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return view('admin.products.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        //ddd($product->restaurant()->name;

        /*

         $ristoranti

         $user

        $restaurants = Auth::user()->restaurants()->orderByDesc('id');

        $product->restaurant()->name;
        */


        // THIS
        // return view('admin.products.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'unique:products', 'max:200'],
                'ingredients' => ['nullable'],
                'price' => ['required'],
                'product_image' => ['nullable'],
                'visible' => ['nullable'], //TODO Set Visible to Default value true
            ]
        );

        $product->update($validated);

        //return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //TODO AUTH

        $product->delete();
        //return redirect()->back(); 
    }
}