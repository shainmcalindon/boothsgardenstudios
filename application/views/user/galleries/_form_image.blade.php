<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Image (695px x 400px)</label>
      <div class="input-group">
        <input id="url" name="url" type="text" class="form-control" value="{{{ Input::old('url', $image->url) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'url', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Image Thumb (100px x 100px)</label>
      <div class="input-group">
        <input id="url_thumb" name="url_thumb" type="text" class="form-control" value="{{{ Input::old('url_thumb', $image->url_thumb) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'url_thumb', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Title</label>
      <input type="text" id="title" name="title" value="{{{ Input::old('title', $image->title) }}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Alt</label>
      <input type="text" id="alt" name="alt" value="{{{ Input::old('alt', $image->alt) }}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Description</label>
      <textarea style="width:100%" rows="5" id="description" name="description" class="tinymce">{{ $image->description }}</textarea>
    </div>
    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <input id="sort_order" name="sort_order" placeholder="" class="form-control" type="text" value="{{{ Input::old('sort_order', $image->sort_order) }}}">
    </div>
    <div class="form-group">
      <div class="checkbox">
          <label class="checkbox" labelfor="visibility"><input id="visible" name="visible" type="checkbox" value="1" <?php if ($image) { if ($image->visibility == false) { ?><?php } else { ?>checked<?php } } else { ?>checked<?php } ?>>Visible</label>
      </div>
    </div>
    <div class="form-group">
      <input type="hidden" name="type" id="type" value="image">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$image)
      <a href="/user/galleries/addimage/{{{ $gallery->id }}}" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($image)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/galleries/view/{{{ $gallery->id }}}">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/galleries/removeimage/{{{ $image->id }}}">Remove</a>
      @endif
    </div>
  </fieldset>
</form>