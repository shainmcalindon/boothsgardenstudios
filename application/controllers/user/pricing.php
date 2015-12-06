<?php

class User_Pricing_Controller extends Base_Controller {
  
  public $restful = true;

  public function __construct()
  {
    $this->filter('before', array('admin'));

    if (is_numeric(URI::Segment(4))) {
      $this->studio_id = URI::Segment(4);
      $this->layout_id = URI::segment(4);
    }
  }

  public function get_index()
  {
  }
  
  public function get_update()
  {
    $layout = Layout::where('studio_id', "=", $this->studio_id)->order_by('size_x', 'asc')->order_by('size_y', 'asc')->get();
    $name = Studio::find($this->studio_id);
    $name = $name->name;
    
    return View::Make('user.pricing.update')->with('layout', $layout)->with('name', $name);
  }
  
  public function post_update()
  {
    $name = Studio::find($this->studio_id);
    $name = $name->name;
    
    $update_pricing = array(
      'price_list' => Input::get('pricing')
    );
    
    /*
    // set up rules for new data
    $rules = array(
      'pricing' => 'required|numeric'
    );

    // make the validator
    $v = Validator::make($update_pricing, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/pricing/update/'.$this->studio_id)->with_errors($v)->with_input();
    }
    */
    
    foreach($update_pricing['price_list'] as $k => $v) {
      $layout = Layout::find($k);
      $layout->update($layout->id, array('cost' => $v));
    }
    
    return Redirect::to('user/pricing/update/'.$this->studio_id)->with('success','The prices for '.$name.' have been updated');
  }
  
  public function get_view()
  {
    $layout = Layout::find($this->layout_id);
    
    return View::make('user.pricing.view')->with('layout', $layout);
  }
  
  public function post_view() 
  {
    $layout = Layout::Find($this->layout_id);

    $update_layout = array(
      'description' => trim(Input::get('description')),
      'feature_image' => trim(Input::get('feature_image')),
      'plan_image' => trim(Input::get('plan_image')),
      'specification' => trim(Input::get('specification'))
    );

    // set up rules for data
    $rules = array(
      'specification' => 'required'
    );

    // make the validator
    $v = Validator::make($update_layout, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/pricing/view/'.$this->layout_id)->with('user', Auth::user())->with_errors($v)->with_input();
    }
    
    $layout->update($this->layout_id, $update_layout);

    return Redirect::to('user/pricing/view/'.$this->layout_id)->with('success','The layout has been updated');
  }
}