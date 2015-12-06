@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove FAQ</h1></div>
<p><em>{{{ $faq->question }}}</em></p>
<p>Are you sure you wish to remove this FAQ?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/faqs/update/{{{ $faq->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection