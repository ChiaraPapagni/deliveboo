<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $restaurants = Auth::user()
            ->restaurants()
            ->orderByDesc('id')
            ->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:restaurants', 'max:200'],
            'vat' => ['required', 'unique:restaurants', 'max:200'],
            'address' => ['required', 'unique:restaurants', 'max:200'],
            'restaurant_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
            'description' => ['nullable'],
            'website' => ['nullable', 'unique:restaurants', 'max:200'],
            'phone' => ['nullable', 'unique:restaurants', 'max:30'],
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->file('restaurant_image')) {
            $image_path = Storage::put(
                'restaurant_image',
                $request->file('restaurant_image')
            );
            $validated['restaurant_image'] = $image_path;
        }

        $validated['user_id'] = Auth::id();

        $restaurant = Restaurant::create($validated);

        if ($request->has('categories')) {
            $request->validate([
                'categories' => ['nullable', 'exists:categories,id'],
            ]);
            $restaurant->categories()->attach($request->categories);
        }

        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
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
            return view(
                'admin.restaurants.edit',
                compact('restaurant', 'categories')
            );
        } else {
            abort(403);
        }
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
            $validated = $request->validate([
                'name' => ['required', 'max:200'],
                'vat' => ['required', 'max:200'],
                'address' => ['required', 'max:200'],
                'restaurant_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
                'description' => ['nullable'],
                'website' => ['nullable', 'max:200'],
                'phone' => ['nullable', 'max:30'],
            ]);

            $validated['slug'] = Str::slug($request->name);

            if ($request->file('restaurant_image')) {
                //Elimino l'immagine caricata precedentemente
                Storage::delete($restaurant->restaurant_image);

                $img_path = Storage::put(
                    'restaurant_image',
                    $request->file('restaurant_image')
                );
                $validated['restaurant_image'] = $img_path;
            }

            $restaurant->update($validated);

            if ($request->has('categories')) {
                $request->validate([
                    'categories' => ['nullable', 'exists:categories,id'],
                ]);
                $restaurant->categories()->sync($request->categories);
            }

            return redirect()
                ->route('admin.restaurants.index')
                ->with('message', 'The restaurant has been correctly updated!');
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
            return redirect()
                ->route('admin.restaurants.index')
                ->with('message', 'The restaurant has been correctly removed!');
        } else {
            abort(403);
        }
    }
}