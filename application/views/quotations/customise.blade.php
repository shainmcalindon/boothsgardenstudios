@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
	<p class="text-right">
		<small>Your studio Including delivery and Installation up to this stage</small>
		<span class="total-amount">{{ $data->layout->formatted_cost }}</span>
	</p>
	<p class="text-right" style="margin-top: -1em;">
		<small>Delivery {{$data->delivery['totalDistance']}} miles to {{\Laravel\Session::get('quote_postcode')}}: &pound;{{number_format($data->delivery['price'], 2)}}</small>
	</p>

	<div class="quotation-block">
		<ol class="breadcrumb">
			<li>Windows &amp; doors</li>
			<li class="active">Decking &amp; flyover</li>
			<li class="active">Electrics</li>
			<li class="active">Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD EXTRA WINDOWS AND DOORS</h4>
		<p>Your studio is split into individual partitions (slots), you can add walls, windows and doors filling up the available slots. By default we have allocated 1 door and {{$data->allocated_doors_windows - 1}} windows to one of the larger sides of the studio, you can customise your layout below.</p>
		<p>Maximum Slots Available: <b><span id="maximum_slots">{{$data->maximum_slots}}</span></b></p>
		<p>Allocated to door / windows: <b><span id="allocated_doors_windows">{{$data->allocated_doors_windows}}</span></b></p>
		<p>Allocated to walls: <b><span id="allocated_walls">{{$data->allocated_walls}}</span></b></p>

		<div class="col-md-8">
			<div class="row">
				<form id="customise_form" action="{{ action('quotations@add_decking') }}" method="post">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Swap a window for a wall</label>
							<select name="swap_window" class="form-control">
								@for ($i = 0; $i < $data->sizeSlots->singleLargeSideSlots; $i++)
									<option @if($i == $data->defaults->swap_window_wall)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->swap_window_wall}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Swap a wall for a window</label>
							<select name="swap_wall" class="form-control">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->swap_wall_window)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->swap_wall_window}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add an extra door</label>
							<select name="extra_door" class="form-control">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->add_extra_door)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->add_extra_door}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a fanlight window</label>
							<select name="fanlight" class="form-control">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->add_fanlight_window)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->add_fanlight_window}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a half window</label>
							<select name="half_window" class="form-control">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->add_half_window)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->add_half_window}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>Add an 1820 picture window</label>
							<select name="picture_window" class="form-control">
								@for ($i = 0; $i < $data->maximum_slots + 1; $i++)
								    <option @if($i == $data->defaults->add_1820_window)selected="selected"@endif value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<button type="button" class="flyout-info" 
							data-placement="right"
							data-trigger="focus"
							data-toggle="popover"
							data-content="{{$data->help->add_1820_window}}">
								<span class="label label-primary">?</span>
							</button>
					</div>
					<div class="clearfix"></div>

					<a href="{{ url('/quotations/view/' . $data->layout->id) }}" class="btn btn-grey">back</a>
					<button class="btn btn-dark">Decking &amp; Flyover ></button>
				</form>
			</div>
		</div>
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
		swap_window_wall_cost = "{{$data->costs->swap_window_wall}}";
		swap_wall_window_cost = "{{$data->costs->swap_wall_window}}";
		add_extra_door_cost = "{{$data->costs->add_extra_door}}";
		add_fanlight_window_cost = "{{$data->costs->add_fanlight_window}}";
		add_half_window_cost = "{{$data->costs->add_half_window}}";
		add_1820_window_cost = "{{$data->costs->add_1820_window}}";

        jQuery(function($){
			// Popover
            $('[data-toggle="popover"]').popover({container: 'body'});

			// Update options and stats
			var updateStats = function(){
				mSlots = maximum_slots;
				doors_walls_slots = singleLargeSideSlots; // By default we allocate 1 door and remaining slots on the same side as a window (one of the larger sides)
				walls_slots = 0;

				// Are we swapping any of the default windows for a wall?
				if($('select[name="swap_window"]').val() > 0){
					doors_walls_slots = doors_walls_slots - $('select[name="swap_window"]').val();
				}

				// Update allocation of additional doors and windows
				doors_walls_slots = doors_walls_slots + parseInt($('select[name="swap_wall"]').val());
				doors_walls_slots = doors_walls_slots + parseInt($('select[name="extra_door"]').val());
				doors_walls_slots = doors_walls_slots + parseInt($('select[name="fanlight"]').val());
				doors_walls_slots = doors_walls_slots + parseInt($('select[name="half_window"]').val());
				doors_walls_slots = doors_walls_slots + parseInt($('select[name="picture_window"]').val());

				// Calc allocated wall slots
				walls_slots = mSlots - doors_walls_slots;

				// Update allocated slots
				$('#allocated_doors_windows').text(doors_walls_slots);
				$('#allocated_walls').text(walls_slots);
			};

			// Calc price
			var calcPrice = function(){
				// Studio Beginning Cost
				cost = parseFloat(init_cost);

				// Calc various costs
				swap_window_wall_total = parseFloat(swap_window_wall_cost) * $('select[name="swap_window"]').val();
				swap_wall_window_total = parseFloat(swap_wall_window_cost) * $('select[name="swap_wall"]').val();
				add_extra_door_total = parseFloat(add_extra_door_cost) * $('select[name="extra_door"]').val();
				add_fanlight_window_total = parseFloat(add_fanlight_window_cost) * $('select[name="fanlight"]').val();
				add_half_window_total = parseFloat(add_half_window_cost) * $('select[name="half_window"]').val();
				add_1820_window_total = parseFloat(add_1820_window_cost) * $('select[name="picture_window"]').val();

				// Total base cost + additionals
				cost = cost + swap_window_wall_total + swap_wall_window_total + add_extra_door_total + add_fanlight_window_total + add_half_window_total + add_1820_window_total;

				// Display
				$('.total-amount').html('&pound;' + number_format(cost, 2));
			};

			// Update available options so its not possible to select invalid numbers
			var updateOptionSelect = function(){
				available_walls = parseInt($('#allocated_walls').text());

				$('#customise_form select').each(function(){
					// We do not need to perform any updates to the swap_windows field
					if($(this).attr('name') == "swap_window") return true;

					// Remove any options which if selected will use up more than the available slots
					max = parseInt($(this).val()) + available_walls;
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
					addNew = (currentSelectedIdx + available_walls) - lastIdex;
					if(addNew > 0){
						// Create the missing option values
						for(a=1; a <= addNew; a++){
							value = parseInt(lastOption.val()) + a;
							$(this).append('<option value="' + value + '">' + value + '</option>');
						}
					}
				});
			}

			// Remember previous value for reverting back if required
			$('#customise_form select').on('focus', function(){
				$(this).attr('data-previous', $(this).val());
			});

			// Calc price on select form change
			$('#customise_form select').on('change', function(){
				if($(this).attr('name') == "swap_window"){
					// How many slots do we need to make this change?
					requiredSlots = Math.abs($(this).val() - $('option', this).last().val());
					available_walls = parseInt($('#allocated_walls').text());

					// Select previous value / same as if no selection was made
					if(available_walls < requiredSlots){
						$(this).val($(this).attr('data-previous'));
						alert('You need to remove some of the extra doors and windows, before you can swap a wall back to a window!');
						return false;
					}
				}

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