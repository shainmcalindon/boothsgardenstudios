<form method="post" role="form">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Question</label>
      <input id="question" name="question" placeholder="" class="form-control" type="text" value="{{{ Input::old('title', $faq->question) }}}">
    </div>
    <div class="form-group">
      <label class="control-label">Answer</label>
      <textarea style="width:100%" rows="10" id="answer" name="answer" class="tinymce">{{{ $faq->answer }}}</textarea>
    </div>
    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <input id="sort_order" name="sort_order" placeholder="" class="form-control" type="text" value="{{{ Input::old('sort_order', $faq->sort_order) }}}">
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">FAQ Categories</h3></div>
      <div class="panel-body">
        @foreach($faqcategories as $faqcategory)
          <label class="checkbox-inline" labelfor="{{{ $faqcategory->title }}}"><input id="faqcategories[]" name="faqcategories[]" type="checkbox" value="{{{ $faqcategory->id }}}" <?php if (in_array($faqcategory->id, $selected)) { ?>checked<?php } ?>>{{{ $faqcategory->title }}}</label>
        @endforeach
      </div>
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
      <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
      @if(!$faq)
      <a href="/user/faqs/create/" id="clear" name="clear" class="btn btn-default">Clear</a>
      @endif 
      @if($faq)
      <a id="cancel" name="cancel" class="btn btn-default" href="/user/faqs/">Cancel</a>
      <a id="remove" name="remove" class="btn btn-danger pull-right" href="/user/faqs/remove/{{{ $faq->id }}}">Remove</a>
      @endif
    </div>
  </fieldset>
</form>