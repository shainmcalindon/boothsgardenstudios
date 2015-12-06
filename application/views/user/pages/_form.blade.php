<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Title</label>
      <input id="title" name="title" placeholder="" class="form-control" type="text" value="{{{ Input::old('title', $page->title) }}}">
    </div>
    <div class="form-group">
      <label class="control-label sr-only">Slug</label>
      <input id="slug" name="slug" placeholder="" class="form-control" type="text" value="{{{ Input::old('slug', $page->slug) }}}">
      <span class="help-block"><small>The URL slug to use for the page. Use only lowercase characters, numbers, underscores and hyphens. This must be unique.</small></span>
    </div>
    <!--<div class="form-group">
      <label class="control-label">Feature image</label>
      <div class="input-group">
        <input id="feature_image" name="feature_image" type="text" class="form-control" value="{{{ Input::old('feature_image', $page->feature_image) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'feature_image', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>-->
    <div class="form-group">
      <label class="control-label sr-only">Body</label>
      <textarea style="width:100%" rows="20" id="body" name="body" class="tinymce">{{{ $page->body }}}</textarea>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Organisation</h3></div>
      <div class="panel-body">
        @foreach($organisations as $org)
          <label class="checkbox-inline" labelfor="{{{ $org->name }}}"><input id="organisations[]" name="organisations[]" type="checkbox" value="{{{ $org->id }}}" <?php if (in_array($org->id, $selected_org)) { ?>checked<?php } ?>>{{{ $org->name }}}</label>
        @endforeach
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Search Engine Optimisation</h3></div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label">Title (<span id="seo_title-append"></span>/60 characters)</label>
          <input class="form-control" id="seo_title" name="seo_title" placeholder="" type="text" value="{{{ Input::old('seo_title', $page->seo_title) }}}">
          <script type="text/javascript">
            $("#seo_title").counter({
              count: 'up',
              goal: 'sky',
              text: false,
              append: false,
              target: '#seo_title-append'
            });
          </script>
        </div>
        <div class="form-group">
          <label class="control-label">Description (<span id="seo_description-append"></span>/157 characters)</label>
          <div class="controls">
              <textarea id="seo_description" name="seo_description" cols="" rows="" class="form-control">{{{ $page->seo_description }}}</textarea>
            <script type="text/javascript">
              $("#seo_description").counter({
                count: 'up',
                goal: 'sky',
                text: false,
                append: false,
                target: '#seo_description-append'
              });
            </script>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Keywords (comma seperated)</label>
          <textarea id="seo_keywords" name="seo_keywords" cols="" rows="" class="form-control">{{{ $page->seo_keywords }}}</textarea>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label class="checkbox" labelfor="visibility"><input id="visible" name="visible" type="checkbox" value="1" <?php if ($page) { if ($page->visibility == false) { ?><?php } else { ?>checked<?php } } else { ?>checked<?php } ?>>Visible</label>
      </div>
    </div>
    <div class="form-group">
      <input id="author_id" name="author_id" type="hidden" value="{{{ $user->id }}}">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$page)
      <a href="/user/posts/create/" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($page)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/pages/">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/pages/remove/{{{ $page->id }}}">Remove</a>
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