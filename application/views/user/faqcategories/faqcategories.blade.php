@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-primary" href="/user/faqcategories/create/">Create category</a>
  </div>
</div>

<div class="page-header"><h1>Faq Categories</h1></div>

<form method="post" role="form">
<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Sort Order</th>
      <th>Org</th>
    </tr>
  </thead>
  @foreach ($faqcategories as $faqcategory)
  <tr>
    <td>{{ HTML::link('user/faqcategories/update/'.$faqcategory->id, $faqcategory->title) }}</td>
    <td><input name="sort_order[{{{ $faqcategory->id }}}]" id="sort_order[{{{ $faqcategory->id }}}]" class="form-control" value="{{{ $faqcategory->sort_order }}}"></td>
    <td><?php if (count($faqcategory->organisations) > 1) { ?>Both<?php } else foreach ($faqcategory->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
  </tr>
  @endforeach
</table>
<div class="form-group">
  <button type="submit" class="btn btn-info">Update Sort Order</button>
</div>
</form>

@endsection