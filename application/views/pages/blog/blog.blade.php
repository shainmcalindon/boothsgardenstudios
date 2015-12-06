@layout('templates.blog')

@section('blog_content')

<div class="page-header"><h1>Case Studies<?php if ($category) { ?>: <small>{{{ $category->title }}}</small><?php } ?></h1></div>

{{ $posts->links() }}

@foreach ($posts->results as $post)

<div class="blog-post">
  <div class="post-header"><h2>{{ HTML::link('case-studies/view/'.$post->slug, $post->title) }}</h2></div>
  <!--<div class="post-meta"><small>Posted on {{ date('d-m-Y H:i:s', strtotime($post->created_at)) }}, by {{ $post->author->nickname }}</small></div>-->
  <div class="post-excerpt">
    <div class="post-feature-image">
      <a href="case-studies/view/{{{ $post->slug }}}" title="{{{ $post->title }}}"><img src="{{{ $post->feature_image }}}" alt="{{{ $post->title }}}" title="{{{$post->title }}}" class="img-thumbnail img-responsive"></a>
    </div>
    <p>{{ substr(strip_tags($post->body),0, 200).' [..]' }}</p>
  </div>
  <div class="post-link">
    <p class="pull-right">{{ HTML::link('case-studies/view/'.$post->slug, 'Read more &rarr;', array('class' => 'btn btn-default')) }}</p>
  </div>
</div>

@endforeach

{{ $posts->links() }}

@endsection