@layout('templates.user')

@section('user_content')

<div class="pull-right"><a class="btn btn-default" href="/user/posts/">Back to case studies</a></div>

<div class="page-header"><h1>Create New Case Study</h1></div>

@include('widgets.errors')

@include('user.posts._form')

@endsection