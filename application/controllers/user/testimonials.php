<?php

class User_Testimonials_Controller extends Base_Controller {
  
  public $restful = true;

  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_post'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->testimonial_id = URI::Segment(4);
    }
  }
  
  public function get_index()
  {
    $testimonials = Testimonial::with('organisations')->order_by('client', 'asc')->paginate(20);

    return View::make('user.testimonials.testimonials')->with('testimonials', $testimonials);
  }

  public function get_create()
  {
    $organisations = Organisation::get();
    
    return View::Make('user.testimonials.create')->with('organisations', $organisations);
  }
  
  public function post_create() 
  {
    $new_testimonial = array(
      'client' => trim(Input::get('client')),
      'testimonial' => trim(Input::get('testimonial')),
      'visibility' => trim(Input::get('visible')) ? true : false
    );

    // set up rules for new data
    $rules = array(
      'client' => 'required|min:3|max:128',
      'testimonial' => 'required'
    );

    // make the validator
    $v = Validator::make($new_testimonial, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/testimonials/create')->with('user', Auth::user())->with_errors($v)->with_input();
    }

    // create the new testimonial
    $testimonial = new Testimonial($new_testimonial);
    $testimonial->save();
    
    // add organisations to Organisation_Testimonial
    foreach (Input::get('organisations') as $org_id) {
      $testimonial->organisations()->attach($org_id);
    }

    // redirect to testimonial
    return Redirect::to('user/testimonials')->with('success','A new testimonial has been created');
  }
  
  public function get_update()
  {
    $testimonial = Testimonial::Find($this->testimonial_id);
    $organisations = Organisation::get();
    
    $selected_org = array();
    foreach ($post->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.testimonials.update')->with('testimonial',$testimonial)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }
  
  public function post_update()
  {
    $testimonial = Testimonial::Find($this->testimonial_id);

    $update_testimonial = array(
      'client' => trim(Input::get('client')),
      'testimonial' => trim(Input::get('testimonial')),
      'visibility' => trim(Input::get('visible')) ? true : false
    );

    // set up rules for new data
    $rules = array(
      'client' => 'required|min:3|max:128',
      'testimonial' => 'required'
    );

    // make the validator
    $v = Validator::make($update_testimonial, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/testimonials/update/'.$this->testimonial_id)->with_errors($v)->with_input();
    }
    
    // delete organisations
    DB::table('organisation_testimonial')->where('testimonial_id', '=', $this->testimonial_id)->delete();
    
    // add organisations to Organisation_Testimonial
    foreach (Input::get('organisations') as $org_id) {
      $testimonial->organisations()->attach($org_id);
    }

    $testimonial->update($this->testimonial_id, $update_testimonial);

    return Redirect::to('user/testimonials')->with('success','The testimonial has been updated');
  }

  public function get_remove()
  {
    $testimonial = Testimonial::Find($this->testimonial_id);
    
    return View::make('user.testimonials.remove')->with('testimonial', $testimonial);
  }
  
  public function post_remove()
  {
    $testimonial = Testimonial::Find($this->testimonial_id);
    
    // delete Organisation_Testimonial
    DB::table('organisation_testimonial')->where('testimonial_id', '=', $this->testimonial_id)->delete();
    
    // delete testimonial
    $testimonial->delete();

    return Redirect::to('user/testimonials')->with('success','The testimonial has been removed.');
  }
}