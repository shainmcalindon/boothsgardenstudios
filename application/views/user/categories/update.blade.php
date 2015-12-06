@layout('templates.user')

@section('user_content') 

<div class="pull-right"><a class="btn btn-default" href="/user/categories/">Back to categories</a></div>

<div class="page-header"><h1>Update Category</h1></div>

@include('widgets.errors')

@include('user.categories._form')

@endsection