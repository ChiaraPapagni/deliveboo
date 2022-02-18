@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="container pt-4 pb-5">
        <h1 class="pb-4">
            Dashboard
        </h1>

        {{-- Dati Utente Nome ed Email --}}
        <div class="row align-items-center">
            <div class="col-4">
                <img src="{{ asset('storage/account_image/' . $user->id . '/' . $user->account_image) }}"
                    alt="{{ $user->name }}" class="accountImage rounded-pill">
            </div>
            <div class="col-8 text-start">
                <ul>
                    <li class="fs-3 my-3">Your Name : {{ $user->name }}</li>
                    <li class="fs-3 my-3">Your Email : {{ $user->email }}</li>
                </ul>
            </div>
        </div>


    </div>
@endsection
