@layout('templates.user')

@section('user_content')

<div class="btn-group pull-right">
  <a class="btn btn-default" href="/user/galleries/">Back to galleries</a>
  <a class="btn btn-default" href="/user/galleries/update/{{{ $gallery->id }}}">Edit gallery</a>
  <a class="btn btn-default" href="/user/galleries/addimage/{{{ $gallery->id }}}">Add image</a>
  <a class="btn btn-default" href="/user/galleries/addvideo/{{{ $gallery->id }}}">Add video</a>
</div>

<div class="page-header"><h1>Gallery: <small>{{{ $gallery->title }}}</small></h1></div>

<form method="post" role="form">
<table class="table">
  <thead>
    <tr>
      <th width="60"></th>
      <th>Title</th>
      <th>Type</th>
      <th>Sort Order</th>
      <th>Visible</th>
    </tr>
  </thead>
@foreach ($images as $image)
  <tr>
    <td><a href="/user/galleries/<?php if ($image->type == 'video') : ?>editvideo<?php else : ?>editimage<?php endif; ?>/{{ $image->id }}"><img src="{{{ $image->url_thumb }}}" alt="{{{ $image->alt }}}" title="{{{ $image->title }}}" class="img-thumbnail thumbnail-gallery"></a></td>
    <td><a href="/user/galleries/<?php if ($image->type == 'video') : ?>editvideo<?php else : ?>editimage<?php endif; ?>/{{ $image->id }}">{{{ $image->title }}}</a></td>
    <td>{{{ $image->type }}}</td>
    <td><input name="sort_order[{{{ $image->id }}}]" id="sort_order[{{{ $image->id }}}]" class="form-control" value="{{{ $image->sort_order }}}"></td>
    <td><?php if ($image->visibility == true) { ?><i class="glyphicon glyphicon-ok"></i><?php } else { ?><i class="glyphicon glyphicon-remove"></i><?php } ?></td>
  </tr>
@endforeach
</table>
<div class="form-group">
  <button type="submit" class="btn btn-info">Update Sort Order</button>
</div>
</form>

@endsection