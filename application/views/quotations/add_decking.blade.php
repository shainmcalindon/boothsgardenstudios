@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
	<p class="text-right"><small>Your studio Including delivery and Installation</small> <span class="total-amount">&pound;15,830.00</span></p>

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

		<form action="{{ action('quotations@add_electrics') }}" method="post">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a solid composite deck which is 910mm wide and 910mm deep</label>
							<select name="dec_910" class="form-control">
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
							<label>Add a solic composite deck which is 910mm wide and 1820mm deep</label>
							<select name="dec_1820" class="form-control">
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
							<label>Add a solic composite deck which is 910mm wide and 2730mm deep</label>
							<select name="dec_2730" class="form-control">
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
				</div>
			</div>
			<div class="clearfix"></div>


			<div class="col-md-12">
				<h4>ADD A FLYOVER ROOF TO FRONT OF STUDIO (BESPOKE FLYOVER AVAILABLE @&pound;200 M<sup>2</sup>)</h4>				
			</div>

			<div class="clearfix"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wid ewith a 910mm projection</label>
							<select name="roof_910" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<a href="" class="flyout-info"><span class="label label-primary">?</span></a>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wide with a 1820mm projection</label>
							<select name="roof_1820" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<a href="" class="flyout-info"><span class="label label-primary">?</span></a>
					</div>
					<div class="clearfix"></div>

					<div class="col-xs-11">
						<div class="form-group">
							<label>A flyover roof 910mm wide with a 2730mm projection</label>
							<select name="roof_2730" class="form-control">
								@for ($i = 0; $i < 10; $i++)
								    <option value="">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-xs-1 flyout">
						<a href="" class="flyout-info"><span class="label label-primary">?</span></a>
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
		$(function () {
		  $('[data-toggle="popover"]').popover({container: 'body'})
		})
	</script>
@endsection