<?php

class User_Galleries_Controller extends Base_Controller {
  
  public $restful = true;

  public function __construct()
  {
    $this->filter('before', array('admin'));
    $this->filter('before', array('valid_gallery'))->except(array('index','create'));

    if (is_numeric(URI::Segment(4))) {
      $this->gallery_id = URI::Segment(4);
    }
  }

  public function get_index()
  {
    $galleries = Gallery::with('organisations')->order_by('sort_order', 'asc')->get();

    return View::make('user.galleries.galleries')->with('galleries', $galleries);
  }
  
  public function post_index()
  {
    $update_sort = array(
      'sort_order' => Input::get('sort_order')
    );
    
    foreach($update_sort['sort_order'] as $k => $v) {
      $gallery = Gallery::find($k);
      $gallery->update($gallery->id, array('sort_order' => $v));
    }
    
    return Redirect::to('user/galleries/')->with('success','The sort order has been updated');
  }
  
  public function get_create()
  {
    $organisations = Organisation::get();
    
    return View::make('user.galleries.create')->with('organisations', $organisations);
  }
  
  public function post_create() 
  {
    $new_gallery = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')), 
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for new data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:galleries,slug'
    );

    // make the validator
    $v = Validator::make($new_gallery, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/create')->with_errors($v)->with_input();
    }

    // create the new post
    $gallery = new Gallery($new_gallery);
    $gallery->save();
    
    // add organisations to Organisation_Post
    foreach (Input::get('organisations') as $org_id) {
      $gallery->organisations()->attach($org_id);
    }

    // redirect to posts
    return Redirect::to('user/galleries')->with('success','A new gallery has been created');
  }
  
  public function get_update()
  {
    $gallery = Gallery::Find($this->gallery_id);
    $organisations = Organisation::get();
    
    $selected_org = array();
    foreach ($gallery->organisations as $o) {
      $selected_org[] = $o->id;
    }
    
    return View::Make('user.galleries.update')->with('gallery',$gallery)->with('organisations', $organisations)->with('selected_org', $selected_org);
  }
  
  public function post_update()
  {
    $gallery = Gallery::Find($this->gallery_id);

    $update_gallery = array(
      'title' => trim(Input::get('title')),
      'slug' => trim(Input::get('slug')),
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for data
    $rules = array(
      'title' => 'required|min:3|max:128',
      'slug' => 'unique:galleries,slug,'.$this->gallery_id
    );

    // make the validator
    $v = Validator::make($update_gallery, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/update/'.$this->gallery_id)->with_errors($v)->with_input();
    }
    
    // delete organisations
    DB::table('organisation_gallery')->where('gallery_id', '=', $this->gallery_id)->delete();
    
    // add organisations to Organisation_Gallery
    foreach (Input::get('organisations') as $org_id) {
      $gallery->organisations()->attach($org_id);
    }

    $gallery->update($this->gallery_id, $update_gallery);

    return Redirect::to('user/galleries')->with('success','The gallery has been updated');
  }

  public function get_remove()
  {
    $gallery = Gallery::Find($this->gallery_id);
    
    return View::make('user.galleries.remove')->with('gallery', $gallery);
  }
  
  public function post_remove()
  {
    $gallery = Gallery::Find($this->gallery_id);
    $images = $gallery->images;
    
    // delete images
    foreach ($images as $image) {
      $image->delete();
    }
    
    // delete Organisation_Gallery
    DB::table('organisation_gallery')->where('gallery_id', '=', $this->gallery_id)->delete();
    
    // delete post
    $gallery->delete();

    return Redirect::to('user/galleries/')->with('success','The gallery has been removed.');
  }
  
  public function get_view()
  {
    $gallery = Gallery::find($this->gallery_id);
    $images = Gallery::find($gallery->id)->images;
    
    return View::make('user.galleries.view')->with('gallery', $gallery)->with('images', $images);
  }
  
  public function post_view()
  {
    $gallery = Gallery::find($this->gallery_id);
    
    $update_sort = array(
      'sort_order' => Input::get('sort_order')
    );
    
    foreach($update_sort['sort_order'] as $k => $v) {
      $image = Image::find($k);
      $image->update($image->id, array('sort_order' => $v));
    }
    
    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','The sort order has been updated');
  }
  
  public function get_addvideo() 
  {
    $gallery = Gallery::find($this->gallery_id);
    
    return View::make('user.galleries.addvideo')->with('gallery', $gallery);
  }
  
  public function post_addvideo()
  {
    $gallery = Gallery::find($this->gallery_id);
    
    $new_video = array(
      'gallery_id' => $gallery->id,
      'code' => trim(Input::get('code')),
      'url' => trim(Input::get('url')),
      'url_thumb' => trim(Input::get('url_thumb')),
      'title' => trim(Input::get('title')),
      'alt' => trim(Input::get('alt')),
      'description' => trim(Input::get('description')),
      'type' => trim(Input::get('type')),
      'sort_order' => trim(Input::get('sort_order')),
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for new data
    $rules = array(
      'code' => 'required',
      'url' => 'required',
      'url_thumb' => 'required',
      'title' => 'required'
    );

    // make the validator
    $v = Validator::make($new_video, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/addvideo/'.$gallery->id)->with_errors($v)->with_input();
    }

    // create the new image
    $video = new Image($new_video);
    $video->save();

    // redirect to gallery
    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','A new video has been added');
  }
  
  public function get_addimage()
  {
    $gallery = Gallery::find($this->gallery_id);
    
    return View::make('user.galleries.addimage')->with('gallery', $gallery);
  }
  
  public function get_editvideo()
  {
    $video_id = URI::Segment(4);
    $video = Image::find($video_id);
    
    $gallery = Image::find($video_id)->gallery()->first();
    
    return View::make('user.galleries.editvideo')->with('video', $video)->with('gallery', $gallery);
  }
  
  public function post_editvideo()
  {
    $video_id = URI::Segment(4);
    $video = Image::find($video_id);
    
    $gallery = Image::find($video_id)->gallery()->first();

    $update_video = array(
      'code' => trim(Input::get('code')),
      'url' => trim(Input::get('url')),
      'url_thumb' => trim(Input::get('url_thumb')),
      'title' => trim(Input::get('title')),
      'alt' => trim(Input::get('alt')),
      'description' => trim(Input::get('description')),
      'sort_order' => trim(Input::get('sort_order')),
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for data
    $rules = array(
      'code' => 'required',
      'url' => 'required',
      'url_thumb' => 'required',
      'title' => 'required'
    );

    // make the validator
    $v = Validator::make($update_video, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/editvideo/'.$gallery->id)->with_errors($v)->with_input();
    }

    $video->update($video->id, $update_video);

    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','The video has been updated');
  }

  public function get_removevideo()
  {
    $video_id = URI::Segment(4);
    $video = Image::find($video_id);
    
    return View::make('user.galleries.removevideo')->with('video', $video);
  }
  
  public function post_removevideo()
  {
    $video_id = URI::Segment(4);
    $video = Image::find($video_id);
    
    $gallery = Image::find($video_id)->gallery()->first();
    
    // delete post
    $video->delete();

    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','The video has been removed from the gallery.');
  }  
  
  public function post_addimage()
  {
    $gallery = Gallery::find($this->gallery_id);
    
    $new_image = array(
      'gallery_id' => $gallery->id,
      'url' => trim(Input::get('url')),
      'url_thumb' => trim(Input::get('url_thumb')),
      'title' => trim(Input::get('title')),
      'alt' => trim(Input::get('alt')),
      'description' => trim(Input::get('description')),
      'type' => trim(Input::get('type')),
      'sort_order' => trim(Input::get('sort_order')),
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for new data
    $rules = array(
      'url' => 'required',
      'url_thumb' => 'required',
      'title' => 'required'
    );

    // make the validator
    $v = Validator::make($new_image, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/addimage/'.$gallery->id)->with_errors($v)->with_input();
    }

    // create the new image
    $image = new Image($new_image);
    $image->save();

    // redirect to gallery
    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','A new image has been added');
    
  }
  
  public function get_editimage()
  {
    $image_id = URI::Segment(4);
    $image = Image::find($image_id);
    
    $gallery = Image::find($image_id)->gallery()->first();
    
    return View::make('user.galleries.editimage')->with('image', $image)->with('gallery', $gallery);
  }
  
  public function post_editimage()
  {
    $image_id = URI::Segment(4);
    $image = Image::find($image_id);
    
    $gallery = Image::find($image_id)->gallery()->first();

    $update_image = array(
      'url' => trim(Input::get('url')),
      'url_thumb' => trim(Input::get('url_thumb')),
      'title' => trim(Input::get('title')),
      'alt' => trim(Input::get('alt')),
      'description' => trim(Input::get('description')),
      'sort_order' => trim(Input::get('sort_order')),
      'visibility' => trim(Input::get('visible'))
    );

    // set up rules for data
    $rules = array(
      'url' => 'required',
      'url_thumb' => 'required',
      'title' => 'required'
    );

    // make the validator
    $v = Validator::make($update_image, $rules);

    if ($v->fails()) {
      // redirect to form
      // errors
      return Redirect::to('user/galleries/editimage/'.$gallery->id)->with_errors($v)->with_input();
    }

    $image->update($image->id, $update_image);

    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','The image has been updated');
  }  

  public function get_removeimage()
  {
    $image_id = URI::Segment(4);
    $image = Image::find($image_id);
    
    return View::make('user.galleries.removeimage')->with('image', $image);
  }
  
  public function post_removeimage()
  {
    $image_id = URI::Segment(4);
    $image = Image::find($image_id);
    
    $gallery = Image::find($image_id)->gallery()->first();
    
    // delete post
    $image->delete();

    return Redirect::to('user/galleries/view/'.$gallery->id)->with('success','The image has been removed from the gallery.');
  }
  
}