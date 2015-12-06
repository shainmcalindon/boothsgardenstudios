@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Page</h1></div>
<p><em>{{{ $page->title }}}</em></p>
<p>Are you sure you wish to remove this page?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/pages/update/{{{ $page->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection