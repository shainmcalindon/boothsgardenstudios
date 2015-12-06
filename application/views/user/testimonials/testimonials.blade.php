@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/testimonials/create/">Create testimaonial</a>
  </div>
</div>

<div class="page-header"><h1>Testimonials</h1></div>

{{ $testimonials->links() }}

<table class="table">
  <thead>
    <tr>
      <th>Client</th>
      <th>Visible</th>
      <th>Org</th>
    </tr>
  </thead>
  @foreach ($testimonials->results as $testimonial)
  <tr>
    <td>{{ HTML::link('user/testimonials/update/'.$testimonial->id, $testimonial->client) }}</td>
    <td><?php if ($testimonial->visibility == true) { ?><i class="glyphicon glyphicon-ok"></i><?php } else { ?><i class="glyphicon glyphicon-remove"></i><?php } ?></td>
    <td><?php if (count($testimonial->organisations) > 1) { ?>Both<?php } else foreach ($testimonial->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
  </tr>
  @endforeach
</table>

{{ $testimonials->links() }}

@endsection