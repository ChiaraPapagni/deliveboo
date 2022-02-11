<?php

//TODO - I need to make Auth validation for every user interactible function

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\User;

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
    public function create($restaurant_id)    
    {
        
        return view('admin.products.create', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $restaurants = Restaurant::all();

        $validated = $request->validate([
            'name' => ['required', 'unique:products', 'max:200'],
            'ingredients' => ['nullable'],
            'price' => ['required', 'numeric', 'min:0'],
            'product_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
            'visible' => ['boolean'],
            'restaurant_id' => 'exists:restaurants,id',
        ]);
    
        
        if ($request->file('product_image')) {
            $image_path = Storage::put(
                'product_image',
                $request->file('product_image')
            );
            $validated['product_image'] = $image_path;
            
        }

        foreach($restaurants as $restaurant){
                
            if(Auth::id() === $restaurant -> user_id && $validated['restaurant_id']  == $restaurant->id){

                $product = Product::create($validated);
                return redirect()->route('admin.restaurants.index', $product)->with('message', 'Prodotto creato con successo');
            }
            
        }

        abort(403);  
       
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
        $validated = $request->validate([
            'name' => ['required', 'unique:products', 'max:200'],
            'ingredients' => ['nullable'],
            'price' => ['required'],
            'product_image' => ['nullable'],
            'visible' => ['nullable'], //TODO Set Visible to Default value true
        ]);

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
        $product->delete();
        return redirect()
            ->back()
            ->with('message', 'The dish has been correctly removed!');
    }
}