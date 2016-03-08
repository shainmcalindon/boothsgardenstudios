@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>Remove Category</h1></div>
<p><em>{{{ $category->title }}}</em></p>
<p>Are you sure you wish to remove this category?</p>
<form method="post" action="">
<p>
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="/user/categories/update/{{{ $category->id }}}" class="btn btn-default">Cancel</a>
</p>
</form>

@endsection