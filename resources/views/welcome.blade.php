@extends('layouts.app')

@section('content')

    <div class="jumboContainer">
        <video width="100%" autoplay loop muted>
            <source src="{{ asset('video/jumbotron.mp4') }}" type="video/mp4">
        </video>
    </div>

@endsection
