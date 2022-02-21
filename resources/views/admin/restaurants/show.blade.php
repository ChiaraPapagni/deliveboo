@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- Restaurant Card --}}
        <div class="myCard pt-2 d-flex justify-content-center">
            <div class="card mt-5" style="width: 35rem;">

                @if ($restaurant->restaurant_image === null)
                    <img src="{{ url('/img/placeholder/placeholder_restaurant.jpg') }}" alt="placeholder_restaurant"
                        class="card-img-top">
                @else
                    <img src=" {{ asset('storage/' . $restaurant->restaurant_image) }}" class="card-img-top"
                        alt="{{ $restaurant->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">Restaurant: ID:{{ $restaurant->id }} -> {{ $restaurant->name }} </h5>
                    <p class="card-text">{{ $restaurant->description }}</p>

                    {{-- Contacts --}}
                    <div class="contacts">

                        @if ($restaurant->website)
                            <a href="{{ $restaurant->website }}" target="_blank"
                                class="btn btn-primary">{{ $restaurant->website }}</a>
                        @else
                            <span>Nessun sito web</span>
                        @endif

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
        <div class="d-flex align-items-center mb-4 mt-4 justify-content-between">
            <h4 class="me-3">Menu</h4>
            <a class="btn btn-success " href="{{ route('admin.product.create', ['restaurant' => $restaurant->id]) }}"
                role="button">
                Aggiungi un piatto
            </a>
        </div>

        {{-- NEW card products --}}
        @foreach ($restaurant->products as $product)
            <div class="card mb-5">

                <div class="row">

                    <div class="image col-4">
                        @if ($restaurant->restaurant_image === null)
                            <img src="{{ url('/img/placeholder/placeholder_product.jpg') }}" style="object-fit:cover"
                                height="150" alt="product placeholder">
                        @else
                            <img class="w-100 p-1" style="object-fit:cover" height=" 150"
                                src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                        @endif
                    </div>


                    <div class="col-6">
                        <h5 class="card-title ">Nome del prodotto: {{ $product->name }}</h5>
                        <p class="card-text ">Pezzo: €{{ $product->price }}</p>
                        <p class="card-text ">{{ $product->ingredients }}</p>
                        <p class="card-text ">Visibilità: {{ $product->visible === 1 ? 'Yes' : 'No' }}
                        </p>
                    </div>


                    <div class="btns col-2 d-flex flex-column justify-content-around pe-4">

                        <a class="btn btn-warning" href="{{ route('admin.products.edit', $product->id) }}">
                            Modifica
                        </a>

                        {{-- Button trigger modal --}}
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#delete_product_{{ $product->id }}">
                            Elimina
                        </button>

                        {{-- Modal --}}
                        <div class="modal fade" id="delete_product_{{ $product->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal_{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Elimina prodotto: {{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Sei sicuro di procedere?<br>
                                        Stai eliminando il prodotto per sempre!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">CHIUDI</button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white"
                                                data-bs-dismiss="modal">ELIMINA</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <a class="btn btn-secondary mb-5" href="{{ route('admin.restaurants.index') }}" role="button">
            Torna indietro
        </a>
    </div>
@endsection
