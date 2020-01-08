@extends('layouts.app')



@section('content')

<div class="container">
	@if(Session::has('status'))
		<div class="alert alert-success">
			{{Session::get('status')}}
		</div>

	@endif
	@include('products.includes.error-status')
	<div class="row mb-2">
		<div class="col-12">
			<form action="">
				<div class="row">
					<div class="col">
						<select name="category" id="category" class="form-control-sm d-inline">
							<option value="">All</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}" >{{$category->name}}</option>
							@endforeach
						</select>
						<button class="btn-sm btn-primary">Filter</button>

					</div>

				</div>
			</form>
		</div>
	</div>
	<div class="row">
	
	@foreach($products as $product)
		{{-- start of cards --}}
		<div class="col-12 col-md-4 col-lg-3">
			@include('products.includes.product-card')
		</div>
		{{-- end of cards --}}
		@endforeach
	</div>
</div>
@endsection