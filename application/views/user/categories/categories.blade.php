@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/categories/create/">Create category</a>
  </div>
</div>

<div class="page-header"><h1>Categories</h1></div>

{{ $categories->links() }}

<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Org</th>
    </tr>
  </thead>
  @foreach ($categories->results as $category)
  <tr>
    <td>{{ HTML::link('user/categories/update/'.$category->id, $category->title) }}</td>
    <td><?php if (count($category->organisations) > 1) { ?>Both<?php } else foreach ($category->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
  </tr>
  @endforeach
</table>

{{ $categories->links() }}

@endsection