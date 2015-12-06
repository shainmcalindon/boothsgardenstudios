@layout('templates.main')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-8 page-content">
    <div class="page-header"><h1>{{{ $page->title }}}</h1></div>
    {{ $page->body }}
  </div>
  <div class="hidden-xs col-sm-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">7 Reasons To Buy From Booths</h2>
      </div>
      <ul class="list-group">
        <li class="list-group-item">QC studio complies with building regulations</li>
        <li class="list-group-item">No deposit required</li>
        <li class="list-group-item">Prices include delivery and VAT - excludes QCB studio</li>
        <li class="list-group-item">Planning permission not normally required</li>
        <li class="list-group-item">Unique 11 year guarantee</li>
        <li class="list-group-item">Take it with you when you move house</li>
        <li class="list-group-item">Truly zero maintenance - no painting or staining for at least 25 years</li>
      </ul>
    </div>
    @foreach ($testimonials as $testimonial)
    <blockquote>
      {{ $testimonial->testimonial }}
      <p><strong>{{{ $testimonial->client }}}</strong></p>
    </blockquote>
    @endforeach
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