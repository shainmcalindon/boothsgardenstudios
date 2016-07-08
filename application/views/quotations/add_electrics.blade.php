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
			<li>Electrics</li>
			<li class="active">Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD ADDITIONAL ELECTRIC FITTINGS</h4>

		<form action="{{ action('quotations@add_interior') }}" method="post" id="electrics_form">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add more double sockets at a height of 450mm from floor</label>
							<input type="text" name="sockets_450" class="form-control" value="@if(!empty($data->defaults->electrics_double_sockets_450)){{$data->defaults->electrics_double_sockets_450}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->electrics_double_sockets_450}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add double sockets abgove worktop height (approx 1150mm from floor)</label>
							<input type="text" name="sockets_1150" class="form-control" value="@if(!empty($data->defaults->electrics_double_sockets_1150)){{$data->defaults->electrics_double_sockets_1150}}@endif">
							
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->electrics_double_sockets_1150}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add light switches if you divide room all room require a light switch</label>
							<input type="text" name="light_switches" class="form-control" value="@if(!empty($data->defaults->electrics_light_switch)){{$data->defaults->electrics_light_switch}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->electrics_light_switch}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add panel heater fitted with fused socket</label>
							<input type="text" name="panel_heater" class="form-control" value="@if(!empty($data->defaults->electrics_panel_heater)){{$data->defaults->electrics_panel_heater}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->electrics_panel_heater}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a double floor socket - avoids appliance cables running across floor</label>
							<input type="text" name="double_floor_socket" class="form-control" value="@if(!empty($data->defaults->electrics_double_floor_socket)){{$data->defaults->electrics_double_floor_socket}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->electrics_double_floor_socket}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add Fused spur socket for air conditioning etc</label>
							<input type="text" name="spur_socket" class="form-control" value="@if(!empty($data->defaults->electrics_fused_spur_socket)){{$data->defaults->electrics_fused_spur_socket}}@endif">
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->electrics_fused_spur_socket}}">
							<span class="label label-primary">?</span>
						</button>
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
		// Initial cost
		init_cost = "{{$data->costs->init_cost}}";

		// Costs
		electrics_double_sockets_450_cost = "{{$data->costs->electrics_double_sockets_450}}";
		electrics_double_sockets_1150_cost = "{{$data->costs->electrics_double_sockets_1150}}";
		electrics_light_switch_cost = "{{$data->costs->electrics_light_switch}}";
		electrics_panel_heater_cost = "{{$data->costs->electrics_panel_heater}}";
		electrics_double_floor_socket_cost = "{{$data->costs->electrics_double_floor_socket}}";
		electrics_fused_spur_socket_cost = "{{$data->costs->electrics_fused_spur_socket}}";

		jQuery(function($){
			// Popover
			$('[data-toggle="popover"]').popover({container: 'body'});

			// Calc price
			var calcPrice = function(){
				// Studio Beginning Cost
				cost = parseFloat(init_cost);

				// Work out quantities
				sockets_450_qty = (parseInt($('input[name="sockets_450"]').val()) > 0) ? parseInt($('input[name="sockets_450"]').val()) : 0;
				sockets_1150_qty = (parseInt($('input[name="sockets_1150"]').val()) > 0) ? parseInt($('input[name="sockets_1150"]').val()) : 0;
				light_switches_qty = (parseInt($('input[name="light_switches"]').val()) > 0) ? parseInt($('input[name="light_switches"]').val()) : 0;
				panel_heater_qty = (parseInt($('input[name="panel_heater"]').val()) > 0) ? parseInt($('input[name="panel_heater"]').val()) : 0;
				double_floor_socket_qty = (parseInt($('input[name="double_floor_socket"]').val()) > 0) ? parseInt($('input[name="double_floor_socket"]').val()) : 0;
				spur_socket_qty = (parseInt($('input[name="spur_socket"]').val()) > 0) ? parseInt($('input[name="spur_socket"]').val()) : 0;

				// Calc various costs
				electrics_double_sockets_450_total = parseFloat(electrics_double_sockets_450_cost) * sockets_450_qty;
				electrics_double_sockets_1150_total = parseFloat(electrics_double_sockets_1150_cost) * sockets_1150_qty;
				electrics_light_switch_total = parseFloat(electrics_light_switch_cost) * light_switches_qty;
				electrics_panel_heater_total = parseFloat(electrics_panel_heater_cost) * panel_heater_qty;
				electrics_double_floor_socket_total = parseFloat(electrics_double_floor_socket_cost) * double_floor_socket_qty;
				electrics_fused_spur_socket_total = parseFloat(electrics_fused_spur_socket_cost) * spur_socket_qty;

				// Total base cost + additionals
				cost = cost + electrics_double_sockets_450_total + electrics_double_sockets_1150_total + electrics_light_switch_total + electrics_panel_heater_total + electrics_double_floor_socket_total + electrics_fused_spur_socket_total;

				// Display
				$('.total-amount').html('&pound;' + number_format(cost, 2));
			};

			// Allow only numbers to be entered
			$('#electrics_form').keydown(function (e) {
				setTimeout(function(){
					calcPrice();
				}, 500);

				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
						// Allow: Ctrl+A, Command+A
						(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
						// Allow: home, end, left, right, down, up
						(e.keyCode >= 35 && e.keyCode <= 40)) {
					// let it happen, don't do anything
					return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});

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