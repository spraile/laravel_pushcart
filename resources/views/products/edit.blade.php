@extends('layouts.app')

@section('content')

<div class="container">
		<div class="row">
			<div class="col-12 col-md-8">
				<h3>Edit Product</h3>
				<hr>
				@if(Session::has('status'))
					<div class="alert alert-success">
						{{Session::get('status')}}
					</div>
				@endif

				<form action="{{ route('products.update',['product' => $product->id])}}" method="POST" enctype="multipart/form-data">
					@method('PUT')
					@csrf

					<input type="text" name="name" id="name" class="form-control mb-3" placeholder="Product name" value="{{$product->name}}">

					@if($errors->has('name'))
						
						    <div class="alert alert-danger">{{ $errors->first('name')}}</div>
				
					@endif

					<input type="text" name="price" id="price" class="form-control mb-3" placeholder="Product price" value="{{$product->price}}">

					@if($errors->has('price'))
						
						    <div class="alert alert-danger">{{ $errors->first('price')}}</div>
					
					@endif

					<select name="category-id" id="category-id" class="custom-select mb-3">
						@foreach($categories as $category)
						<option value="{{$category->id}}" {{ $product->category_id == $category->id ? "selected": ""}}>{{$category->name}} </option>
						@endforeach
					</select>

					@if($errors->has('category-id'))
						
						    <div class="alert alert-danger">{{ $errors->first('category-id')}}</div>
					
					@endif
		

					<input type="file" name="image" id="image" class="form-control-file mb-3">

					@if($errors->has('image'))
						
						    <div class="alert alert-danger">{{ $errors->first('image')}}</div>
					
					@endif

					<textarea name="description" id="description" cols="10" rows="10" class="form-control mb-3" placeholder="Product Description">{{$product->description}}</textarea>

					@if($errors->has('description'))
						
						    <div class="alert alert-danger">{{ $errors->first('description')}}</div>
					
					@endif

					<button  class="btn btn-primary">Update product</button>


				</form>
			</div>
			<div class="col-6 col-sm-4">
				@include('products.includes.product-card')
			</div>
		</div>
	</div>

@endsection