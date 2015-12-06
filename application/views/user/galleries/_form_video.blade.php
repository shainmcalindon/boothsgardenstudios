<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Video iFrame (Set width="61%", height="100%")</label>
      <input type="text" id="code" name="code" value="{{{ Input::old('code', $video->code) }}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Video Placeholder (695px x 400px)</label>
      <div class="input-group">
        <input id="url" name="url" type="text" class="form-control" value="{{{ Input::old('url', $video->url) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'url', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Video Thumb (100px x 100px)</label>
      <div class="input-group">
        <input id="url_thumb" name="url_thumb" type="text" class="form-control" value="{{{ Input::old('url_thumb', $video->url_thumb) }}}">
        <span class="input-group-btn"><a class="btn btn-primary" onclick="moxman.browse({view: 'thumbs', fields: 'url_thumb', extensions:'jpg,gif,png'});" href="javascript:;">Pick file</a></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Title</label>
      <input type="text" id="title" name="title" value="{{{ Input::old('title', $video->title) }}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Alt</label>
      <input type="text" id="alt" name="alt" value="{{{ Input::old('alt', $video->alt) }}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Description</label>
      <textarea style="width:100%" rows="5" id="description" name="description" class="tinymce">{{ $video->description }}</textarea>
    </div>
    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <input id="sort_order" name="sort_order" placeholder="" class="form-control" type="text" value="{{{ Input::old('sort_order', $video->sort_order) }}}">
    </div>
    <div class="form-group">
      <div class="checkbox">
          <label class="checkbox" labelfor="visibility"><input id="visible" name="visible" type="checkbox" value="1" <?php if ($video) { if ($video->visibility == false) { ?><?php } else { ?>checked<?php } } else { ?>checked<?php } ?>>Visible</label>
      </div>
    </div>
    <div class="form-group">
      <input type="hidden" name="type" id="type" value="video">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$video)
      <a href="/user/galleries/addvideo/{{{ $gallery->id }}}" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($video)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/galleries/view/{{{ $gallery->id }}}">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/galleries/removevideo/{{{ $video->id }}}">Remove</a>
      @endif
    </div>
  </fieldset>
</form>