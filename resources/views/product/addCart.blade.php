@extends('layouts.product')

@section('content')


<div class="container">
    <div class="row pt-5">
        <div class="col-lg-6">
            <form method="post" action="/buy">
                @csrf
                <input type="hidden" name="quantity" value="{{ $value }}" >
                <input type="hidden" name="product_id" value="{{ $value2 }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Your Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
                <input class="btn btn-primary" type="submit" value="Buy">
            </form>
        </div>
    </div>
</div>

@endsection
