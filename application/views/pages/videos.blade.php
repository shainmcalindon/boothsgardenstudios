@layout('templates.blog')

@section('content')

<div class="page-header"><h1>Videos Gallery</h1></div>

<script>
jQuery(function(){
  jQuery('#camera_wrap_2').camera({
    height: '35%',
    portrait: 'true',
    fx: 'simpleFade',
    loader: 'bar',
    pagination: false,
    thumbnails: true
  });
});
</script>

<div class="camera_wrap camera_pistachio_skin" id="camera_wrap_2">
  @foreach ($images as $image)
  <div data-thumb="{{{ $image->url_thumb }}}" data-src="{{{ $image->url }}}" data-alignment="topLeft" data-portrait="true">
      <?php if ($image->type == 'video') : ?>
      {{ $image->code }}
      <?php endif; ?>
      <div class="camera_caption fadeFromBottom">
          {{ $image->description }}
      </div>
  </div>
  @endforeach
</div>

<div class="clearfix"></div>

@endsection