<div class="card">
	<img src="/storage/{{$product->image}}" alt="" class="card-img-top">
	<div class="card-body">
		<h5 class="card-title">{{$product->name}}</h5>
		<p class="card-text">&#8369;{{number_format($product->price,2)}}</p>
		<p class="card-text">{{$product->category->name}}</p>
		<p class="card-text">{{$product->description}}</p>

	</div>
	<div class="card-footer">
		@cannot('isAdmin')
		<form action="{{route('carts.update',['cart' => $product->id])}}" method="POST">
			@csrf
			@method('PUT')
			<input type="number" name="quantity" id="quantity" class="form-control-sm w-100 mb-3" min="1">
			<button class="btn btn-primary w-100 mb-3">Add to cart</button>
		</form>
		@endcannot
		<a href="{{route('products.show',['product' => $product->id])}}" class="btn btn-success w-100 mb-3">View Product</a>
		@can('isAdmin')
		<a href="{{route('products.edit',['product' => $product->id])}}" class="btn btn-warning w-100 mb-3">Edit Product</a>
		<form action="{{route('products.destroy',['product'=> $product->id])}}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn btn-danger w-100 mb-3">Remove Product</button>
		</form>
		@endcan
	</div>
</div>