@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Update Pricing <small>{{{ $name }}}</small></h1></div>

@include('widgets.errors')

@include('user.pricing._form')

@endsection