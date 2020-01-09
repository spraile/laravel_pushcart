@extends('layouts.app')

@section('content')
<div class="container">
	<h3>My Transactions</h3>
	<hr>
	<div class="row">
		<div class="col-12 col-md-8 mx-auto">
			<div class="accordion" id="accordionExample">
				{{-- start of transaction	 --}}
				@foreach($transactions as $transaction)
				<div class="card">
					<div class="card-header" id="heading{{$transaction->id}}">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$transaction->id}}">
								{{$transaction->created_at->format('F d, Y  H:i:s')}} <span class="badge badge-{{$transaction->status->id == 1 ? "info" : ($transaction->status->id == 2 ? "success" : "secondary")}}">{{$transaction->status->name}}</span>
							</button>
						</h2>
					</div>
					<div id="collapse{{$transaction->id}}" class="collapse" data-parent="#accordionExample">
						<div class="card-body">
							<div class="table-responsive">
								{{-- start of transaction table --}}
								<table class="table table-striped">
									@include('transactions.includes.transaction-info')
									<tfoot>
										<tr>
											<td>Total:</td>
											<td>&#8369; {{number_format($transaction->total,2)}}</td>
										</tr>
										<tr>
											<td colspan="2" class=""><a href="{{route('transactions.show',['transaction' => $transaction->id])}}"><button class="btn btn-outline-primary w-25">Details</button></a></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				{{-- end of transaction	 --}}

			</div>
		</div>
	</div>
</div>
@endsection