@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Image</h1></div>
<p><em>{{{ $image->title }}}</em></p>
<p>Are you sure you wish to remove this image from the gallery?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/galleries/editimage/{{{ $image->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection