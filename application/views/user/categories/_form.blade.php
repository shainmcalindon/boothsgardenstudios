<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Title</label>
      <input id="title" name="title" placeholder="" class="form-control" type="text" value="{{{ Input::old('title', $category->title) }}}">
    </div>
    <div class="form-group">
      <label class="control-label sr-only">Slug</label>
      <input id="slug" name="slug" placeholder="" class="form-control" type="text" value="{{{ Input::old('slug', $category->slug) }}}">
      <span class="help-block"><small>The URL slug to use for the page. Use only lowercase characters, numbers, underscores and hyphens. This must be unique.</small></span>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Organisation</h3></div>
      <div class="panel-body">
        @foreach($organisations as $org)
          <label class="checkbox-inline" labelfor="{{{ $org->name }}}"><input id="organisations[]" name="organisations[]" type="checkbox" value="{{{ $org->id }}}" <?php if (in_array($org->id, $selected_org)) { ?>checked<?php } ?>>{{{ $org->name }}}</label>
        @endforeach
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
          <label class="checkbox" labelfor="visibility"><input id="visible" name="visible" type="checkbox" value="1" <?php if ($category) { if ($category->visibility == false) { ?><?php } else { ?>checked<?php } } else { ?>checked<?php } ?>>Visible</label>
      </div>
    </div>
    <div class="form-group">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$category)
      <a href="/user/categories/create/" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($category)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/categories/">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/categories/remove/{{{ $category->id }}}">Remove</a>
      @endif
    </div>
  </fieldset>
</form>
<script type="text/javascript">
var code_prefill_function = function() {
    if ($(this).val() != "") return;
    var v = $('#title').val();
    v = v.replace(/\s/g,'-').toLowerCase().replace(/\s/g,'-').replace(/[^a-z0-9\_-]/g,'');
    $(this).val(v);
};
$('#slug').focus(code_prefill_function);
$(document).on('#title', 'blur', code_prefill_function);
$('#{{ $initial_focus ?: 'title' }}').focus();
</script>