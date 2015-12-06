<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Title</label>
      <input id="title" name="title" placeholder="" class="form-control" type="text" value="{{{ Input::old('title', $faqcategory->title) }}}">
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
          <label class="checkbox" labelfor="visibility"><input id="visible" name="visible" type="checkbox" value="1" <?php if ($faqcategory) { if ($faqcategory->visibility == false) { ?><?php } else { ?>checked<?php } } else { ?>checked<?php } ?>>Visible</label>
      </div>
    </div>
    <div class="form-group">
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$faqcategory)
      <a href="/user/faqcategories/create/" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($faqcategory)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/faqcategories/">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/faqcategories/remove/{{{ $faqcategory->id }}}">Remove</a>
      @endif
    </div>
  </fieldset>
</form>
<script type="text/javascript">
$('#{{ $initial_focus ?: 'title' }}').focus();
</script>