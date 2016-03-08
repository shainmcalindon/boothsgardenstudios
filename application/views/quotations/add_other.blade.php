@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
	<p class="text-right"><small>Your studio Including delivery and Installation</small> <span class="total-amount">&pound;15,830.00</span></p>

	<div class="quotation-block">
		<ol class="breadcrumb">
			<li class="active">Windows &amp; doors</li>
			<li class="active">Decking &amp; flyover</li>
			<li class="active">Electrics</li>
			<li class="active">Interior</li>
			<li>Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>OTHER ADDITIONS YOU CAN ADD TO YOUR STUDIO</h4>

		<form action="{{ action('quotations@complete') }}" method="post">
			<div class="col-md-6">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label>Add a "Decoupled Floor" for Running Machines and Drums - reduce vibration</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
						<div class="form-group">
							<label>Add double sockets above worktop height (approx 1150mm from floor)</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
						<div class="form-group">
							<label>Aquastep Oak floor covering a water proof floor used in bathrooms or if you want a harder wearing floor or waterproof floor</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
						<div class="form-group">
							<label>Swap your studio walls to timber colour (still same maintenance free steel walls)</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
						<div class="form-group">
							<label>Add taller walls for more headroom within your studio (may require planning permission)</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
						<div class="form-group">
							<label>Add steps can be installed into your studio (Steps may be made from tanalised timber)</label>
							<input type="text" name="decoupled_floor" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				
				<button class="btn btn-dark">Complete ></button>
			</div>
		</form>
	</div>	
@endsection