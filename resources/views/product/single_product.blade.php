@extends('layouts.product')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 pt-5">
                <div class="card">
                    <img src="https://picsum.photos/400/200?random={{ $product->id }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Category: <b>{{ $product->category->name }}</b></p>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Price: <b>${{ $product->price }}</b></p>
                        <form method="post" action="/cart">
                        @csrf
                            <input type="number" class="form-control" placeholder="put quantity" name="quantity">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input class="btn btn-primary" type="submit" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
