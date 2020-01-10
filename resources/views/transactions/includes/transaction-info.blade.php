
<tbody>
	<tr>
		<td>Customer Name:</td>
		<td>{{$transaction->user->name}}</td>
	</tr>
	<tr>
		<td>Transaction code:</td>
		<td>{{$transaction->transaction_code}}</td>
	</tr>
	<tr>
		<td>Payment mode:</td>
		<td>{{$transaction->payment_mode->name}}</td>
	</tr>
	<tr>
		<td>Date of purchase:</td>
		<td>{{$transaction->created_at->format('F d, Y')}}</td>
	</tr>
	<tr>

		<td>Status:</td>
		<td>
			{{$transaction->status->name}}
			@can('isAdmin')
			<form action="{{route('transactions.update',['transaction' => $transaction->id])}}" method="POST">
				@csrf
				@method('PUT')
				<select name="status" id="status" class="form-control-sm">
					@foreach($statuses as $status)
					<option value="{{$status->id}}" {{ $transaction->status->id == $status->id ? "selected" : ""}}>{{$status->name}}</option>
					@endforeach
				</select>
				<button class="btn-sm btn-warning">Change status</button>

			</form>
			@endcan
		</td>
	</tr>
</tbody>
