@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
	<p class="text-right"><small>Your studio Including delivery and Installation up to this stage</small> <span class="total-amount">&pound;{{number_format($data->costs->init_cost, 2)}}</span></p>
	<p class="text-right" style="margin-top: -1em;">
		<small>Delivery {{$data->delivery['totalDistance']}} miles to {{\Laravel\Session::get('quote_postcode')}}: &pound;{{number_format($data->delivery['price'], 2)}}</small>
	</p>

	<div class="quotation-block">
		<ol class="breadcrumb">
			<li class="active">Windows &amp; doors</li>
			<li class="active">Decking &amp; flyover</li>
			<li class="active">Electrics</li>
			<li>Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD VENETIAN BLINDS</h4>

		<form action="{{ action('quotations@add_other') }}" method="post" id="interior_form">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a Silver Aluminum Venitian Blind with "no screws required" brackets</label>
							<select name="silver_aluminum" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option @if($i == $data->defaults->silver_aluminium_venitian_blind_no_screws)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->silver_aluminium_venitian_blind_no_screws}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add recessed blinds (held secure in frame around window)</label>
							<select name="recessed_blinds" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option @if($i == $data->defaults->recessed_blinds)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->recessed_blinds}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>


			<div class="col-md-12">
				<h4>ADD INTERNAL WALLS AND DOORS</h4>				
			</div>

			<div class="clearfix"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add Internal 910mm Partition Wall/Walls (create 2 rooms within your Studio)</label>
							<input type="text" name="internal_901mm" class="form-control" value="@if(!empty($data->defaults->internal_910_partition_wall)){{$data->defaults->internal_910_partition_wall}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->internal_910_partition_wall}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add Internal door when dividing Studio (gives access between 2 rooms)</label>
							<input type="text" name="internal_door" class="form-control" value="@if(!empty($data->defaults->internal_door_dividing_studio)){{$data->defaults->internal_door_dividing_studio}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->internal_door_dividing_studio}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add internal wall corner post (when internal 3ft walls are at right angles to each other</label>
							<input type="text" name="internal_wall_corner" class="form-control" value="@if(!empty($data->defaults->internal_wall_corner_post)){{$data->defaults->internal_wall_corner_post}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->internal_wall_corner_post}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-md-12">
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				<button class="btn btn-dark">Other ></button>
			</div>
		</form>
	</div>	
@endsection

@section('script')
	<script>
		// Initial cost
		init_cost = "{{$data->costs->init_cost}}";

		// Costs
		silver_aluminium_venitian_blind_no_screws_cost = "{{$data->costs->silver_aluminium_venitian_blind_no_screws}}";
		recessed_blinds_cost = "{{$data->costs->recessed_blinds}}";
		internal_910_partition_wall_cost = "{{$data->costs->internal_910_partition_wall}}";
		internal_door_dividing_studio_cost = "{{$data->costs->internal_door_dividing_studio}}";
		internal_wall_corner_post_cost = "{{$data->costs->internal_wall_corner_post}}";

		jQuery(function($){
			// Popover
			$('[data-toggle="popover"]').popover({container: 'body'});

			// Calc price
			var calcPrice = function(){
				// Studio Beginning Cost
				cost = parseFloat(init_cost);

				// Work out quantities
				internal_901mm_qty = (parseInt($('input[name="internal_901mm"]').val()) > 0) ? parseInt($('input[name="internal_901mm"]').val()) : 0;
				internal_door_qty = (parseInt($('input[name="internal_door"]').val()) > 0) ? parseInt($('input[name="internal_door"]').val()) : 0;
				internal_wall_corner_qty = (parseInt($('input[name="internal_wall_corner"]').val()) > 0) ? parseInt($('input[name="internal_wall_corner"]').val()) : 0;

				// Calc various costs
				silver_aluminum_total = parseFloat(silver_aluminium_venitian_blind_no_screws_cost) * $('select[name="silver_aluminum"]').val();
				recessed_blinds_total = parseFloat(recessed_blinds_cost) * $('select[name="recessed_blinds"]').val();
				internal_901mm_total = parseFloat(internal_910_partition_wall_cost) * internal_901mm_qty;
				internal_door_total = parseFloat(internal_door_dividing_studio_cost) * internal_door_qty;
				internal_wall_corner_total = parseFloat(internal_wall_corner_post_cost) * internal_wall_corner_qty;

				// Total base cost + additionals
				cost = cost + silver_aluminum_total + recessed_blinds_total + internal_901mm_total + internal_door_total + internal_wall_corner_total;

				// Display
				$('.total-amount').html('&pound;' + number_format(cost, 2));
			};

			// Calc price on select form change
			$('#interior_form select').on('change', function(){
				calcPrice();
			});

			// Calc price on select form change
			$('#interior_form input').on('keyup', function(){
				calcPrice();
			});

			// Sync screen on page load
			calcPrice();
		});

		function number_format (number, decimals, dec_point, thousands_sep) {
			// Strip all characters but numerical ones.
			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			var n = !isFinite(+number) ? 0 : +number,
					prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
					sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
					dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
					s = '',
					toFixedFix = function (n, prec) {
						var k = Math.pow(10, prec);
						return '' + Math.round(n * k) / k;
					};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
		}
	</script>
@endsection