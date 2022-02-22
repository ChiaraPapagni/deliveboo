@extends('layouts.admin')

@section('content')
    <div class="container mt-5 py-5">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>LAST_NAME</th>
                    <th>PHONE</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>NOTES</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td scope="row">{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->last_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->notes }}</td>
                        <td>{{ $order->amount }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
