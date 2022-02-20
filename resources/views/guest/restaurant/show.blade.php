@extends('layouts.app')

@section('personalCss')
    <link href="{{ asset('css/ShowRistorante.css') }}" rel="stylesheet">
@endsection

@section('content')
    {{-- jumbo pizza --}}
    <div id="custom-data" data-profiles="{{ $restaurant->id }}" class="contenitore-jumbo">
        <img src="http://127.0.0.1:8000/img-prova/background-food.png" alt="pizza" class="pizza mt-5">

        <div class="contenitore-titolo">
            <h1 class="restaurant-name">{{ $restaurant->name }}</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, aperiam perferendis voluptate.</p>
            <a href="#" role="button" class="btn btn-warning mb-2">Order Now</a>
        </div>

    </div>

    <div class="top-pics">
        <div class="line"></div>
        <div class="text">Top Picks</div>
        <div class="line"></div>
    </div>

    {{-- griglia cibo --}}
    <div class="container mt-3">
        <p class="paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, quasi eveniet quibusdam
            totam repellat nemo,
            reiciendis iusto officia animi placeat asperiores!</p>
        <div class="row row-panino">
            <div class="col-lg-6 md-2 sm-2 hover01">
                <div class="img-container">
                    <figure><img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="pics img"></figure>
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2 hover01">
                <div class="img-container">
                    <figure><img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="pics img"></figure>
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2 hover01">
                <div class="img-container">
                    <figure><img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="pics img"></figure>
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2 hover01">
                <div class="img-container">
                    <figure><img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="pics img"></figure>
                </div>
            </div>

        </div>
    </div>


    <div class="top-pics mt-5">
        <div class="line"></div>
        <div class="text">Choose your meal</div>
        <div class="line"></div>
    </div>

    <div class="container mt-4 testo">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus laboriosam esse provident sed ipsam
            voluptas.</p>
    </div>

    <div class="container mt-5">

        <div class="row">
            @foreach ($restaurant->products as $product)
                {{-- Componente per il singolo prodotto --}}
                <product-component @add-cart="AddNewCart" :product="{{ $product }}">
                </product-component>
            @endforeach
        </div>
    </div>

    {{-- carrello --}}
    <cart-component @refresh-qty="refreshQty" :total="total" :cart="cart"></cart-component>


    <div class="jumbo-consegne mt-5">
        <img src="http://127.0.0.1:8000/img-prova/fast-food.png" alt="" class="img-jumbo-consegne ">
        <div class="contenitore-titolo-consegne">
            <h3 class="delivery-title">Free shipping over $12</h3>
            <a href="#" role="button" class="btn btn-dark mb-2">Order Now</a>
        </div>
    </div>
@endsection
