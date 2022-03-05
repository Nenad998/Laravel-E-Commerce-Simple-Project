@extends('layouts.product')

@section('content')

    <h2>All orders</h2>

    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark text-center">
            <tr>
                <th>Customer</th>
                <th>Address</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Cost</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="table-row text-center mb-3">
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td><b>$</b>{{ $order->product->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td><b>$</b>{{ $order->product->price * $order->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
