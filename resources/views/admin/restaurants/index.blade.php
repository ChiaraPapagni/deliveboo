{{-- WARNING! Temporary target="_blank" for testing! remember to remove it when building --}}

@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboardJumbo">


        <div class="container dashboardJumbo pt-5">

            {{-- Restaurant / Admin --}}
            <div class="pt-5 pb-4">
                <h1 class="pt-2 text-center text-capitalize">
                    <span class="titleBox">i tuoi ristoranti</span>
                </h1>
            </div>

            <a class="btn btn-success mb-2" href="{{ route('admin.restaurants.create') }}" role="button">
                Create Restaurants
            </a>
            {{-- Restaurant List --}}

            <div class="row">
                @foreach ($restaurants as $restaurant)
                    <div class="card mb-5">

                        <div class="row align-items-center">

                            <div class="image col-4">
                                <img class="w-100 p-1" style="object-fit:cover" height=" 150"
                                    src="{{ asset('storage/' . $restaurant->restaurant_image) }}">
                            </div>


                            <div class="col-6">
                                <h5 class="card-title ">Restaurant Name: {{ $restaurant->name }}</h5>
                            </div>


                            <div class="btns col-2 d-flex flex-column justify-content-around pe-4">

                                <a class="btn btn-primary " href="{{ route('admin.restaurants.show', $restaurant->id) }}">
                                    Show
                                </a>

                                <a class="btn btn-warning my-2"
                                    href="{{ route('admin.products.edit', $restaurant->id) }}">
                                    Edit
                                </a>

                                {{-- Button trigger modal --}}
                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#delete_restaurant_{{ $restaurant->id }}">
                                    Delete
                                </button>

                                {{-- Modal --}}
                                <div class="modal fade" id="delete_restaurant_{{ $restaurant->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modal_{{ $restaurant->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Elimina il Ristorante: {{ $restaurant->name }}
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
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection
