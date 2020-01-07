@extends ('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3>Create Product</h3>
				<hr>

				<form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
					@csrf

					<input type="text" name="name" id="name" class="form-control mb-3" placeholder="Product name" value="{{old('name')}}">

					@if($errors->has('name'))
						
						    <div class="alert alert-danger">{{ $errors->first('name')}}</div>
				
					@endif

					<input type="text" name="price" id="price" class="form-control mb-3" placeholder="Product price" value="{{old('price')}}">

					@if($errors->has('price'))
						
						    <div class="alert alert-danger">{{ $errors->first('price')}}</div>
					
					@endif

					<select name="category-id" id="category-id" class="custom-select mb-3">
						@foreach($categories as $category)
						<option value="{{$category->id}}" {{ old('category-id') == $category->id ? "selected": ""}}>{{$category->name}}</option>
						@endforeach
					</select>

					@if($errors->has('category-id'))
						
						    <div class="alert alert-danger">{{ $errors->first('category-id')}}</div>
					
					@endif
		

					<input type="file" name="image" id="image" class="form-control-file mb-3">

					@if($errors->has('image'))
						
						    <div class="alert alert-danger">{{ $errors->first('image')}}</div>
					
					@endif

					<textarea name="description" id="description" cols="10" rows="10" class="form-control mb-3" placeholder="Product Description"></textarea>

					@if($errors->has('description'))
						
						    <div class="alert alert-danger">{{ $errors->first('description')}}</div>
					
					@endif

					<button type="submit" class="btn btn-primary">Create new product</button>


				</form>
			</div>
		</div>
	</div>

@endsection