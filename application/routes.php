<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', function() {
    $organisation = Organisation::find(1);
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();
   
    $data['galleries'] = $galleries;
    
    return View::make('pages.index')->with($data);
});
Route::get('/contact', function() {
    $organisation = Organisation::find(1);
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();
    
    $title = 'Contact | Booths Garden Studios';
    
    return View::make('pages.contact')->with('title', $title)->with('galleries', $galleries);
});
Route::post('/contact', function() {
    $organisation = Organisation::find(1);
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();
    
    $title = 'Contact | Booths Garden Studios';
    
    $mailer = IoC::resolve('phpmailer');
    
    $input = array(
        'name' => trim(Input::get('name')),
        'email' => trim(Input::get('email')),
        'phone' => trim(Input::get('phone')),
        'postcode' => trim(Input::get('postcode')),
        'message' => trim(Input::get('message'))
    );
    
    $rules = array(
      'name' => 'required',
      'email' => 'required|email',
      'postcode' => 'required',
      'message' => 'required'
    );
    
    $v = Validator::make($input, $rules);
    
    if (!$v->fails()) {
        try{
            $mailer->IsSMTP(); // enable SMTP
            $mailer->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
            $mailer->SMTPAuth = true;  // authentication enabled
            //$mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mailer->Host = 'mail.shandydigital.co.uk';
            $mailer->Port = 25; 
            $mailer->Username = 'noreply@shandydigital.co.uk';  
            $mailer->Password = '-Cbch-zg*%p;';
            $mailer->FromName = $input['name'];
            $mailer->AddReplyTo($input['email'], $input['name']);
            //$mailer->AddAddress('info@boothsgardenstudios.co.uk');
            $mailer->AddAddress('iain@boothsgardenstudios.co.uk');
            $mailer->AddBCC('shain-o@hotmail.com');
            $mailer->Subject = 'Booths Website Enquiry';
            $mailer->Body = "Name: ".$input['name']."\n\nEmail: ".$input['email']."\n\nPhone: ".$input['phone']."\n\nPostcode: ".$input['postcode']."\n\nMessage: ".$input['message'];
            $mailer->Send();
            
            $message = "Message was sent" . '<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1068866210/?label=8WFhCMi9slYQorXW_QM&amp;guid=ON&amp;script=0"/>';
            $class = "success";
            
            return View::make('pages.contact')->with('galleries', $galleries)->with('message', $message)->with('class', $class);
        }
        catch (Exception $e) {
            Input::flash();
            $message = "Message was not sent: ".$e->getMessage();
            $class = "danger";
            
            return View::make('pages.contact')->with('title', $title)->with('galleries', $galleries)->with('errors', $v->errors)->with('message', $message)->with('class', $class)->with('class', 'danger')->with_input();
        }
    }
    
    Input::flash();
    
    return View::make('pages.contact')->with('galleries', $galleries)->with('errors', $v->errors)->with('class', 'danger')->with_input();
});
Route::get('/case-studies', function() {
    $organisation = Organisation::find(1);
    $posts = $organisation->posts()->where('visibility', '=', '1')->order_by('created_at', 'desc')->paginate(20);
    $latest_posts = $organisation->posts()->order_by('created_at', 'desc')->where('visibility', '=', '1')->take(5)->get();
    $categories = $organisation->categories()->where('visibility', '=', '1')->order_by('title')->get();
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.blog.blog')->with('posts', $posts)->with('categories', $categories)->with('latest_posts', $latest_posts)->with('galleries', $galleries);
});
Route::get('/case-studies/view/(:any)', function($post) {
    $post = Post::where('slug', '=', $post)->first();
    $organisation = Organisation::find(1);

    $title = $post->seo_title ? $post->seo_title : $post->title;
    $description = $post->seo_description;
    $keywords = $post->seo_keywords;

    $latest_posts = $organisation->posts()->order_by('created_at', 'desc')->where('visibility', '=', '1')->take(5)->get();
    $categories = $organisation->categories()->where('visibility', '=', '1')->order_by('title')->get();
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.blog.post')->with('post', $post)->with('categories', $categories)->with('latest_posts', $latest_posts)->with('title', $title)->with('description', $description)->with('keywords', $keywords)->with('galleries', $galleries); 
});
Route::get('case-studies/categories/(:any)', function($category) {
    $category = Category::where('slug', '=', $category)->first();
    $organisation = Organisation::find(1);
    
    $latest_posts = $organisation->posts()->order_by('created_at', 'desc')->where('visibility', '=', '1')->take(5)->get();
    $categories = $organisation->categories()->where('visibility', '=', '1')->order_by('title')->get();
    $posts = $category->posts()->where('visibility', '=', '1')->order_by('created_at', 'desc')->paginate(20);
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.blog.blog')->with('posts', $posts)->with('categories', $categories)->with('category', $category)->with('latest_posts', $latest_posts)->with('galleries', $galleries); 
});
Route::get('/faqs', function() {
    $organisation = Organisation::find(1);
    $faqs = $organisation->faqs()->order_by('sort_order', 'asc')->get();
    
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.faqs')->with('faqs', $faqs)->with('galleries', $galleries);
});
Route::get('/galleries/(:any)', function($gallery) {
    $gallery = Gallery::where('slug', '=', $gallery)->first();
    $organisation = Organisation::find(1);
    
    $images = $gallery->images;
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.gallery')->with('images', $images)->with('gallery', $gallery)->with('galleries', $galleries);
});
Route::get('/videos', function() {
    $images = Gallery::find(2)->images;
    $organisation = Organisation::find(1);
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    return View::make('pages.videos')->with('images', $images)->with('galleries', $galleries);
});
Route::get('/support', function() {
    $organisation = Organisation::find(1);
    $testimonials = $organisation->testimonials()->order_by(DB::raw('RAND()'))->take(2)->get();
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    $title = 'Support | Booths Garden Studios';
    // $description = '';
    // $keywords = '';

    return View::make('pages.support')->with('title', $title)->with('testimonials', $testimonials)->with('galleries', $galleries);
});
Route::post('/support', function() {
    $organisation = Organisation::find(1);
    $testimonials = $organisation->testimonials()->order_by(DB::raw('RAND()'))->take(2)->get();
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();
    
    $mailer = IoC::resolve('phpmailer');
    
    $input = array(
        'name' => trim(Input::get('name')),
        'email' => trim(Input::get('email')),
        'phone' => trim(Input::get('phone')),
        'issue' => trim(Input::get('issue')),
        'image' => trim(Input::get('image')),
        'day' => trim(Input::get('day'))
    );
    
    $rules = array(
      'name' => 'required',
      'email' => 'required',
      'issue' => 'required'
    );
    
    $v = Validator::make($input, $rules);
    
    if (!$v->fails()) {
        try{
            $mailer->IsSMTP(); // enable SMTP
            $mailer->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
            $mailer->SMTPAuth = true;  // authentication enabled
            //$mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mailer->Host = 'mail.shandydigital.co.uk';
            $mailer->Port = 25; 
            $mailer->Username = 'noreply@shandydigital.co.uk';  
            $mailer->Password = '-Cbch-zg*%p;';
            $mailer->FromName = $input['name'];
            $mailer->AddReplyTo($input['email'], $input['name']);
            //$mailer->AddAddress('info@boothsgardenstudios.co.uk');
            $mailer->AddAddress('iain@boothsgardenstudios.co.uk');
            //$mailer->AddBCC('shain-o@hotmail.com');
            $mailer->Subject = 'Booths Support Enquiry';
            $mailer->Body = "Name: ".$input['name']."\n\nEmail: ".$input['email']."\n\nPhone: ".$input['phone']."\n\nIssue: ".$input['issue']."\n\nBest day/time for visit: ".$input['day'];
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
              $mailer->AddAttachment($_FILES['image']['tmp_name'], $_FILES['image']['name']);
            }
            
            $mailer->Send();
            
            $message = "Message was sent";
            $class = "success";
            
            return View::make('pages.support')->with('title', $title)->with('testimonials', $testimonials)->with('galleries', $galleries)->with('message', $message)->with('class', $class);
        }
        catch (Exception $e) {
            Input::flash();
            $message = "Message was not sent: ".$e->getMessage();
            $class = "danger";
            
            return View::make('pages.support')->with('title', $title)->with('testimonials', $testimonials)->with('galleries', $galleries)->with('errors', $v->errors)->with('message', $message)->with('class', 'danger')->with_input();
        }
    }
    Input::flash();
    return View::make('pages.support')->with('title', $title)->with('testimonials', $testimonials)->with('galleries', $galleries)->with('errors', $v->errors)->with('class', 'danger')->with_input();
});
Route::get('/(:any)', function($page) {
    $page = Page::where('slug', '=', $page)->first();
    $organisation = Organisation::find(1);
    $testimonials = $organisation->testimonials()->order_by(DB::raw('RAND()'))->take(2)->get();

    $title = $page->seo_title ? $page->seo_title : $page->title;
    $description = $page->seo_description;
    $keywords = $page->seo_keywords;
    $galleries = $organisation->galleries()->order_by('sort_order', 'asc')->get();

    if (is_null($page))
      return Event::first('404');

    return View::make('pages.page')->with('page', $page)->with('title', $title)->with('description', $description)->with('keywords', $keywords)->with('testimonials', $testimonials)->with('galleries', $galleries);
});

Route::controller('user.pages');
Route::controller('user.posts');
Route::controller('user.categories');
Route::controller('user.galleries');
Route::controller('user.faqcategories');
Route::controller('user.faqs');
Route::controller('user.testimonials');
Route::controller('user.pricing');
Route::controller('user');
Route::controller('quotations');

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
  {
    return Response::error('404');
});

Event::listen('500', function()
  {
    return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
  {
    // Do stuff before every request to your application...
});

Route::filter('after', function($response)
  {
    // Do stuff after every request to your application...
});

Route::filter('csrf', function()
  {
    if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
  {
    if (Auth::guest()) {
      Session::flash('error', 'You do not have access level to be there.');
      return Redirect::to('user');
    }
});

Route::filter('admin', function()
  {
    if (Auth::user()->administrator == 0) {
      Session::flash('error', 'You do not have access level to be there.');
      return Redirect::to('user');
    }
});
Route::filter('valid_client', function()
  {
    $client_id = URI::Segment(4);
    $user = User::Find($client_id);
    if(!is_numeric($user->id)) {
      Session::flash('error', 'Unknown user.');
      return Redirect::to('user/clients/');  
    }
});