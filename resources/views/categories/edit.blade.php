@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">


			@if($errors->any())
			<div>
				<ul>Errors
					
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>

					@endforeach

				</ul>
			</div>
			@endif

			<form action="{{ route('categories.update',['category' => $category->id])}}" method="post">
				@method('PUT')
				@csrf

				<label for="name">Category name:</label>
				<input type="text" name="name" id="name" value="{{ $category->name }}">
				<button>Update</button>
			</form>

		</div>
	</div>
</div>

@endsection