@extends('layouts.product')

@section('content')



<div class="container">
    <div class="row mt-5">
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
