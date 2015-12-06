@layout('templates.user')

@section('user_content')

<div class="pull-right"><a class="btn btn-default" href="/user/galleries/">Back to galleries</a></div>

<div class="page-header"><h1>Create New Gallery</h1></div>

@include('widgets.errors')

@include('user.galleries._form')

@endsection