@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<h4><a href="{{ route('categories.index') }}">View all categories</a></h4>
			@if($category)

			<h3>{{$category->name}}</h3>
			<p>Created at : {{ $category->created_at}}</p>

			@else
			404 not found
			@endif
		</div>
	</div>
</div>

@endsection
