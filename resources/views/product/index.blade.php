@extends('layouts.product')

@section('content')

<div class="container">

    <h2 class="ww">All products</h2>

    @if(\Session::has('message'))
        <div class="alert alert-success text-center mt-3">
            {{ \Session::get('message') }}
        </div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <x-product :product="$product"/>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <div class="row">
            {{ $products->links() }}
        </div>
    </div>

@endsection
