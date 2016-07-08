@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')

<!-- Show errors messages -->
@if($data['error'])
  <div id="error_message" class="alert alert-danger" role="alert">{{ $data['error'] }}</div>
@endif

@if($data['success'])
  <div class="alert alert-success" role="alert">{{$data['success']}}</div>
@else
    @if($data['establishedQuote'])
      <div class="alert alert-info" role="alert">You are viewing a partly completed quotation, why not continue to build your dream studio!</div>
    @endif
@endif

<div class="pull-right">
    <form action="/quotations/view" method="get" id="change_studio_form">
      <select class="form-control" name="layout_id">
        <option disabled selected>View alternative {{ $data['layout']->studio->name }} sizes</option>
        @foreach ($data['layouts'] as $l)
          <option value="{{{ $l->id }}}">{{{ $l->size_x }}}mm x {{{ $l->size_y }}}mm</option>
        @endforeach
      </select>
    </form>
<!-- to do: add JS to jump to page ID -->
</div>
<h1>{{{ $data['layout']->studio->name }}} <small>{{{ $data['layout']->size_x }}}mm x {{{ $data['layout']->size_y }}}mm</small></h1>
<div class="clearfix"></div>
<span class="hidden-xs">{{ $data['layout']->description }}</span>
<div class="row">
  <div class="col-sm-6 col-sm-push-6">
      @if($data['establishedQuote'])
        <p style="font-size: 40px; text-align: center; color: #f49033;">Price:<em><b>{{{ $data['quotation_current_price'] }}}</b></em></p>
        <p style="font-size: 14px; text-align: center; color: #f49033;">Initial Studio Price:<em><b>{{{ $data['formatted_cost'] }}}</b></em></p>
      @else
        <p style="font-size: 40px; text-align: center; color: #f49033;">Price: <em><b>{{{ $data['formatted_cost'] }}}</b></em></p>
      @endif

      <form action="/quotations/customise" method="post" style="text-align: center;" id="customise_form">
        Delivering to:<br />
        <input type="text" value="{{$data['postcode']}}" name="postcode" placeholder="Enter postcode" id="quotationsViewPostcodeField"/>
        <input type="hidden" value="{{$data['size']}}" name="size" />
        <input type="hidden" value="{{$data['layout_id']}}" name="layout_id" />
        @if($data['establishedQuote'])
          <button style="margin: 8px auto auto; display: block;" class="btn btn-primary btn-lg">Continue with your dream studio</button>
          <a href="/quotations/reset" style="width: 146px; margin: 8px auto auto; display: block;" class="btn btn-primary">Start again</a>
        @else
          <button style="margin: 8px auto auto; display: block;" class="btn btn-primary btn-lg">Configure your dream studio</button>
        @endif
      </form>

    </p>
  </div>
  <div class="col-md-6 col-sm-pull-6">
    <div class="row">
      <div class="col-sm-6"><img src="{{(strlen($data['layout']->plan_image)) ? $data['layout']->plan_image : 'http://ingridwu.dmmdmcfatter.com/wp-content/uploads/2015/01/placeholder.png'}}" class="img-responsive"></div>
      <div class="col-sm-6"><img src="{{(strlen($data['layout']->feature_image)) ? $data['layout']->feature_image : 'http://ingridwu.dmmdmcfatter.com/wp-content/uploads/2015/01/placeholder.png'}}" class="img-responsive"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <h2>Standard Specification</h2>
    @if(strlen($data['layout']->specification) > 1)
      {{$data['layout']->specification}}
    @else
      No description has been set.
    @endif
  </div>
  <div class="col-sm-6">
    <h2>Dimensions</h2>
    <table class="table table-bordered table-condensed table-striped">
      <tr>
        <td>&nbsp;</td>
        <td><b>Width</b></td>
        <td><b>Depth</b></td>
        <td><b>Height</b></td>
        <td><b>Floor Area</b></td>
      </tr>
      <tr>
        <td><b>Internal</b></td>
        <td>{{{ $data['layout']->size_x }}}mm</td>
        <td>{{{ $data['layout']->size_y }}}mm</td>
        <td>2080mm</td>
        <td><?= number_format(($data['layout']->size_x * $data['layout']->size_y) / 1000000, 2) ?>m<sup>2</sup></td>
      </tr>
      <tr>
        <td><b>External</b></td>
        <td>{{{ $data['layout']->size_x + 550 }}}mm</td>
        <td>{{{ $data['layout']->size_y + 550 }}}mm</td>
        <td>2500mm</td>
        <td><?= number_format((($data['layout']->size_x + 550) * ($data['layout']->size_y + 550)) / 1000000, 2) ?>m<sup>2</sup></td>
      </tr>
      
    </table>
  </div>
</div>
@endsection

@section('script')
  <script>
    jQuery(function($){
      $('#change_studio_form select').on('change', function(){
        $('#change_studio_form').submit();
      });

      @if($data['establishedQuote'])
        $('#change_studio_form').submit(function(e){
          if (confirm('You have an open quote which is currently in progress, if you choose a different studio, your customisations will be lost. Click "Ok" if you wish to continue.')) {
            return true;
          } else {
            return false;
          }
        });
      @endif
    });
  </script>
@endsection