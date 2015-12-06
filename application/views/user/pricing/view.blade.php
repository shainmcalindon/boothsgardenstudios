@layout('templates.user')

@section('user_content') 

<div class="page-header"><h1>{{{ $layout->size_x }}} x {{{ $layout->size_y }}}</h1></div>

<form method="post" role="form" class="form-horizontal">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Description</label>
      <textarea style="width:100%" rows="10" id="description" name="description" class="tinymce">{{ $layout->description }}</textarea>
    </div>
    <!--<div class="form-group">
      <label class="control-label">Feature image</label>
      <div class="input-group">
        <input id="feature_image" name="feature_image" type="text" class="form-control" value="{{{ Input::old('feature_image', $layout->feature_image) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'feature_image', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>-->
    <div class="form-group">
      <label class="control-label">Studio plan</label>
      <div class="input-group">
        <input id="plan_image" name="plan_image" type="text" class="form-control" value="{{{ Input::old('plan_image', $layout->plan_image) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'plan_image', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Standard specifiation</label>
      <textarea style="width:100%" rows="20" id="specification" name="specification" class="tinymce">{{{ $layout->specification }}}</textarea>
    </div>
    <div class="form-group">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/pricing/update/{{{ $layout->studio_id }}}/">Cancel</a>
    </div>
  </fieldset>
</form>

@endsection