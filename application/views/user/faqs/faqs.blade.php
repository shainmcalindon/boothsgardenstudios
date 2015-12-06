@layout('templates.user')

@section('user_content')

<div class="pull-right">
  <div class="btn-group">
    <a class="btn btn-default" href="/user/faqs/create/">Create FAQ</a>
  </div>
</div>

<div class="page-header"><h1>FAQ's</h1></div>

<form method="post" role="form">
<table class="table">
  <thead>
    <tr>
      <th>Question</th>
      <th>Sort Order</th>
      <th>Org</th>
    </tr>
  </thead>
  @foreach ($faqs as $faq)
  <tr>
    <td>{{ HTML::link('user/faqs/update/'.$faq->id, $faq->question) }}</td>
    <td><input name="sort_order[{{{ $faq->id }}}]" id="sort_order[{{{ $faq->id }}}]" class="form-control" value="{{{ $faq->sort_order }}}"></td>
    <td><?php if (count($faq->organisations) > 1) { ?>Both<?php } else foreach ($faq->organisations as $org) { ?>{{ $org->short_name }}<?php } ?></td>
  </tr>
  @endforeach
</table>
<div class="form-group">
  <button type="submit" class="btn btn-info">Update Sort Order</button>
</div>
</form>

@endsection