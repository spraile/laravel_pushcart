@extends("layouts.app")
@section('content')

<div class="container">
	@if(Session::has('status'))
		<div class="alert alert-success">
			{{Session::get('status')}}
		</div>

	@endif
	<div class="row">
		<div class="col-12">
			<h3>Transaction details</h3>
			<hr>
		</div>	

		<div class="col-12">
			{{-- start of table --}}
			<div class="table-responsive">
				{{-- start of transaction table --}}
				<table class="table table-striped">
				@include('transactions.includes.transaction-info')
			</table>

				{{-- end of transaction table --}}

				{{-- start of product trasaction --}}
				<table class="table table-striped table-hover">
					<thead>
						<th scope="col">Product Name</th>
						<th scope="col">Product price</th>
						<th scope="col">Product qty</th>
						<th scope="col">Product subtotal</th>
					</thead>
					<tbody>
						{{-- start of product details --}}
						@foreach($transaction->products as $transaction_product)
						<tr>
							{{-- {{dd($transaction_product)}} --}}
							<td>{{$transaction_product->name}}</td>
							<td>&#8369; {{number_format($transaction_product->price,2)}}</td>
							<td>{{$transaction_product->pivot->quantity}}</td>
							<td>&#8369; {{number_format($transaction_product->pivot->subtotal,2)}}</td>
						</tr>
						@endforeach
						{{-- end of product details --}}
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3" class="text-right"><strong>Total</strong></td>
							<td>&#8369; {{number_format($transaction->total,2)}}</td>
						</tr>
					</tfoot>
				</table>
				{{-- end of pt --}}

			</div>
			{{-- end of table --}}
		</div>
	</div>
</div>


@endsection