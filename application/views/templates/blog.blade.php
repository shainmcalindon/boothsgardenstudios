@layout('templates.main')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-8">
    @yield('blog_content')
  </div>
  <div class="col-xs-12 col-sm-4">
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Latest</h3></div>
      <div class="list-group">
        @foreach ($latest_posts as $latest_post)
        <a class="list-group-item" href="/case-studies/view/{{{ $latest_post->slug }}}">{{{ $latest_post->title }}}</a>
        @endforeach
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
      <div class="list-group">
        @foreach ($categories as $category)
        <a class="list-group-item" href="/case-studies/categories/{{{ $category->slug }}}">{{{ $category->title }}}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection