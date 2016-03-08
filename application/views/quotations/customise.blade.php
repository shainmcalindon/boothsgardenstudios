@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
	<p class="text-right"><small>Your studio Including delivery and Installation</small> <span class="total-amount">&pound;15,830.00</span></p>

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

		<div class="col-md-8">
			<div class="row">
				<form action="{{ action('quotations@add_decking') }}" method="post">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Swap a window for a wall</label>
							<select name="swap_wall" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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
							<label>Swap a window for a window</label>
							<select name="swap_window" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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
							<label>Add an extra door</label>
							<select name="extra_door" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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
							<label>Add a fanlight window</label>
							<select name="fanlight" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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
							<label>Add a half window</label>
							<select name="half_window" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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
							<label>Add an 1820 picture window</label>
							<select name="picture_window" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
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

					<a href="{{ url('/quotations') }}" class="btn btn-grey">back</a>
					<button class="btn btn-dark">Decking &amp; Flyover ></button>
				</form>
			</div>
		</div>
	</div>	
@endsection

@section('script')
	<script>
		$(function () {
		  $('[data-toggle="popover"]').popover({container: 'body'})
		})
	</script>
@endsection