@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/galleries/create/">Create gallery</a>
  </div>
</div>

<div class="page-header"><h1>Galleries</h1></div>

<form method="post" role="form">
<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Sort Order</th>
      <th>Org</th>
      <th>Visible</th>
    </tr>
  </thead>
  @foreach ($galleries as $gallery)
  <tr>
    <td>{{ HTML::link('user/galleries/view/'.$gallery->id, $gallery->title) }}</td>
    <td><input name="sort_order[{{{ $gallery->id }}}]" id="sort_order[{{{ $gallery->id }}}]" class="form-control" value="{{{ $gallery->sort_order }}}"></td>
    <td><?php if (count($gallery->organisations) > 1) { ?>Both<?php } else foreach ($gallery->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
    <td><?php if ($gallery->visibility == true) { ?><i class="glyphicon glyphicon-ok"></i><?php } else { ?><i class="glyphicon glyphicon-remove"></i><?php } ?></td>
  </tr>
  @endforeach
</table>
<div class="form-group">
  <button type="submit" class="btn btn-info">Update Sort Order</button>
</div>
</form>

@endsection