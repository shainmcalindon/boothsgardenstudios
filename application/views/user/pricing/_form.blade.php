<form method="post" role="form" class="form-horizontal">
  <fieldset>
    @foreach ($layout as $l)
    <div class="form-group">
      <label class="col-sm-3 control-label"><a href="/user/pricing/view/{{{ $l->id }}}">{{{ $l->size_x }}} x {{{ $l->size_y }}}</a></label>
      <div class="col-sm-9 input-group">
        <div class="input-group-addon">&pound;</div>
        <input type="text" id="pricing[{{{ $l->id }}}]" name="pricing[{{{ $l->id }}}]" value="{{{ Input::old($l->id, $l->cost) }}}" class="form-control">
      </div>
    </div>
    @endforeach
    <div class="-group">
      <div class="col-sm-offset-3 col-sm-9 form">
        <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
        @if($layout)
        <a id="cancel" name="cancel" class="btn btn-default" href="/user/home/">Cancel</a>
      </div>
      @endif
    </div>
  </fieldset>
</form>