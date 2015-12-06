<?php

class User_Faqs_Controller extends Base_Controller {
  
  public $restful = true;
  
  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_faq'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->faq_id = URI::Segment(4);
    }
  }
  
  public function get_index()
  {    
    $faqs = Faq::with('organisations')->order_by('sort_order', 'asc')->get();
    
    return View::make('user.faqs.faqs')->with('faqs', $faqs);
  }
  
  public function post_index()
  {
    $update_sort = array(
      'sort_order' => Input::get('sort_order')
    );
    
    foreach($update_sort['sort_order'] as $k => $v) {
      $faq = Faq::find($k);
      $faq->update($faq->id, array('sort_order' => $v));
    }
    
    return Redirect::to('user/faqs')->with('success','The sort order has been updated');
  }
  
  public function get_create()
  {    
    $faqcategories = Faqategory::get();
    
    $organisations = Organisation::get();
    return View::make('user.faqs.create')->with('faqcategories', $faqcategories)->with('organisations', $organisations);
  }
  
  public function post_create()
  {
    $new_faq = array(
      'question' => trim(Input::get('question')),
      'answer' => trim(Input::get('answer')),
      'sort_order' => trim(Input::get('sort_order')),
    );
    
    //set up rules for new data
    $rules = array(
      'question' => 'required|min:3',
      'answer' => 'required',
      'sort_order' => 'numeric'
    );

    // make the validator
    $v = Validator::make($new_faq, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/faqs/create')->with_errors($v)->with_input();
    }
    
    // create the new faq
    $faq = new Faq($new_faq);
    $faq->save();
    
    // add categories to Faqcategory_Faq
    foreach (Input::get('faqcategories') as $faqcategory_id) {
      $faq->faqcategories()->attach($faqcategory_id);
    }
    
    // add organisations to Organisation_Faq
    foreach (Input::get('organisations') as $org_id) {
      $faq->organisations()->attach($org_id);
    }
    
    // redirect to faqs
    return Redirect::to('user/faqs')->with('success','A new faq has been created');
  }
  
  public function get_update()
  {
    $faq = Faq::find($this->faq_id);
    
    $faqcategories = Faqcategory::get();
    $organisations = Organisation::get();
    
    $selected = array();
    foreach ($faq->faqcategories as $c) {
      $selected[] = $c->id;
    }
    
    $selected_org = array();
    foreach ($faq->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.faqs.update')->with('faq', $faq)->with('faqcategories', $faqcategories)->with('organisations', $organisations)->with('selected_org', $selected_org)->with('selected', $selected);
  }
  
  public function post_update()
  {
    $faq = Faq::find($this->faq_id);
    
    $update_faq = array(
      'question' => trim(Input::get('question')),
      'answer' => trim(Input::get('answer')),
      'sort_order' => trim(Input::get('sort_order')),
    );

    // set up rules for data
    $rules = array(
      'question' => 'required|min:3',
      'answer' => 'required',
      'sort_order' => 'numeric'
    );

    // make the validator
    $v = Validator::make($update_faq, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/faqs/update/'.$this->faq_id)->with_errors($v)->with_input();
    }
    
    // delete categories
    DB::table('category_post')->where('post_id', '=', $this->post_id)->delete();
    
    // delete organisations
    DB::table('organisation_faq')->where('faq_id', '=', $this->faq_id)->delete();
    
    // add categories to Category_Post
    foreach (Input::get('faqcategories') as $faqcategory_id) {
      $faq->faqcategories()->attach($faqcategory_id);
    }
    
    // add organisations to Organisation_Post
    foreach (Input::get('organisations') as $org_id) {
      $faq->organisations()->attach($org_id);
    }
    
    $faq->update($this->faq_id, $update_faq);
    
    return Redirect::to('user/faqs')->with('success','The faq has been updated');
  }

  public function get_remove()
  {
    $faq = Faq::Find($this->faq_id);
    
    return View::make('user.faqs.remove')->with('faq', $faq);
  }
  
  public function post_remove()
  {
    $faq = Faq::find($this->faq_id);
    
    // delete category_post
    DB::table('faqcategory_faq')->where('faq_id', '=', $this->faq_id)->delete();
    
    // delete Organisation_Faq
    DB::table('organisation_faq')->where('faq_id', '=', $this->faq_id)->delete();
    
    //delete category
    $faq->delete();
    
    return Redirect::to('user/faqs')->with('success','The faq has been removed.'); 
  }
}