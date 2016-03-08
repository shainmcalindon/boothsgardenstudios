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
			<li>Interior</li>
			<li class="active">Other</li>
			<li class="active">Complete</li>
		</ol>

		<h4>ADD VENETIAN BLINDS</h4>

		<form action="{{ action('quotations@add_other') }}" method="post">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add a Silver Aluminum Venitian Blind with "no screws required" brackets</label>
							<select name="silver_aluminum" class="form-control">
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
							<label>Add recessed blinds (held secure in frame around window)</label>
							<select name="recessed-blinds" class="form-control">
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
				<h4>ADD INTERNAL WALLS AND DOORS</h4>				
			</div>

			<div class="clearfix"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
							<label>Add Internal 910mm Partition Wall/Walls (create 2 rooms within your Studio)</label>
							<input type="text" name="internal_901mm" class="form-control">
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
							<label>Add Internal door when dividing Studio (gives access between 2 rooms)</label>
							<input type="text" name="internal_door" class="form-control">
							
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
							<label>Add internal wall corner post (when internal 3ft walls are at right angles to each other</label>
							<input type="text" name="internal_wall_corner" class="form-control">
							
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
				<a href="#" class="btn btn-grey" onclick="window.history.back();">back</a>
				
				<button class="btn btn-dark">Other ></button>
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