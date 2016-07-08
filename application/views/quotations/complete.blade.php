@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')

	<div class="quotation-block">
		<ol class="breadcrumb">
			<li class="active">Windows &amp; doors</li>
			<li class="active">Decking &amp; flyover</li>
			<li class="active">Electrics</li>
			<li class="active">Interior</li>
			<li class="active">Other</li>
			<li>Complete</li>
		</ol>

		<!-- Show errors messages -->
		@if($data->error)
			<div id="error_message" class="alert alert-danger" role="alert">{{ $data->error }}</div>
		@endif

		<div class="complete-block">
			<h4 class="text-center">Your studio including delivery and installation</h4>

			<h2 class="text-center final-amount">&pound;{{number_format($data->costs->init_cost, 2)}}</h2>
			<h2 class="text-center final-amount" style="font-size: 14px;">Including delivery {{$data->delivery['totalDistance']}} miles to {{\Laravel\Session::get('quote_postcode')}}: &pound;{{number_format($data->delivery['price'], 2)}}</h2>

			<form action="{{ action('quotations.save_quote') }}" method="post" class="form-inline text-center">
				<label class="text-center">To save your studio, please enter your email</label>
				<div class="clearfix"></div>
				<div class="form-group">
					<input type="text" name="email" value="{{$data->email}}" class="form-control">
				</div>
				<button class="btn btn-grey" type="submit">Save</button>
			</form>

			@if($data->quote_update)
				<div style="text-align: center; margin-top: 1em;">You are currently viewing and updating quotation #{{$data->quote_id}}.</div>
				<div style="text-align: center; font-size: 11px;">Changing email address will change who the quote belongs to.</div>
			@endif
		</div>
	</div>	
@endsection