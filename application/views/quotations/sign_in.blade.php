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
		@if($data['error'])
			<div id="error_message" class="alert alert-danger" role="alert">{{ $data['error'] }}</div>
		@endif

		<div class="signin-block">
			@if($data['success'])
				<h4 class="text-center">{{$data['success']}}</h4>
			@endif

			<p class="text-center">Sign in to your account to access your quotes.</p>

			<div class="col-md-4 col-md-offset-4">
				<div class="well sign-in-form-box">
					<form action="{{ action('quotations/sign_in') }}" method="post">
						<div class="form-group">
							<input type="text" name="email" value="" placeholder="Email">
						</div>
						<div class="form-group">
							<input type="text" name="postcode" value="" placeholder="Postcode">
						</div>
						<button class="btn btn-dark btn-block" type="submit">Sign In</button>
					</form>
				</div>
			</div>
		</div>
			
	</div>	
@endsection