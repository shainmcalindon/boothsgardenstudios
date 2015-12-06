@layout('templates.blog')

@section('content')

<div class="page-header"><h1>Contact Us</h1></div>
<div class="row">
  <div class="col-xs-12 col-sm-8">
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
    <form method="post" role="form">
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
        <label>Post code *</label>
        <input type="text" id="postcode" name="postcode" class="form-control" value="{{{ Input::old('postcode') }}}">
      </div>
      <div class="form-group">
        <label>Message *</label>
        <textarea rows="4" id="message" name="message" class="form-control">{{{ Input::old('message') }}}</textarea>
      </div>
      <div class="form-group">
        <p>* Required fields</p>
        <button type="submit" class="btn btn-success">Send</button>
        <a href="/contact" class="btn btn-default">Clear</a>
      </div>
    </form>
  </div>
  <div class="col-xs-12 col-sm-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <address>
          <strong>Booths Garden Studios</strong><br>
          The Airfield Building,<br>
          Weldon Road,<br>
          Upper Benefield,<br>
          PE8 5AS.<br><br>
          <abbr title="Workshop">W:</abbr> 01832 205038<br>
          <abbr title="Mobile">M:</abbr> 07590 067 120<br>
          <abbr title="Email">E:</abbr> <a href="mailto:iain@boothsgardenstudios.co.uk">iain@boothsgardenstudios.co.uk</a><br>
        </address>
      </div>
    </div>
  </div>
</div>

@endsection