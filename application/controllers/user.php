<?php

Class User_Controller extends Base_Controller {
  
  public function __construct()
  {
    $this->filter('before', array('auth'))->except(array('index'));
  }
  
  public function action_index()
  {
    if (Auth::check()) {
      return Redirect::to('user/home');
    }
    else {
      if (Input::has('login')) {
        $credentials = array('username' => Input::get('email'), 'password' => Input::get('password'));
        
        if (Auth::attempt($credentials)) {
          $_SESSION['isLoggedIn'] = true; // True/false if user is logged in or not, should be same as above
          $_SESSION['moxiemanager.filesystem.rootpath'] = "/var/www/htdocs/myroot"; // Set a root path for this use
          
          Session::forget('login-error');
          
          return Redirect::to('user/home');
        }
        else {
          Session::put('login-error', 'Invalid Login Details.');
        }  
      }
    }
    
    return View::make('user.login');
  }
  
  public function action_home()
  {
    if (Auth::user()->administrator == 1) {
      return View::make('user.administrator');
    }
    else {
      return View::make('user.user');
    }
  }

  public function action_logout()
  {
      Auth::logout();

      return Redirect::to('/');
  }
  
}