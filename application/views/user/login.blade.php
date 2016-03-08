@layout('templates.main')

@section('content')

@if (Session::get('login-error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ Session::get('login-error') }}
</div>

@endif

<form method="post" role="form" class="form-signin">
  <h2 class="form-signin-heading">Please sign in</h2>
  <input type="text" class="form-control" placeholder="Email address" id="email" name="email">
  <input type="password" class="form-control" placeholder="Password" id="password" name="password">
  <!--<label class="checkbox">
    <input type="checkbox" value="remember-me"> Remember me
  </label>-->
  <input type="hidden" name="login" value="1">
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

@endsection