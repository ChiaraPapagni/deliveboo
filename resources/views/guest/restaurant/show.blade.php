@extends('layouts.app')


@section('personalCss')
    <link href="{{ asset('css/ShowRistorante.css') }}" rel="stylesheet">
@endsection


@section('content')
    {{-- jumbo pizza --}}
    <div class="contenitore-jumbo">
        <img src="http://127.0.0.1:8000/img-prova/sfondo-pizza.png" alt="pizza" class="pizza">
        <div class="contenitore-titolo">
            <h1>Pizza super sfocata</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, aperiam perferendis voluptate.</p>
            <a href="#" role="button" class="btn btn-warning mb-2">compra questa pizza bruttissima</a>
        </div>
    </div>

    {{-- griglia cibo --}}
    <div class="contenitore-cibo">
        <div class="container mt-5">
            <div class="row row-panino">
                <div class="col-lg-6 md-2 sm-2">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
                <div class="col-lg-6 md-2 sm-2">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
                <div class="col-lg-6 md-2 sm-2">
                    <img src="http://127.0.0.1:8000/img-prova/dolce.png" alt="" class="img">
                </div>
                <div class="col-lg-6 md-2 sm-2">
                    <img src="http://127.0.0.1:8000/img-prova/dolce.png" alt="" class="img">
                </div>

            </div>
        </div>
    </div>


    <div class="container mt-5">
        <h1>Scegli il tuo pasto</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus laboriosam esse provident sed ipsam
            voluptas.</p>
    </div>

    {{-- griglia ingredienti/ prodotti --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                <h3>Panino prova</h3>
                <p>10$</p>
                <p>descrizione</p>
            </div>
            <div class="col-lg-3">
                <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                <h3>Panino prova</h3>
                <p>10$</p>
                <p>descrizione</p>
            </div>
            <div class="col-lg-3">
                <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                <h3>Panino prova</h3>
                <p>10$</p>
                <p>descrizione</p>
            </div>
        </div>
    </div>
@endsection
