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
			<li>Electrics</li>
			<li class="active">Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD ADDITIONAL ELECTRIC FITTINGS</h4>

		<form action="{{ action('quotations@add_interior') }}" method="post">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add more double sockets at a height of 450mm from floor</label>
							<input type="text" name="sockets_450" class="form-control">
						</div>

					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add double sockets abgove worktop height (approx 1150mm from floor)</label>
							<input type="text" name="sockets_1150" class="form-control">
							
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add light switches if you divide room all room require a light switch</label>
							<input type="text" name="light_switches" class="form-control">
						</div>
						<div class="form-group">
							<label>Add panel heater fitted with fused socket</label>
							<input type="text" name="panel_heater" class="form-control">
						</div>
						<div class="form-group">
							<label>Add a double floor socket - avoids appliance cables running across floor</label>
							<input type="text" name="double_floor_socket" class="form-control">
						</div>
						<div class="form-group">
							<label>Add Fused spur socket for air conditioning etc</label>
							<input type="text" name="spur_socket" class="form-control">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="clearfix"></div>
			<div class="col-md-12">
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				<button class="btn btn-dark">Interior ></button>
			</div>
		</form>
	</div>	
@endsection

@section('script')
	<script>
		$(function () {
		  $('[data-toggle="popover"]').popover({container: 'body'})
		})
	</script>
@endsection