@layout('templates.user')

@section('user_content')

<div class="pull-right"><a class="btn btn-default" href="/user/categories/">Back to FAQ's</a></div>

<div class="page-header"><h1>Create New FAQ</h1></div>

@include('widgets.errors')

@include('user.faqs._form')

@endsection