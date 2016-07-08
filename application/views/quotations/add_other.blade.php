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
			<li class="active">Interior</li>
			<li>Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>OTHER ADDITIONS YOU CAN ADD TO YOUR STUDIO</h4>

		<form action="{{ action('quotations@complete') }}" method="post" id="other_form">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a "Decoupled Floor" for Running Machines and Drums - reduce vibration</label>
							<input type="text" name="decoupled_floor" class="form-control" value="@if(!empty($data->defaults->decoupled_floor)){{$data->defaults->decoupled_floor}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->decoupled_floor}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Aquastep Oak floor covering a water proof floor used in bathrooms or if you want a harder wearing floor or waterproof floor</label>
							<input type="text" name="aquastep_oak_floor" class="form-control" value="@if(!empty($data->defaults->aquastep_oak_floor)){{$data->defaults->aquastep_oak_floor}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->other_aquastep_oak_floor}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Swap your studio walls to timber colour (still same maintenance free steel walls)</label>
							<input type="text" name="walls_to_timber" class="form-control" value="@if(!empty($data->defaults->walls_to_timber)){{$data->defaults->walls_to_timber}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->walls_to_timber}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add taller walls for more headroom within your studio (may require planning permission)</label>
							<input type="text" name="taller_walls" class="form-control" value="@if(!empty($data->defaults->taller_walls)){{$data->defaults->taller_walls}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->taller_walls}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add steps can be installed into your studio (Steps may be made from tanalised timber)</label>
							<input type="text" name="entry_steps" class="form-control" value="@if(!empty($data->defaults->entry_steps)){{$data->defaults->entry_steps}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->entry_steps}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a handrail to go with step (Handrail may be made from tanalised timber)</label>
							<input type="text" name="entry_handrail" class="form-control" value="@if(!empty($data->defaults->entry_handrail)){{$data->defaults->entry_handrail}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->entry_handrail}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add skirt between between ground and studio to hide any gaps (910mm sections)</label>
							<input type="text" name="skirt" class="form-control" value="@if(!empty($data->defaults->skirt)){{$data->defaults->skirt}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->skirt}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				<button class="btn btn-dark">Complete></button>
			</div>
		</form>
	</div>	
@endsection

@section('script')
	<script>
		// Initial cost
		init_cost = "{{$data->costs->init_cost}}";

		// Costs
		decoupled_floor_cost = "{{$data->costs->decoupled_floor}}";
		aquastep_oak_floor_cost = "{{$data->costs->aquastep_oak_floor}}";
		walls_to_timber_cost = "{{$data->costs->walls_to_timber}}";
		taller_walls_cost = "{{$data->costs->taller_walls}}";
		entry_steps_cost = "{{$data->costs->entry_steps}}";
		entry_handrail_cost = "{{$data->costs->entry_handrail}}";
		skirt_cost = "{{$data->costs->skirt}}";

		jQuery(function($){
			// Popover
			$('[data-toggle="popover"]').popover({container: 'body'});

			// Calc price
			var calcPrice = function(){
				// Studio Beginning Cost
				cost = parseFloat(init_cost);

				// Work out quantities
				decoupled_floor_qty = (parseInt($('input[name="decoupled_floor"]').val()) > 0) ? parseInt($('input[name="decoupled_floor"]').val()) : 0;
				aquastep_oak_floor_qty = (parseInt($('input[name="aquastep_oak_floor"]').val()) > 0) ? parseInt($('input[name="aquastep_oak_floor"]').val()) : 0;
				walls_to_timber_qty = (parseInt($('input[name="walls_to_timber"]').val()) > 0) ? parseInt($('input[name="walls_to_timber"]').val()) : 0;
				taller_walls_qty = (parseInt($('input[name="taller_walls"]').val()) > 0) ? parseInt($('input[name="taller_walls"]').val()) : 0;
				entry_steps_qty = (parseInt($('input[name="entry_steps"]').val()) > 0) ? parseInt($('input[name="entry_steps"]').val()) : 0;
				entry_handrail_qty = (parseInt($('input[name="entry_handrail"]').val()) > 0) ? parseInt($('input[name="entry_handrail"]').val()) : 0;
				skirt_qty = (parseInt($('input[name="skirt"]').val()) > 0) ? parseInt($('input[name="skirt"]').val()) : 0;

				// Calc various costs
				decoupled_floor_total = parseFloat(decoupled_floor_cost) * decoupled_floor_qty;
				aquastep_oak_floor_total = parseFloat(aquastep_oak_floor_cost) * aquastep_oak_floor_qty;
				walls_to_timber_total = parseFloat(walls_to_timber_cost) * walls_to_timber_qty;
				taller_walls_total = parseFloat(taller_walls_cost) * taller_walls_qty;
				entry_steps_total = parseFloat(entry_steps_cost) * entry_steps_qty;
				entry_handrail_total = parseFloat(entry_handrail_cost) * entry_handrail_qty;
				skirt_total = parseFloat(skirt_cost) * skirt_qty;

				// Total base cost + additionals
				cost = cost + decoupled_floor_total + aquastep_oak_floor_total + walls_to_timber_total + taller_walls_total + entry_steps_total + entry_handrail_total + skirt_total;

				// Display
				$('.total-amount').html('&pound;' + number_format(cost, 2));
			};

			// Calc price on select form change
			$('#other_form input').on('keyup', function(){
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