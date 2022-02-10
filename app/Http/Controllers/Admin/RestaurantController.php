<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use League\CommonMark\Normalizer\SlugNormalizer;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Auth::user()->restaurants()->orderByDesc('id');
        // return view('admin.retaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        //return view('admin.restaurants.create', compact('categories'));
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
                'name' => ['required', 'unique:restaurants', 'max:200'],
                'vat' => ['required', 'unique:restaurants', 'max:200'],
                'address' => ['required', 'unique:restaurants', 'max:200'],
                'restaurant_image' => ['nullable'],
                'description' => ['nullable'],
                'website' => ['nullable', 'unique:restaurants', 'max:200'],
                'phone' => ['nullable', 'unique:restaurants', 'max:30'],
            ]
        );

        //TODO -> Storage things

        $validated['user_id'] = Auth::id();

        $_restaurant = Restaurant::create($validated);
        $_restaurant->categories()->attach($request->categories);

        //return redirect()->route('admin.restaurants.index', $_restaurant);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        // return view('admin.retaurants.show', compact('restaurant'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();

        if (Auth::id() === $restaurant->user_id) {
            // return view('admin.retaurants.edit', compact('restaurant', 'categories'));
        } else {
            abort(403);
        }

        // return view('admin.retaurants.edit', compact('restaurant', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        if (Auth::id() === $restaurant->user_id) {
            $validated = $request->validate(
                [
                    'name' => ['required', 'unique:restaurants', 'max:200'],
                    'vat' => ['required', 'unique:restaurants', 'max:200'],
                    'address' => ['required', 'unique:restaurants', 'max:200'],
                    'restaurant_image' => ['nullable'],
                    'description' => ['nullable'],
                    'website' => ['nullable', 'unique:restaurants', 'max:200'],
                    'phone' => ['nullable', 'unique:restaurants', 'max:30'],
                    'category_id' => ['nullable', 'exists:categories,id'],
                ]
            );

            //TODO -> Add Storage things

            $validated['user_id'] = Auth::id();

            $restaurant->update($validated);
            $restaurant->categories()->sync($request->category);

            //return redirect()->route('admin.restaurants.index');
            //TODO -> Sort what to do with MSG

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if (Auth::id() === $restaurant->user_id) {

            $restaurant->delete();
            //return redirect()->back(); 
            //TODO -> Sort what to do with MSG

        } else {
            abort(403);
        }
    }
}