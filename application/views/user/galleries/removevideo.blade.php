@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Video</h1></div>
<p><em>{{{ $video->title }}}</em></p>
<p>Are you sure you wish to remove this video from the gallery?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/galleries/editvideo/{{{ $video->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection