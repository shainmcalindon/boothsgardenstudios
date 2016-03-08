@layout('templates.user')

@section('user_content') 

<div class="pull-right"><a class="btn btn-default" href="/user/pages/">Back to pages</a></div>

<div class="page-header"><h1>Update Page</h1></div>

@include('widgets.errors')

@include('user.pages._form')

@endsection