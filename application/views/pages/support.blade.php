@layout('templates.main')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-8 page-content">
    <div class="page-header"><h1>Support</h1></div>
    <p>Hi There, if you have an issue with your Garden Studio, this is the best way of letting us know as it then goes into our system. If you just call a member of staff - it won't go into our system and you may be forgotton about especially when we are very busy.</p> 

    <p>Please explain the issue here. If you could include some photos of the issue (if appropriate) then that would be a big help as then we can see if any parts are required. Once we have your information we will put you on ourService Calls Map and somebody will be in touch.</p>

    <p>If you could also list when is a good midweek day to pop by that will also help us.</p>
    
    @if ($message || $errors->has())
    <div class="alert alert-{{ $class }}">
        @if ($message){{ $message }}@endif
        @if ($errors->has())
        <p>We have encountered the followning errors:</p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    @endif
    
    <form method="post" role="form" enctype="multipart/form-data">
      <div class="form-group">
        <label>Name *</label>
        <input type="text" id="name" name="name" class="form-control" value="{{{ Input::old('name') }}}">
      </div>
      <div class="form-group">
        <label>Email *</label>
        <input type="email" id="email" name="email" class="form-control" value="{{{ Input::old('email') }}}">
      </div>
      <div class="form-group">
        <label>Phone number</label>
        <input type="text" id="phone" name="phone" class="form-control" value="{{{ Input::old('phone') }}}">
      </div>
      <div class="form-group">
        <label>Issue *</label>
        <textarea rows="4" id="issue" name="issue" class="form-control">{{{ Input::old('issue') }}}</textarea>
      </div>
      <div class="form-group">
        <label>Upload image</label>
        <input type="file" id="image" name="image">
      </div>
      <div class="form-group">
        <label class="control-label">Best midweek day/time for visit if required</label>
        <input type="text" id="day" name="day" class="form-control" value="{{{ Input::old('day') }}}">
      </div>
      <div class="form-group">
        <p>* Required fields</p>
        <button type="submit" class="btn btn-success">Send</button>
        <a href="/contact" class="btn btn-default">Clear</a>
      </div>
    </form>
  </div>
  <div class="hidden-xs col-sm-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">7 Reasons To Buy From Booths</h2>
      </div>
      <ul class="list-group">
        <li class="list-group-item">No deposit required</li>
        <li class="list-group-item">Prices include delivery and VAT - excludes QCB studio</li>
        <li class="list-group-item">Money back guarantee (We'll even take your garden studio back!)</li>
        <li class="list-group-item">No planning permission required</li>
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

@endsection
