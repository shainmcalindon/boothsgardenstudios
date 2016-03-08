@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Testimonial</h1></div>
<p><em>{{{ $testimonial->client }}}</em></p>
<p>Are you sure you wish to remove this testimonial?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/testimonials/update/{{{ $testimonial->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection