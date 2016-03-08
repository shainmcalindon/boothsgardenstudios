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

		<div class="complete-block">
			<h4 class="text-center">Your studio including delivery and installation</h4>

			<h2 class="text-center final-amount">&pound;20,073.00</h2>

			<form action="{{ action('quotations.sign_in') }}" method="post" class="form-inline text-center">
					<label class="text-center">To save your studio, please enter your email</label>
				<div class="clearfix"></div>
				<div class="form-group">
					<input type="text" name="email" value="" class="form-control">
				</div>
				<button class="btn btn-grey" type="submit">Save</button>
			</form>
		</div>
			
	</div>	
@endsection