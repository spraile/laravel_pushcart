@extends('layouts.app')

@section('content')
<div class="container">
	@include('products.includes.error-status')	
	<div class="row">
		<div class="col-12 col-md-4 col-lg-3">
			@include('products.includes.product-card')
		</div>

	</div>
</div>
@endsection