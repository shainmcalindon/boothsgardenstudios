@layout('templates.user')

@section('user_content')

<div class="pull-right"><a class="btn btn-default" href="/user/faqcategories/">Back to categories</a></div>

<div class="page-header"><h1>Create New Faq Category</h1></div>

@include('widgets.errors')

@include('user.faqcategories._form')

@endsection