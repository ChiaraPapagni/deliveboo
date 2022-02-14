{{-- WARNING! Temporary target="_blank" for testing! remember to remove it when building --}}


@extends('layouts.admin')


@section('content')
    <div class="container mt-5">

        {{-- Restaurant Card --}}
        <div class="myCard pt-5 d-flex justify-content-center">
            <div class="card mt-5" style="width: 35rem;">
                <img src=" {{ asset('storage/' . $restaurant->restaurant_image) }}" class="card-img-top"
                    alt="{{ $restaurant->name }}">
                <div class="card-body">
                    <h5 class="card-title">Restaurant: ID:{{ $restaurant->id }} -> {{ $restaurant->name }} </h5>
                    <p class="card-text">{{ $restaurant->description }}</p>

                    {{-- Contacts --}}
                    <div class="contacts">
                        <a href="#" target="_blank" class="btn btn-primary">{{ $restaurant->website }}</a>
                        <div class="mt-2">
                            {{ $restaurant->phone }}
                        </div>

                        {{-- Category badges --}}
                        <div class="badges mt-2">
                            <p>
                                @forelse($restaurant->categories as $category)
                                    <span class="badge bg-info">
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    <span>Nessuna Categoria</span>
                                @endforelse
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Menu and create new product --}}
        <div class="d-flex align-items-center">
            <h4 class="me-3">Menu</h4>
            <a class="btn btn-success" href="{{ route('admin.product.create', ['restaurant' => $restaurant->id]) }}"
                role="button">
                Aggiungi un piatto
            </a>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Ingredients</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($restaurant->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->ingredients }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <div class="btns d-flex">

                                <a class="btn btn-warning me-2" href="{{ route('admin.products.edit', $product->id) }}">
                                    Edit
                                </a>

                                {{-- Button trigger modal --}}
                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#delete_product_{{ $product->id }}">
                                    Delete
                                </button>

                                {{-- Modal --}}
                                <div class="modal fade" id="delete_product_{{ $product->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modal_{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete product: {{ $product->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to proceed?
                                                This operation is irreversible!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white"
                                                        data-bs-dismiss="modal">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a class="btn btn-secondary mb-5" href="{{ route('admin.restaurants.index') }}" role="button">
            Back
        </a>

        {{-- NEW card products --}}
        @foreach ($restaurant->products as $product)
            <div class="card mb-5">

                <div class="row">

                    <div class="image col-4">
                        <img class="w-100 p-1" style="object-fit:cover" height=" 150"
                            src="{{ asset('storage/' . $product->product_image) }}">
                    </div>


                    <div class="col-6">
                        <h5 class="card-title ">Product Name: {{ $product->name }}</h5>
                        <p class="card-text ">Price: €{{ $product->price }}</p>
                        <p class="card-text ">{{ $product->ingredients }}</p>
                    </div>


                    <div class="btns col-2 d-flex flex-column justify-content-around pe-4">

                        <a class="btn btn-warning" href="{{ route('admin.products.edit', $product->id) }}">
                            Edit
                        </a>

                        {{-- Button trigger modal --}}
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#delete_product_{{ $product->id }}">
                            Delete
                        </button>

                        {{-- Modal --}}
                        <div class="modal fade" id="delete_product_{{ $product->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal_{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete product: {{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to proceed?
                                        This operation is irreversible!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white"
                                                data-bs-dismiss="modal">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>




                </div>

            </div>
        @endforeach



        {{-- 🡣 This is Chiara's previous code, if she needs it 🡣 --}}

        {{-- <h1 class="pt-5">Restaurant: {{ $restaurant->name }}</h1>

        <h2>ID: {{ $restaurant->id }}</h2>
        <h3>{{ $restaurant->name }}</h3>
        <h5>{{ $restaurant->website }} - {{ $restaurant->phone }}</h5>
        <p>{{ $restaurant->description }}</p>
        <p>
            @forelse($restaurant->categories as $category)
                {{ $category->name }}
            @empty
                <span>Nessuna Categoria</span>
            @endforelse
        </p>

        <h4>Menu</h4>
        <a href="{{ route('admin.product.create', ['restaurant' => $restaurant->id]) }}" role="button">
            Aggiungi un piatto
        </a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Ingredients</th>
                    <th>Price</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($restaurant->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->ingredients }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.restaurants.index') }}" role="button">
            Back
        </a> --}}
    </div>
@endsection
