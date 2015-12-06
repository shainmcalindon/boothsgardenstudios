@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/pages/create/">Create page</a>
  </div>
</div>

<div class="page-header"><h1>Pages</h1></div>

{{ $pages->links() }}

<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Org</th>
      <th>Visible</th>
    </tr>
  </thead>
  @foreach ($pages->results as $page)
  <tr>
    <td>{{ HTML::link('user/pages/update/'.$page->id, $page->title) }}</td>
    <td>{{ HTML::link('user/clients/'.$page->author->id, $page->author->nickname) }}</td>
    <td><?php if (count($page->organisations) > 1) { ?>Both<?php } else foreach ($page->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
    <td><?php if ($page->visibility == true) { ?><i class="glyphicon glyphicon-ok"></i><?php } else { ?><i class="glyphicon glyphicon-remove"></i><?php } ?></td>
  </tr>
  @endforeach
</table>

{{ $pages->links() }}

@endsection