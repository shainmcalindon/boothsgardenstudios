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
			<li>Decking &amp; flyover</li>
			<li class="active">Electrics</li>
			<li class="active">Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD DECKING (BESPOKE DECKING AVAILABLE @&pound;280 M<sup>2</sup>)</h4>
		<p>Add some decking to your studio</p>
		<p>Available decking slots: <b><span id="decking_available_slots">{{$data->maximum_slots}}</span></b></p>
		<p>Allocated decking slots: <b><span id="decking_allocated_slots">0</span></b></p>

		<form action="{{ action('quotations@add_electrics') }}" method="post" id="decking_form">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a solid composite deck which is 910mm wide and 910mm deep</label>
							<select name="dec_910" class="form-control decking">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->composite_deck_910_910)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->composite_deck_910_910}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a solic composite deck which is 910mm wide and 1820mm deep</label>
							<select name="dec_1820" class="form-control decking">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->composite_deck_910_1820)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->composite_deck_910_1820}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a solic composite deck which is 910mm wide and 2730mm deep</label>
							<select name="dec_2730" class="form-control decking">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->composite_deck_910_2730)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->composite_deck_910_2730}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>


			<div class="col-md-12">
				<h4>ADD A FLYOVER ROOF TO FRONT OF STUDIO (BESPOKE FLYOVER AVAILABLE @&pound;200 M<sup>2</sup>)</h4>
				<p>Add some flyover to your studio</p>
				<p>Available flyover slots: <b><span id="flyover_available_slots">{{$data->maximum_slots}}</span></b></p>
				<p>Allocated flyover slots: <b><span id="flyover_allocated_slots">0</span></b></p>
			</div>

			<div class="clearfix"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wid ewith a 910mm projection</label>
							<select name="roof_910" class="form-control flyover">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->flyover_roof_910_910)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->flyover_roof_910_910}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wide with a 1820mm projection</label>
							<select name="roof_1820" class="form-control flyover">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->flyover_roof_910_1820)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->flyover_roof_910_1820}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wide with a 2730mm projection</label>
							<select name="roof_2730" class="form-control flyover">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->flyover_roof_910_2730)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info"
								data-placement="right"
								data-trigger="focus"
								data-toggle="popover"
								data-content="{{$data->help->flyover_roof_910_2730}}">
							<span class="label label-primary">?</span>
						</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-md-12">
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				<button class="btn btn-dark">Electrics ></button>
			</div>
		</form>
	</div>	
@endsection

@section('script')
	<script>
		maximum_slots = {{$data->maximum_slots}};
		singleLargeSideSlots = {{$data->sizeSlots->singleLargeSideSlots}};
		singleSmallSideSlots = {{$data->sizeSlots->singleSmallSideSlots}};

		// Initial cost
		init_cost = "{{$data->costs->init_cost}}";

		// Costs
		composite_deck_910_910_cost = "{{$data->costs->composite_deck_910_910}}";
		composite_deck_910_1820_cost = "{{$data->costs->composite_deck_910_1820}}";
		composite_deck_910_2730_cost = "{{$data->costs->composite_deck_910_2730}}";
		flyover_roof_910_910_cost = "{{$data->costs->flyover_roof_910_910}}";
		flyover_roof_910_1820_cost = "{{$data->costs->flyover_roof_910_1820}}";
		flyover_roof_910_2730_cost = "{{$data->costs->flyover_roof_910_2730}}";

		// Available slots
		available_decking_slots = {{$data->maximum_slots}};
		available_flyover_slots = {{$data->maximum_slots}};

		jQuery(function($){
			// Popover
			$('[data-toggle="popover"]').popover({container: 'body'});

			// Update options and stats
			var updateStats = function(){
				// Decking stats
				available = maximum_slots;
				used = 0;
				used = used + parseInt($('select[name="dec_910"]').val());
				used = used + parseInt($('select[name="dec_1820"]').val());
				used = used + parseInt($('select[name="dec_2730"]').val());
				$('#decking_available_slots').text(available - used);
				$('#decking_allocated_slots').text(used);

				// Flyover
				available = maximum_slots;
				used = 0;
				used = used + parseInt($('select[name="roof_910"]').val());
				used = used + parseInt($('select[name="roof_1820"]').val());
				used = used + parseInt($('select[name="roof_2730"]').val());
				$('#flyover_available_slots').text(available - used);
				$('#flyover_allocated_slots').text(used);
			};

			// Calc price
			var calcPrice = function(){
				// Studio Beginning Cost
				cost = parseFloat(init_cost);

				// Calc various costs
				composite_deck_910_910_total = parseFloat(composite_deck_910_910_cost) * $('select[name="dec_910"]').val();
				composite_deck_910_1820_total = parseFloat(composite_deck_910_1820_cost) * $('select[name="dec_1820"]').val();
				composite_deck_910_2730_total = parseFloat(composite_deck_910_2730_cost) * $('select[name="dec_2730"]').val();
				flyover_roof_910_910_total = parseFloat(flyover_roof_910_910_cost) * $('select[name="roof_910"]').val();
				flyover_roof_910_1820_total = parseFloat(flyover_roof_910_1820_cost) * $('select[name="roof_1820"]').val();
				flyover_roof_910_2730_total = parseFloat(flyover_roof_910_2730_cost) * $('select[name="roof_2730"]').val();

				// Total base cost + additionals
				cost = cost + composite_deck_910_910_total + composite_deck_910_1820_total + composite_deck_910_2730_total + flyover_roof_910_910_total + flyover_roof_910_1820_total + flyover_roof_910_2730_total;

				// Display
				$('.total-amount').html('&pound;' + number_format(cost, 2));
			};

			// Update available options so its not possible to select invalid numbers
			var updateOptionSelect = function(){
				// Decking
				available_decking_slots = parseInt($('#decking_available_slots').text());
				$('select.decking').each(function(){
					// Remove any options which if selected will use up more than the available slots
					max = parseInt($(this).val()) + available_decking_slots;
					$('option', this).slice(max + 1).remove();

					// Make sure each additional window / door field has enough slots to fill up any available space
					// For example if we replace a window for a wall, there is now 1 more space available for an additional door / window
					// We need to make sure if we have 6 extra doors already selected, a new option for 7 should appear allowing the user to use up the newly available slot for another door if they wished
					totalOptions = $('option', this).length - 1; // Subtract the 0 attribute
					lastOption = $('option', this).last();

					// We use the index of the current select, last select and available wall space to determine if there is enough extra slots to fill up the remaining available space if user desired
					currentSelectedIdx = $(':selected', this).index();
					lastIdex = lastOption.index();

					// Do we need to create any additional slots
					addNew = (currentSelectedIdx + available_decking_slots) - lastIdex;
					if(addNew > 0){
						// Create the missing option values
						for(a=1; a <= addNew; a++){
							value = parseInt(lastOption.val()) + a;
							$(this).append('<option value="' + value + '">' + value + '</option>');
						}
					}
				});

				// Flyover
				available_flyover_slots = parseInt($('#flyover_available_slots').text());
				$('select.flyover').each(function(){
					// Remove any options which if selected will use up more than the available slots
					max = parseInt($(this).val()) + available_flyover_slots;
					$('option', this).slice(max + 1).remove();

					// Make sure each additional window / door field has enough slots to fill up any available space
					// For example if we replace a window for a wall, there is now 1 more space available for an additional door / window
					// We need to make sure if we have 6 extra doors already selected, a new option for 7 should appear allowing the user to use up the newly available slot for another door if they wished
					totalOptions = $('option', this).length - 1; // Subtract the 0 attribute
					lastOption = $('option', this).last();

					// We use the index of the current select, last select and available wall space to determine if there is enough extra slots to fill up the remaining available space if user desired
					currentSelectedIdx = $(':selected', this).index();
					lastIdex = lastOption.index();

					// Do we need to create any additional slots
					addNew = (currentSelectedIdx + available_flyover_slots) - lastIdex;
					if(addNew > 0){
						// Create the missing option values
						for(a=1; a <= addNew; a++){
							value = parseInt(lastOption.val()) + a;
							$(this).append('<option value="' + value + '">' + value + '</option>');
						}
					}
				});
			};

			// Calc price on select form change
			$('#decking_form select').on('change', function(){
				updateStats();
				calcPrice();
				updateOptionSelect();
			});

			// Sync screen on page load
			updateStats();
			calcPrice();
			updateOptionSelect();
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