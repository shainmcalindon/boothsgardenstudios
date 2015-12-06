<?php

class User_Categories_Controller extends Base_Controller {
  
  public $restful = true;
  
  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_category'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->category_id = URI::Segment(4);
    }
  }
  
  public function get_index()
  {    
    $categories = Category::with('organisations')->order_by('title', 'asc')->paginate(20);
    
    return View::make('user.categories.categories')->with('categories', $categories);
  }
  
  public function get_create()
  {
    $organisations = Organisation::get();
    
    return View::make('user.categories.create')->with('organisations', $organisations);
  }
  
  public function post_create()
  {
    $new_category = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')), 
      'image' => trim(Input::get('image')),
      'visibility' => trim(Input::get('visible')) ? true : false
    );
    
    //set up rules for new data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:categories,slug'
    );

    // make the validator
    $v = Validator::make($new_category, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/categories/create')->with_errors($v)->with_input();
    }
    
    // create the new category
    $category = new Category($new_category);
    $category->save();
    
    // add organisations to Organisation_Category
    foreach (Input::get('organisations') as $org_id) {
      $category->organisations()->attach($org_id);
    }
    
    // redirect to posts
    return Redirect::to('user/categories')->with('success','A new category has been created');
  }
  
  public function get_update()
  {
    $category = Category::find($this->category_id);
    
    $organisations = Organisation::get();
    
    $selected_org = array();
    foreach ($category->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.categories.update')->with('category', $category)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }
  
  public function post_update()
  {
    $category = Category::find($this->category_id);
    
    $update_category = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')), 
      'image' => trim(Input::get('image')),
      'visibility' => trim(Input::get('visible')) ? true : false,
    );

    // set up rules for data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:categories,slug,'.$this->category_id
    );

    // make the validator
    $v = Validator::make($update_category, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/categories/update/'.$this->category_id)->with_errors($v)->with_input();
    }
    
    // delete organisations
    DB::table('organisation_category')->where('category_id', '=', $this->category_id)->delete();
    
    // add organisations to Organisation_Post
    foreach (Input::get('organisations') as $org_id) {
      $category->organisations()->attach($org_id);
    }
    
    $category->update($this->category_id, $update_category);
    
    return Redirect::to('user/categories')->with('success','The category has been updated');
  }

  public function get_remove()
  {
    $category = Category::Find($this->category_id);
    
    return View::make('user.categories.remove')->with('category', $category);
  }
  
  public function post_remove()
  {
    $category = Category::find($this->category_id);
    
    // delete category_post
    DB::table('category_post')->where('category_id', '=', $this->category_id)->delete();
    
    // delete Organisation_Post
    DB::table('organisation_category')->where('category_id', '=', $this->category_id)->delete();
    
    //delete category
    $category->delete();
    
    return Redirect::to('user/categories')->with('success','The category has been removed.'); 
  }
  
}