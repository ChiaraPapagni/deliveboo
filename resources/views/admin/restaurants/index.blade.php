{{-- WARNING! Temporary target="_blank" for testing! remember to remove it when building --}}

@extends('layouts.admin')

@section('content')

    <div class="container mt-5">

        {{-- Restaurant / Admin --}}
        <div class="pt-5">
            <h1 class="pt-2 text-center">Restaurants</h1>
            <a class="btn btn-success mb-2" href="{{ route('admin.restaurants.create') }}" role="button">
                Create Restaurants
            </a>
        </div>

        {{-- Restaurant List --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Website</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td scope="row">{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td><a target="_blank" href="">{{ $restaurant->website }}</a></td>
                        <td>{{ $restaurant->phone }}</td>
                        <td>
                            <div class="btns d-flex">
                                <a class="btn btn-primary " href="{{ route('admin.restaurants.show', $restaurant->id) }}">
                                    Show
                                </a>
                                <a class="btn btn-warning ms-2 me-2"
                                    href="{{ route('admin.restaurants.edit', $restaurant->id) }}">
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
                                                <h5 class="modal-title">Delete restaurant: {{ $restaurant->name }}
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
                                {{-- <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
