@if($errors->has())

<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>We encountered the following errors:</h4><br>
  <ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
  </ul>
</div>

@endif