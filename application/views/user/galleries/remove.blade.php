@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Gallery</h1></div>
<p><em>{{{ $galery->title }}}</em></p>
<p>Are you sure you wish to remove this gallery?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/galleries/update/{{{ $gallery->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection