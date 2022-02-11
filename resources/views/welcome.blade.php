@extends('layouts.app')

@section('personalCss')
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- Jubmo container [video e herotext] --}}
    <div class="jumboContainer ">
        <video class="jumboVideo" autoplay loop muted>
            <source src="{{ asset('video/jumbotron.mp4') }}" type="video/mp4">
        </video>

        {{-- herotext --}}
        <div class="container h-100 d-flex align-items-center">
            <h1 class="text-capitalize Title text-light">serviamo tutti i piatti <span class="text-danger">caldi</span>
                <br> tranne il
                <span class="text-danger">sushi</span>
            </h1>

        </div>
    </div>

    {{-- Category Container [cards] --}}
    <div class="categoryContainer py-5">
        <div class="container">

            <h2 class="text-capitalize pb-5 pt-3 fs-1">choose your favourite categories!</h2>

            <div class="row row-cols-2 {{-- row-cols-sm-2 --}} row-cols-md-4 row-cols-xl-5 gy-4 w-100 justify-content-center">
                {{-- Ciclo per stampare le cards --}}
                @foreach ($categories as $category)
                    <div class="col">

                        {{-- Card --}}
                        <div class="card">

                            {{-- Card Image --}}
                            <div class="card-body w-100 text-center">
                                <img width="90%" src="{{ $category->category_image }}" alt="">
                            </div>

                            {{-- Cards Info --}}
                            <div class="card-text w-100">
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

    {{-- SearchBar Per i Ristoranti --}}
    <div class="searchbarContainer py-5">
        <div class="container text-end">

            <div class="mb-3">
                <h3 for="restaurant" class="form-label text-capitalize">ricerca i tuoi ristoranti preferiti!</h3>
                <input type="text" name="restaurant" id="restaurant" class="form-control text-end"
                    placeholder="Type restaurant's name" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Scrivi il nome del ristorante dove vuoi ordinare</small>
            </div>
        </div>
    </div>

    {{-- Restaurant Container --}}
    <div class="categoryContainer py-5">
        <div class="container">

            <h2 class="text-capitalize pb-5 pt-3 fs-1">choose your favourite restaurant!</h2>

            <div
                class="row row-cols-2 {{-- row-cols-sm-2 --}} row-cols-md-4 row-cols-xl-5 gy-4 w-100 justify-content-center">
                {{-- Ciclo per stampare le cards --}}
                @foreach ($restaurants as $restaurant)
                    <div class="col">

                        {{-- Card --}}
                        <div class="card">

                            {{-- Card Image --}}
                            <div class="card-body w-100 text-center">
                                <img width="90%" src="{{ $restaurant->restaurant_image }}" alt="">
                            </div>

                            {{-- Cards Info --}}
                            <div class="card-text w-100">
                                <h3>{{ $restaurant->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

@endsection
