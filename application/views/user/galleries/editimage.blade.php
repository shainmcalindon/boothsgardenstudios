@layout('templates.user')

@section('user_content')

<div class="pull-right"><a class="btn btn-default" href="/user/galleries/view/{{{ $gallery->id }}}">Back to gallery</a></div>

<div class="page-header"><h1>{{{ $gallery->title }}}: <small>Edit Image</small></h1></div>

@include('widgets.errors')

@include('user.galleries._form_image')

@endsection