@layout('templates.main')

@section('content')
<div class="pull-right">
<select class="form-control">
  <option disabled selected>View alternative {{{ $data['layout']->studio->name }}} sizes</option>
  @foreach ($data['layouts'] as $l)
    <option value="{{{ $l->id }}}">{{{ $l->size_x }}}mm x {{{ $l->size_y }}}mm</option>
  @endforeach
</select>
<!-- to do: add JS to jump to page ID -->
</div>
<h1>{{{ $data['layout']->studio->name }}} <small>{{{ $data['layout']->size_x }}}mm x {{{ $data['layout']->size_y }}}mm</small></h1>
<div class="clearfix"></div>
<span class="hidden-xs">{{ $data['layout']->description }}</span>
<div class="row">
  <div class="col-sm-6 col-sm-push-6">
    <p style="font-size: 40px; text-align: center; color: #f49033;">Price: <em><b>{{{ $data['formatted_cost'] }}}</b></em></p>
    <p style="text-align: center; margin-top: 20px;"><button class="btn btn-primary btn-lg">Configure your dream studio</button></p>
  </div>
  <div class="col-md-6 col-sm-pull-6">
    <div class="row">
      <div class="col-sm-6"><img src="{{{ $data['layout']->plan_image }}}" class="img-responsive"></div>
      <div class="col-sm-6"><img src="{{{ $data['layout']->feature_image }}}" class="img-responsive"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <h2>Standard Specification</h2>
    {{ $data['layout']->specification }}
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