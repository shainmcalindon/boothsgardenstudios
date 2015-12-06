<?php

class User_Pages_Controller extends Base_Controller {
  
  public $restful = true;
  
  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_page'))->except(array('index', 'create'));

    if (is_numeric(URI::Segment(4))) {
      $this->page_id = URI::Segment(4);
    }
  }

  public function get_index()
  {
    $pages = Page::with('organisations')->with('author')->order_by('title', 'asc')->paginate(20);

    return View::make('user.pages.pages')->with('pages', $pages);
  }
  
  public function get_create()
  {
    $user = Auth::user();
    
    $organisations = Organisation::get();
    
    return View::make('user.pages.create')->with('user', $user)->with('organisations', $organisations);
  }
  
  public function post_create()
  {
    $new_page = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')), 
      'feature_image' => trim(Input::get('feature_image')),
      'body' => trim(Input::get('body')),
      'seo_title' => trim(Input::get('seo_title')),
      'seo_description' => trim(Input::get('seo_description')),
      'seo_keywords' => trim(Input::get('seo_keywords')),
      'visibility' => trim(Input::get('visible')) ? true : false,
      'author_id' => trim(Input::get('author_id'))
    );

    // set up rules for new data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:pages,slug',
      'body' => 'required'
    );

    // make the validator
    $v = Validator::make($new_page, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/pages/create')->with('user', Auth::user())->with_errors($v)->with_input();
    }

    // create the new page
    $page = new Page($new_page);
    $page->save();
    
    // add organisations to Organisation_Page
    foreach (Input::get('organisations') as $org_id) {
      $page->organisations()->attach($org_id);
    }
    
    // redirect to pages
    return Redirect::to('user/pages')->with('success','A new page has been created');
  }

  public function get_update()
  {
    $page = Page::Find($this->page_id);
    $user = Auth::user();
    
    $organisations = Organisation::get();
    
    $selected_org = array();
    foreach ($page->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.pages.update')->with('page',$page)->with('user',$user)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }
  
  public function post_update()
  {
    $page = Page::Find($this->page_id);

    $update_page = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')),
      'feature_image' => trim(Input::get('feature_image')),
      'body' => trim(Input::get('body')),
      'seo_title' => trim(Input::get('seo_title')),
      'seo_description' => trim(Input::get('seo_description')),
      'seo_keywords' => trim(Input::get('seo_keywords')),
      'visibility' => trim(Input::get('visible')) ? true : false,
      'author_id' => trim(Input::get('author_id'))
    );

    // set up rules for data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:pages,slug,'.$this->page_id,
      'body' => 'required'
    );

    // make the validator
    $v = Validator::make($update_page, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/pages/update/'.$this->page_id)->with('user', Auth::user())->with_errors($v)->with_input();
    }
    
    // delete organisations
    DB::table('organisation_page')->where('page_id', '=', $this->page_id)->delete();
    
    // add organisations to Organisation_Page
    foreach (Input::get('organisations') as $org_id) {
      $page->organisations()->attach($org_id);
    }
    
    $page->update($this->page_id, $update_page);

    return Redirect::to('user/pages')->with('success','The page has been updated');
  }

  public function get_remove()
  {
    $page = Page::Find($this->page_id);
    
    return View::make('user.pages.remove')->with('page', $page);
  }
  
  public function post_remove()
  {
    $page = Page::Find($this->page_id);
    
    // delete Organisation_Page
    DB::table('organisation_page')->where('page_id', '=', $this->page_id)->delete();

    $page->delete();

    return Redirect::to('user/pages/')->with('success','The page has been removed.');
  }
}