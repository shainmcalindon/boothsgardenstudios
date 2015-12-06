<?php

class Quotations_Controller extends Base_Controller 
{
  public $restful = true;

  public function __construct()
  {
    if (is_numeric(URI::Segment(3))) {
      $this->layout_id = URI::Segment(3);
    }
  }

  public function get_index()
  {        
      $data = new stdClass();
      $data->title = 'Price List';
      $data->layouts = Layouts::get_layouts();
      $data->errors = array();
      
      $galleries = Gallery::order_by('sort_order', 'asc')->get();

      return View::make('quotations.index')->with('data',$data)->with('galleries', $galleries);
  }

  public function post_index()
  {        
      $data = new stdClass();
      $data->title = 'Quote Request';
      $data->layouts = Layouts::get_layouts();
      $data->errors = array();
      $data->full_cost = 0;

      $input = Input::get();

      if (count($input) > 0)
      {
          $rules = array(
              'postcode' => 'required|valid_outcode:true',
              'size' => 'required',
          );      

          $messages = array(
              'valid_outcode' => 'The postcode was not found in our database',
          );

          Validator::register('valid_outcode', function($attribute, $value, $parameters)
              {
                  $postcodes = new Postcodes();
                  return $postcodes->ValidOutcode($value);
          });

          $validation = Validator::make($input, $rules, $messages);

          if ($validation->fails())
          {
              $data->errors = $validation->errors->all();
          } else {     

              $postcodes = new Postcodes();
              $distance  = $postcodes->HowFar(trim($input['postcode']));
              $layout    = $data->layouts[$input['size']];
              
              /*$travel_allowance = $distance*0.4;
              $hotel_allowance = $distance*0.4*$layout->men_days;
              $fuel = $distance*2*0.4*$layout->vans_needed;
              $transport_cost = $travel_allowance+$hotel_allowance+$fuel; */
              
              $transport_base = 300;
              $fuel = $distance*6.50;
              $transport_cost = $transport_base+$fuel;

              $data->full_cost = number_format($transport_cost+$layout->cost);
      
              $galleries = Gallery::order_by('sort_order', 'asc')->get();
              
              return View::make('quotations.index')->with('data',$data)->with('galleries', $galleries);
          }
      } 
      
      $galleries = Gallery::order_by('sort_order', 'asc')->get();
      
      return View::make('quotations.index')->with('data',$data)->with('galleries', $galleries);

  }

  public function get_view()
  {
    $data['layout'] = Layout::find($this->layout_id);
    $data['formatted_cost'] =  $data['layout'] == '' ? '' : '&pound;'.number_format($data['layout']->cost,2);
    $data['layouts'] = Layout::where('studio_id','=',$data['layout']->studio->id)->order_by('size_x', 'asc')->order_by('size_y', 'asc')->get();
    $galleries = Gallery::order_by('sort_order', 'asc')->get();
    
    return View::make('quotations.view')->with('data', $data)->with('galleries', $galleries);
  }
    
  public function get_create($size=null)
  {
	  $data = new stdClass();
	  $data->title = 'Quote Creation';
	  $data->layouts = Layouts::get_layouts();
	  $data->errors = array();

          // sss -> list valid sizes programmatically
	  
	  return View::make('quotations.create')->with('data',$data);
  }

      public function post_create()
      {
          try {
              $validation = Validator::make(Input::all(), array(
                  'email_address' => 'required|email',
                  'postcode' => 'required', //'required|valid_outcode:true',
                  'size' => 'required', // sss -> validate size here!
              ));

              //dd(Input::get('size'));

              if ($validation->passes()) {
                  $plan = new Plan();

                  $plan->setSize(Input::get('size'));

                  $plan->email_address = Input::get('email_address');
                  $plan->postcode = Input::get('postcode');
                  // sss -> save additional data

                  $plan->save();

                  return Redirect::to_action('quotations@edit', array(
                      urlencode(Crypter::encrypt($plan->get_key())),
                  ));
              }
              else {
                  return Redirect::to_action('quotations@create')
                      ->with_errors($validation)
                      ->with_input();
              }
          }
          catch (Exception $e) {
              Log::error($e);
              return Redirect::to_action('quotations@create')
                  ->with('error', 'Please select a valid plan size') // sss -> how to handle/display these?
                  ->with_input();
          }

      }

  public function get_edit($password=null)
  {
          $id = Crypter::decrypt(urldecode($password));

	  $data = new stdClass();
	  $data->title = 'Quote Editor';
	  $data->layouts = Layouts::get_layouts();
	  $data->errors = array();

	  try {
              $plan = Plan::find($id);
              if (!$plan) throw new Exception("Plan was not found");
          }
          catch (Exception $e) {
              Log::error($e);
              return Redirect::to_action('quotations@create')
                  ->with('error', "The plan requested was not found");
          }

	  $data->plan = $plan;

	  $data->options = Planoption::getGrouped();

	  return View::make('quotations.edit')->with('data',$data);
  }

    // this should be an ajax request
    public function post_save($id=null)
    {
        $plan = Plan::find($id);
        if (!$plan) return Response::make("The plan specified was not found", 404);

        // sss -> add validation?

        $table = Input::get('table');
        if (empty($table)) return Response::make('Data is missing', 400);
        if (!is_array($table)) return Response::make('Data is not in the correct format', 400);

        // valid structure?
        $table = array_values($table);
        foreach ($table as $k => $record) {
            if (!isset($record['id'])) return Response::make("Missing id value for #{$k}", 400);
            if (!isset($record['row'])) return Response::make("Missing row value for #{$k}", 400);
            if (!isset($record['column'])) return Response::make("Missing column value for #{$k}", 400);
            if (!isset($record['quantity'])) return Response::make("Missing quantity value for #{$k}", 400);
        }

        // validate plan options
        $ids = Planoption::select('id')->lists('id');
        foreach ($table as $record) if (!in_array($record['id'], $ids)) return Response::make("Invalid id#{$record['id']}", 400);

        // sss -> more/better validation

        try {
            DB::transaction(function() use ($table, $plan) {
                $plan->planoptions()->delete(); // detach existing associations
                foreach ($table as $record) {
                    $plan->planoptions()->attach($record['id'], array(
                        'row' => $record['row'],
                        'column' => $record['column'],
                        'quantity' => $record['quantity'],
                    ));
                }
            });

            return Response::make("The plan was saved");
        }
        catch (Exception $e) {
            Log::error($e);
            return Response::make("Error saving the plan", 500);
        }
    }

    public function get_submitted()
    {
        $data = new stdClass();
        $data->title = 'Quote Submitted';
        $data->layouts = Layouts::get_layouts();
        $data->errors = array();

        return View::make('quotations.submitted')->with('data',$data);
    }
}

?>