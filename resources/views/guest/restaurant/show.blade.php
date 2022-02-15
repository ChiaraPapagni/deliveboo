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
    <div class="container mt-5">
        <div class="row row-panino">
            <div class="col-lg-6 md-2 sm-2">
                <div class="yellow">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2">
                <div class="yellow">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2">
                <div class="yellow">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
            </div>
            <div class="col-lg-6 md-2 sm-2">
                <div class="yellow">
                    <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                </div>
            </div>

        </div>
    </div>


    <div class="container mt-5 testo">
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
            <div class="col-lg-3">
                <img src="http://127.0.0.1:8000/img-prova/panino1.png" alt="" class="img">
                <h3>Panino prova</h3>
                <p>10$</p>
                <p>descrizione</p>
            </div>
        </div>
    </div>

    <div class="jumbo-consegne mt-5">
        <img src="http://127.0.0.1:8000/img-prova/jumbo-cinese.jpg" alt="" class="img-jumbo-consegne">
        <div class="contenitore-titolo-consegne">
            <h3>Consegne gratuite sopra i 12$</h3>
            <a href="#" role="button" class="btn btn-dark mb-2">ordina ora</a>
        </div>
    </div>
@endsection
