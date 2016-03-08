@layout('templates.user')

@section('user_content') 

<div class="pull-right"><a class="btn btn-default" href="/user/testimonials/">Back to testimonials</a></div>

<div class="page-header"><h1>Update Testimonial</h1></div>

@include('widgets.errors')

@include('user.testimonials._form')

@endsection