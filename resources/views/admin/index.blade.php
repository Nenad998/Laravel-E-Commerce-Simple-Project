@extends('layouts.product')

@section('content')

<div class="container">
    <div class="row align-items-start">
        @if(\Session::has('message'))
        <div class="alert alert-success text-center mt-3">
            {{ \Session::get('message') }}
        </div>
        @endif
        <div class="col">
            <h2 class="mb-3 mt-2">Admin panel</h2>
        </div>
        <div class="col">
            <a href="/admin/product/new" class="btn btn-success mt-3">New product</a>
        </div>
        <div class="col">
            <a href="/admin/category/new" class="btn btn-primary mt-3">New category</a>
        </div>
            <div class="col">
                <a href="/admin/orders" class="btn btn-primary mt-3">Orders</a>
            </div>
    </div>
</div>

    <div class="table-responsive">
    <table class="table">
        <thead class="table-dark text-center">
        <tr>
            <th class="col-md-4">Name</th>
            <th class="col-md-2">Price</th>
            <th class="col-md-4">Category</th>
            <th class="col-md-2">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr class="table-row text-center mb-3">
            <td class="{{ $product->deleted ? 'table-danger' : '' }}">{{ $product->name }}</td>
            <td class="{{ $product->deleted ? 'table-danger' : '' }}">${{ $product->price }}</td>
            <td class="{{ $product->deleted ? 'table-danger' : '' }}">{{ optional($product->category)->name }}</td>
            <td class="{{ $product->deleted ? 'table-danger' : '' }}"><a class="aws_icon" href="/product/{{ $product->slug }}"><i class="fas fa-eye fa-lg"></i></a>  &nbsp;  <a class="aws_icon" href="/admin/product/edit/{{ $product->id }}"><i class="fas fa-edit fa-lg"></i></a> &nbsp;<form class="admin_table_td" method="post" action="/admin/product/{{ $product->id }}"> @csrf @method('DELETE') <button type="submit" class="btn btn-secundary"><i class="fas fa-trash fa-lg"></i></button> </form> </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center">
        <div class="row">
             {{ $products->links() }}
         </div>
    </div>

@endsection
