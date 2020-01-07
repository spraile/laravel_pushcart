@extends('layouts.app')



@section('content')

<div class="container">
	@if(Session::has('status'))
		<div class="alert alert-success">
			{{Session::get('status')}}
		</div>

	@endif
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