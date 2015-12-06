@layout('templates.main')

@section('content')

<div class="blog-post clearfix blog-post-content">
  <div class="pull-right">
    <a href="/case-studies" class="btn btn-default">Back to Case Studies</a>
  </div>
  <div class="page-header"><h1>{{{ $post->title }}}</h1></div>
  <!--<div class="post-meta"><small>Posted on {{ date('d-m-Y H:i:s', strtotime($post->created_at)) }}, by {{ $post->author->nickname }}</small></div>-->
  <div class="post-body">
    {{ $post->body }}
  </div>
</div>


<script type="text/javascript">
$(function() {
  $('img.img-caption').each(function() {
    var img = $(this);
    var text = $(img).attr('alt');
    var width = $(img).attr('width');
    var style = $(img).attr('class');
    if (text == '') return;
    $(img).wrap('<div class="caption '+style+'" style="width:'+width+'px" />').after('<p class="caption-text">'+text+'</p>');
  });
});
</script>

@endsection