@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">

			<a href="{{ route('categories.create')}}"><button type="button">Create new category</button></a>
			<ul>
				@foreach($categories as $category)
				<li>
					{{ $category->name }}
					<a href="{{ route('categories.show',['category' => $category->id])}}">Details</a>
					<a href="{{ route('categories.edit',['category' => $category->id])}}"><button type="button">Update</button></a>
					<form action="{{route('categories.destroy',['category'=> $category->id])}}" method="post">
						@csrf
						@method('DELETE')
						<button type="submit">Delete</button>
					</form>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

@endsection
