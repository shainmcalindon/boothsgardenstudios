@layout('templates.blog')

@section('content')

<div class="page-header"><h1>FAQ's</h1></div>
<div class="panel-group" id="accordion">

<?php $i = 1; ?>
@foreach ($faqs as $faq)

  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle panel-title" data-toggle="collapse" data-parent="#accordion" href="#{{{ $faq->id }}}">
        <?php echo $i ?>. {{{ $faq->question }}}
      </a>
    </div>
  <div id="{{{ $faq->id }}}" class="panel-collapse collapse">
    <div class="panel-body">
      {{ $faq->answer }}
    </div>
  </div>
</div>

<?php $i ++ ?>
@endforeach

</div>

@endsection