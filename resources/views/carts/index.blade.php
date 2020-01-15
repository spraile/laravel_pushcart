@extends('layouts.app')

@section('content')



<div class="container">
	<h3>My Cart</h3>
	@if(Session::has('status'))
	<div class="col-12 alert alert-success text-center">{{Session::get('status')}}</div>
	@endif
	@include('products.includes.error-status')
	<div class="row">
		<div class="col-12">
		</div>
		<div class="col-12">
	@if(Session::has('cart'))
			{{-- table --}}
			<div class="table-responsive">
				<table class="table table-striped table-hover text-center">
					<thead>
						<th scope="col">Name</th>
						<th scope="col">Price per unit</th>
						<th scope="col">Quantity</th>
						<th scope="col">Subtotal</th>
						<th scope="col">Actions</th>
					</thead>
					<tbody>
						{{-- start of row --}}
						@foreach($products as $product)
						<tr>
							<th scope="row">{{$product->name}}</th>
							<td>&#8369; <span>{{number_format($product->price,2)}}</span></td>
							<td class="w-25">
								<div class="add-to-cart-field mb-2">
									<form action="{{route('carts.update',['cart' => $product->id])}}" method="POST">
										@csrf
										@method('PUT')

										<input 
										type="number" 
										name="quantity" 
										id="quantity" 
										class="form-control-sm w-100 mb-2"
										value="{{$product->quantity}}"
										min="1">
										<button class="btn-sm btn-warning w-100" type="submit">
											Edit
										</button>
									</form>

								</div>
							</td>
							<td>
								&#8369; {{number_format($product->subtotal,2)}}
							</td>
							<td>
								<form action="{{route('carts.destroy', ['cart'=>$product->id])}}" method="POST">
									@csrf
									@method('DELETE')
									<button class="btn-sm btn-danger w-100">Remove from cart</button>
								</form>
							</td>
						</tr>
						@endforeach
						{{-- end of row --}}
					</tbody>
					<tfoot>
						<tr>
							<td>
								<form action="{{route('carts.empty')}}" method="POST">
									@csrf
									@method('DELETE')
									<button class="btn-sm btn-danger w-100">Clear Cart</button>
								</form>
							</td>
							<td colspan="2" class="text-right">Total</td>
							<td >&#8369; <span id="total">{{number_format($total,2)}}</span></td>
							<td>
								@can('isLogged')
								<form action="
								{{route('transactions.store')}}
								" method="POST">
									@csrf
									<button class="btn-sm btn-primary w-100 mb-2">Checkout</button>
								</form>
								<div id="paypal-btn"></div>
								@endcan
								@cannot('isLogged')
									<a href="{{route('login')}}"><button class="btn-sm btn-primary w-100">Checkout</button></a>

								@endcannot	
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			{{-- end of table --}}
		</div>
	</div>
	@else
	<div class="alert alert-info text-center">Cart is empty</div>
	@endif
</div>
@if(Session::has('cart'))
<script src="https://www.paypal.com/sdk/js?client-id=ASpgcoheZVyBBz6fqklRaY0z6JGWf_GvSg37YC1-ycDfMUpM8VFkuVhADgQAknf7gI9ni_T9Lih5sPuP"></script>
<script>
	paypal.Buttons({
	createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: {{$total}}
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let jdata = { transactionCode : data.orderID }
        fetch('{{route('transactions.paypal')}}', {
        	method : "post",
        	body : JSON.stringify(jdata),
        	headers : {'X-CSRF-TOKEN': csrfToken}

        })
        .then( response => response.json())
        .then( res => window.location.assign(res.url))
      });
    }
}).render('#paypal-btn');
</script>
@endif
	

@endsection