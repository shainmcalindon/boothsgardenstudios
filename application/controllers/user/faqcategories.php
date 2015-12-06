<?php

class User_Faqcategories_Controller extends Base_Controller {
  
  public $restful = true;
  
  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_faqcategory'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->faqcategory_id = URI::Segment(4);
    }
  }
  
  public function get_index()
  {    
    $faqcategories = Faqcategory::with('organisations')->order_by('sort_order', 'asc')->get();
    
    return View::make('user.faqcategories.faqcategories')->with('faqcategories', $faqcategories);
  }
  
  public function post_index()
  {
    $update_sort = array(
      'sort_order' => Input::get('sort_order')
    );
    
    foreach($update_sort['sort_order'] as $k => $v) {
      $faqcategory = Faqcategory::find($k);
      $faqcategory->update($faqcategory->id, array('sort_order' => $v));
    }
    
    return Redirect::to('user/faqcategories')->with('success','The sort order has been updated');
  }
  
  public function get_create()
  {
    $organisations = Organisation::get();
    
    return View::make('user.faqcategories.create')->with('organisations', $organisations);
  }
  
  public function post_create()
  {
    $new_faqcategory = array(
      'title' => trim(Input::get('title')),
      'visibility' => trim(Input::get('visible')) ? true : false
    );
    
    //set up rules for new data
    $rules = array(
      'title' => 'required|min:3|max:128'
    );

    // make the validator
    $v = Validator::make($new_faqcategory, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/faqcategories/create')->with_errors($v)->with_input();
    }
    
    // create the new faqcategory
    $faqcategory = new Faqcategory($new_faqcategory);
    $faqcategory->save();
    
    // add organisations to Organisation_faqcategory
    foreach (Input::get('organisations') as $org_id) {
      $faqcategory->organisations()->attach($org_id);
    }
    
    // redirect to posts
    return Redirect::to('user/faqcategories')->with('success','A new faqcategory has been created');
  }
  
  public function get_update()
  {
    $faqcategory = Faqcategory::find($this->faqcategory_id);
    
    $organisations = Organisation::get();
    
    $selected_org = array();
    foreach ($faqcategory->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.faqcategories.update')->with('faqcategory', $faqcategory)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }
  
  public function post_update()
  {
    $faqcategory = Faqcategory::find($this->faqcategory_id);
    
    $update_faqcategory = array(
      'title' => trim(Input::get('title')),
      'visibility' => trim(Input::get('visible')) ? true : false,
    );

    // set up rules for data
    $rules = array(
      'title' => 'required|min:3|max:128',
    );

    // make the validator
    $v = Validator::make($update_faqcategory, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/faqcategories/update/'.$this->faqcategory_id)->with_errors($v)->with_input();
    }
    
    // delete organisations
    DB::table('organisation_faqcategory')->where('faqcategory_id', '=', $this->faqcategory_id)->delete();
    
    // add organisations to Organisation_Faqcategory
    foreach (Input::get('organisations') as $org_id) {
      $faqcategory->organisations()->attach($org_id);
    }
    
    $faqcategory->update($this->faqcategory_id, $update_faqcategory);
    
    return Redirect::to('user/faqcategories')->with('success','The faqcategory has been updated');
  }

  public function get_remove()
  {
    $faqcategory = Faqcategory::Find($this->faqcategory_id);
    
    return View::make('user.faqcategories.remove')->with('faqcategory', $faqcategory);
  }
  
  public function post_remove()
  {
    $faqcategory = Faqcategory::find($this->faqcategory_id);
    
    // delete faqcategory_faq
    DB::table('faqcategory_faq')->where('faqcategory_id', '=', $this->faqcategory_id)->delete();
    
    // delete Organisation_faqcategory
    DB::table('organisation_faqcategory')->where('faqcategory_id', '=', $this->faqcategory_id)->delete();
    
    //delete faqcategory
    $faqcategory->delete();
    
    return Redirect::to('user/faqcategories')->with('success','The faqcategory has been removed.'); 
  }
  
}