<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Category</title>
</head>
<body>
	@if($errors->any())
		<div>
			<ul>Errors
				
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>

			@endforeach

			</ul>
		</div>
	@endif

	<form action="{{ route('categories.store') }}" method="post">
		@csrf

		<label for="name">Category name:</label>
		<input type="text" name="name" id="name">
		<button>Create</button>
	</form>
</body>
</html>