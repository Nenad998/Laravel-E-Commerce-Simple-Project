
<div class="col-md-3">
    <div class="card">
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="...">
        @else
            <img src="https://picsum.photos/400/200?random={{ $product->id }}" class="card-img-top" alt="...">
            @endif
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><b>Category: </b> {{ optional($product->category)->name }} </p>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">Price: <b>${{ $product->price }}</b></p>
            <a href="/product/{{ $product->slug }}" class="btn btn-primary">Details</a>
        </div>
    </div>
</div>
