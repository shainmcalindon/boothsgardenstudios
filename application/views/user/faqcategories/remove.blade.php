@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Faq Category</h1></div>
<p><em>{{{ $faqcategory->title }}}</em></p>
<p>Are you sure you wish to remove this faq category?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/faqcategories/update/{{{ $faqcategory->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection