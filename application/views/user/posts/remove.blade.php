@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Case Study</h1></div>
<p><em>{{{ $post->title }}}</em></p>
<p>Are you sure you wish to remove this post?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/posts/update/{{{ $post->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection