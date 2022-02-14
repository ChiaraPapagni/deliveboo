@extends('layouts.admin')

@section('content')
    <div class="container">
        <img src="{{ asset('storage/account_image/' . $user->id . '/' . $user->account_image) }}"
            alt="{{ $user->name }}">
        <h4>Welcome to your Dashboard: {{ $user->name }}</h4>
    </div>
@endsection
