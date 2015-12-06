@layout('templates.main')

@section('content')

<form class="form-signin">
  <h2 class="form-signin-heading">Please sign in</h2>
  <input type="text" class="input-block-level" placeholder="Email address" id="email" name="email">
  <input type="password" class="input-block-level" placeholder="Password" id="password" name="password">
  <!--<label class="checkbox">
    <input type="checkbox" value="remember-me"> Remember me
  </label>-->
  <input type="hidden" name="login" value="1">
  <button class="btn btn-large btn-primary" type="submit">Sign in</button>
</form>

@endsection