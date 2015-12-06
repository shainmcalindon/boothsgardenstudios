<?php

class User_Posts_Controller extends Base_Controller {
  
  public $restful = true;

  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_post'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->post_id = URI::Segment(4);
    }
  }

  public function get_index()
  {
    $posts = Post::with('organisations')->with('author')->order_by('created_at', 'desc')->paginate(20);
    
    return View::make('user.posts.posts')->with('posts', $posts);
  }

  public function get_create()
  {
    $user = Auth::user();
    
    $categories = Category::get();
    $organisations = Organisation::get();
    
    return View::Make('user.posts.create')->with('user', $user)->with('categories', $categories)->with('organisations', $organisations);
  }

  public function post_create() 
  {
    $new_post = array(
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
      'slug' => 'unique:posts,slug',
      'body' => 'required'
    );

    // make the validator
    $v = Validator::make($new_post, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/posts/create')->with('user', Auth::user())->with_errors($v)->with_input();
    }

    // create the new post
    $post = new Post($new_post);
    $post->save();
    
    // add categories to Category_Post
    foreach (Input::get('categories') as $category_id) {
      $post->categories()->attach($category_id);
    }
    
    // add organisations to Organisation_Post
    foreach (Input::get('organisations') as $org_id) {
      $post->organisations()->attach($org_id);
    }

    // redirect to posts
    return Redirect::to('user/posts')->with('success','A new post has been created');
  }

  public function get_update()
  {
    $post = Post::Find($this->post_id);
    $user = Auth::user();
    
    $categories = Category::get();
    $organisations = Organisation::get();
    
    $selected = array();
    foreach ($post->categories as $c) {
      $selected[] = $c->id;
    }
    
    $selected_org = array();
    foreach ($post->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.posts.update')->with('post',$post)->with('user',$user)->with('categories', $categories)->with('selected', $selected)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }

  public function post_update()
  {
    $post = Post::Find($this->post_id);

    $update_post = array(
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
      'slug' => 'unique:posts,slug,'.$this->post_id,
      'body' => 'required'
    );

    // make the validator
    $v = Validator::make($update_post, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/posts/update/'.$this->post_id)->with('user', Auth::user())->with_errors($v)->with_input();
    }
    
    // delete categories
    DB::table('category_post')->where('post_id', '=', $this->post_id)->delete();
    
    // delete organisations
    DB::table('organisation_post')->where('post_id', '=', $this->post_id)->delete();
    
    // add categories to Category_Post
    foreach (Input::get('categories') as $category_id) {
      $post->categories()->attach($category_id);
    }
    
    // add organisations to Organisation_Post
    foreach (Input::get('organisations') as $org_id) {
      $post->organisations()->attach($org_id);
    }

    $post->update($this->post_id, $update_post);

    return Redirect::to('user/posts')->with('success','The post has been updated');
  }

  public function get_remove()
  {
    $post = Post::Find($this->post_id);
    
    return View::make('user.posts.remove')->with('post', $post);
  }
  
  public function post_remove()
  {
    $post = Post::Find($this->post_id);
    
    // delete category_post
    DB::table('category_post')->where('post_id', '=', $this->post_id)->delete();
    
    // delete Organisation_Post
    DB::table('organisation_post')->where('post_id', '=', $this->post_id)->delete();
    
    // delete post
    $post->delete();

    return Redirect::to('user/posts/')->with('success','The post has been removed.');
  }
}