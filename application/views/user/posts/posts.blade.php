@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/posts/create/">Create case study</a>
  </div>
</div>

<div class="page-header"><h1>Case Studies</h1></div>

{{ $posts->links() }}

<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Org</th>
      <th>Date created</th>
      <th>Visible</th>
    </tr>
  </thead>
  @foreach ($posts->results as $post)
  <tr>
    <td>{{ HTML::link('user/posts/update/'.$post->id, $post->title) }}</td>
    <td>{{ HTML::link('user/clients/'.$post->author->id, $post->author->nickname) }}</td>
    <td><?php if (count($post->organisations) > 1) { ?>Both<?php } else foreach ($post->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
    <td>{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
    <td><?php if ($post->visibility == true) { ?><i class="glyphicon glyphicon-ok"></i><?php } else { ?><i class="glyphicon glyphicon-remove"></i><?php } ?></td>
  </tr>
  @endforeach
</table>

{{ $posts->links() }}

@endsection