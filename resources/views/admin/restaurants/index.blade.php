{{-- WARNING! Temporary target="_blank" for testing! remember to remove it when building --}}

@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">

        {{-- Restaurant / Admin --}}

        <h1 class="pt-5 text-center text-capitalize">
            <span class="titleBox">i tuoi ristoranti</span>
        </h1>
        <div class="btnContain text-center pt-5 pb-3">
            <a class="btn btn-success mb-2" href="{{ route('admin.restaurants.create') }}" role="button">
                Create Restaurants
            </a>
        </div>


        {{-- Restaurant List --}}
        <div class="container p-3">
            <div class="row row-cols-2 justify-content-center g-5 m-3">
                @foreach ($restaurants as $restaurant)
                    <div class="col">
                        {{-- <div class="position-relative;"> --}}
                        <div class="card">
                            <div class="animationCard">
                                <div class="flip-card">
                                    <div class="flip-card__container">
                                        <div class="card-front">
                                            <div class="card-front__tp card-front__tp--city">
                                                <h2 class="card-front__heading px-2">
                                                    {{ $restaurant->name }}
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="card-back">
                                            <div class="video__container"
                                                style="
                                                                                                                                                                                                                        @if ($restaurant->restaurant_image != null) background-image: url('{{ asset('storage/' . $restaurant->restaurant_image) }}')
                                            @else
                                                background-image: url('/img/placeholder/placeholder_restaurant.jpg'); @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inside-page">
                                    <div class="inside-page__container">
                                        <h3 class="inside-page__heading inside-page__heading--city text-uppercase">
                                            {{ $restaurant->name }}
                                        </h3>
                                        <ul class="inside-page__text list-unstyled">
                                            <li>Indirizzo: {{ $restaurant->address }}</li>
                                            <li>Partita IVA: {{ $restaurant->vat }} </li>
                                        </ul>
                                        <div class="btns d-flex position-absolute actionRestaurantindex pb-2">

                                            <a class="btn btn-primary "
                                                href="{{ route('admin.restaurants.show', $restaurant->id) }}">
                                                Show
                                            </a>

                                            <a class="btn btn-warning mx-2"
                                                href="{{ route('admin.products.edit', $restaurant->id) }}">
                                                Edit
                                            </a>

                                            {{-- Button trigger modal --}}
                                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                                data-bs-target="#delete_restaurant_{{ $restaurant->id }}">
                                                Delete
                                            </button>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- </div> --}}
                        {{-- Modal --}}
                        <div class="modal fade" id="delete_restaurant_{{ $restaurant->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="modal_{{ $restaurant->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Elimina il Ristorante:
                                            {{ $restaurant->name }}
                                        </h5>
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
                                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}"
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
                @endforeach
            </div>
        </div>
    </div>
    </div>


    </div>
@endsection
