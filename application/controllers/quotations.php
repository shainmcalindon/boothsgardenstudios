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



    /*
     * Reset quotation end point
     */
    public function get_reset()
    {
        self::resetQuotationSession();
        return Redirect::to_action('quotations');
    }


    /*
     * Step 1 - Initial studio size selection
     */
    public function get_index()
    {
        // Load page
        $data = new stdClass();
        $data->title = 'Price List';
        $data->layouts = Layouts::get_layouts();
        $data->error = (Session::get('error')) ? Session::get('error') : '';
        $data->size = (Session::get('quote_size')) ? Session::get('quote_size') : '';
        $data->postcode = (Session::get('postcode')) ? Session::get('postcode') : ''; // old
        $data->establishedQuote = self::establishedQuote();
        return View::make('quotations.index')->with('data', $data);
    }


    /*
     * Step 2 - View info page / make sure all required data is provided and saved into session
     */
    public function post_view()
    {
        // Get post data
        $size = Input::get('size');

        // Make sure data is valid
        $error = '';
        if(empty($size)){
            $error = 'Please pick a studio size and provide your post code';
        }elseif(($layout = Layouts::get_layoutsByCode($size)) === false){
            $error = 'Unable to find the studio layout you have selected. Please select from the list below';
        }

        // If we have errors take the user back to the previous step and show the error messages
        if($error){
            // We have an error take user back to first step
            return Redirect::to_action('quotations')->with('error', $error)->with('size', $size);
        }else{
            $data['layout'] = Layouts::get_layoutsByCode($size);

            // Set session data so we remember in new requests
            //\Laravel\Session::put('quote_layout', $data['layout']);
            //\Laravel\Session::put('quote_layout_id', $data['layout']->id);
            //\Laravel\Session::put('quote_size', $size);

            return Redirect::to_action('quotations/view', array('id' => $data['layout']->id));
        }
    }


    /*
     * Step 2 - View layout info page using GET request
     */
    public function get_view(){
        // Convert a GET request layout ID to url format
        if(Input::get('layout_id', null) !== null) return Redirect::to_action('quotations/view', array('id' => Input::get('layout_id')));

        // Make sure we have the layout ID
        $layout_id = URI::segment(3);
        if(is_null($layout_id) && \Laravel\Session::get('quote_layout_id', null) !== null) return Redirect::to_action('quotations/view', array('id' => \Laravel\Session::get('quote_layout_id')));
        if(is_null($layout_id)) return Redirect::to_action('quotations');

        // Load page
        $data['layout'] = Layout::find($layout_id);
        if($data['layout'] === null){
            return Redirect::to_action('quotations')->with('error', 'Unable to find the studio layout you have selected. Please select from the list below');
        }
        $data['formatted_cost'] =  $data['layout'] == '' ? '' : '&pound;'.number_format($data['layout']->cost,2);
        $data['layouts'] = Layout::where('studio_id','=',$data['layout']->studio_id)->order_by('size_x', 'asc')->order_by('size_y', 'asc')->get();

        $data['size'] = $data['layout']->size_x . 'x' . $data['layout']->size_y;
        $data['postcode'] = (Session::get('postcode')) ? Session::get('postcode') : \Laravel\Session::get('quote_postcode');
        $data['layout_id'] = $layout_id;
        $data['error'] = (Session::get('error')) ? Session::get('error') : '';
        $data['success'] = (Session::get('success')) ? Session::get('success') : '';
        $data['establishedQuote'] = self::establishedQuote();
        $data['quotation_current_price'] = '&pound;' . number_format(Quotation::calcSessionQuotationCurrentValue(), 2);

        // Its possible the selected layout has been changed
        // If this is the case we want to flush session data as we dont want any of the previous quotation customise data presisting and potentially causing errors
        if(\Laravel\Session::get('quote_layout_id', null) !== null){
            if((int)\Laravel\Session::get('quote_layout_id') !== $data['layout']->id){
                self::resetQuotationSession();
                return Redirect::back();
            }
        }

        return View::make('quotations.view')->with('data', $data);
    }


    /*
     * Step 3 - Initial Customise
     */
    public function get_customise()
    {
        // Get post data
        $layout = \Laravel\Session::get('quote_layout', null);
        $layout_id = \Laravel\Session::get('quote_layout_id', null);
        $size = \Laravel\Session::get('quote_size', null);
        $postcode = \Laravel\Session::get('quote_postcode', null);
        return self::build_customise_page($layout, $layout_id, $size, $postcode);
    }

    public function post_customise()
    {
        // Get post data
        $layout = null;
        $layout_id = Input::get('layout_id');
        $size = Input::get('size');
        $postcode = Input::get('postcode');
        return self::build_customise_page($layout, $layout_id, $size, $postcode, true);
    }

    // Build customise page from GET and POST requests
    // This allows form submission but also allows the user to navigate directly to the page URL
    private function build_customise_page($layout = null, $layout_id, $size, $postcode, $saveSessionData = false){
        // If layout is null get it from DB
        if($layout === null) $layout = $layout = Layouts::get_layoutsByCode($size);

        // Make sure data is valid
        if(empty($size)) {
            // We have an error take user back to first step
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size')->with('size', $size)->with('postcode', $postcode);
        }elseif($layout === false){
            // We have an error take user back to first step
            return Redirect::to_action('quotations')->with('error', 'Unable to find the studio layout you have selected. Please select from the list below')->with('size', $size)->with('postcode', $postcode);
        }elseif(empty($postcode)){
            // We have an error take user back to first step
            return Redirect::to_action('quotations/view/' . $layout_id)->with('error', 'Please provide post code')->with('size', $size)->with('postcode', $postcode);
        }elseif(!Postcodes::ValidOutcode($postcode)){
            // We have an error take user back to first step
            return Redirect::to_action('quotations/view/' . $layout_id)->with('error', 'Postcode is not valid, please provide a valid UK postcode')->with('postcode', $postcode);
        }

        // Set session data so we remember in new requests
        // Its possible we may get here by skipping the initial price grid page and come in via the view studio info page
        if($saveSessionData){
            \Laravel\Session::put('quote_layout', $layout);
            \Laravel\Session::put('quote_layout_id', $layout_id);
            \Laravel\Session::put('quote_size', $size);
            \Laravel\Session::put('quote_postcode', $postcode);
        }

        // Calc available space based on studio size
        $slotsBreakdown = Layouts::layoutWallSlotsBreakdown($layout->id);
        $maximum_slots = $slotsBreakdown['totalSlots'];

        // Load page
        $data = new stdClass();
        //$data->title = 'Customise Studio';
        //$data->size = $size;
        //$data->postcode = $postcode;
        $data->layout = $layout;
        $data->maximum_slots = $maximum_slots;
        $data->allocated_doors_windows = $slotsBreakdown['singleLargeSideSlots']; // 1 door + remainder of the same side as windows for initial start
        $data->allocated_walls = $data->maximum_slots - $data->allocated_doors_windows;

        // Delivery information
        $data->delivery = Quotation::calcDeliver();

        // Slots per single large / small side
        $data->sizeSlots = new stdClass();
        $data->sizeSlots->singleLargeSideSlots = $slotsBreakdown['singleLargeSideSlots'];
        $data->sizeSlots->singleSmallSideSlots = $slotsBreakdown['singleSmallSideSlots'];

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue('init');
        $data->costs->swap_window_wall = QuotationPriceAdjustments::getPrice('swap_window_wall');
        $data->costs->swap_wall_window = QuotationPriceAdjustments::getPrice('swap_wall_window');
        $data->costs->add_extra_door = QuotationPriceAdjustments::getPrice('add_extra_door');
        $data->costs->add_fanlight_window = QuotationPriceAdjustments::getPrice('add_fanlight_window');
        $data->costs->add_half_window = QuotationPriceAdjustments::getPrice('add_half_window');
        $data->costs->add_1820_window = QuotationPriceAdjustments::getPrice('add_1820_window');

        // Notes
        $data->help = new stdClass();
        $data->help->swap_window_wall = QuotationPriceAdjustments::getNote('swap_window_wall');
        $data->help->swap_wall_window = QuotationPriceAdjustments::getNote('swap_wall_window');
        $data->help->add_extra_door = QuotationPriceAdjustments::getNote('add_extra_door');
        $data->help->add_fanlight_window = QuotationPriceAdjustments::getNote('add_fanlight_window');
        $data->help->add_half_window = QuotationPriceAdjustments::getNote('add_half_window');
        $data->help->add_1820_window = QuotationPriceAdjustments::getNote('add_1820_window');

        // Field defaults
        $data->defaults = new stdClass();
        $data->defaults->swap_window_wall = \Laravel\Session::get('quote_customise_swap_window', 0);
        $data->defaults->swap_wall_window = \Laravel\Session::get('quote_customise_swap_wall', 0);
        $data->defaults->add_extra_door = \Laravel\Session::get('quote_customise_extra_door', 0);
        $data->defaults->add_fanlight_window = \Laravel\Session::get('quote_customise_fanlight', 0);
        $data->defaults->add_half_window = \Laravel\Session::get('quote_customise_half_window', 0);
        $data->defaults->add_1820_window = \Laravel\Session::get('quote_customise_picture_window', 0);

        return View::make('quotations.customise')->with('data', $data);
    }



    /*
     * Step 4 - Decking
     */
    public function get_add_decking()
    {
        return self::build_decking_page(\Laravel\Session::get('quote_layout'));
    }

    public function post_add_decking()
    {
        // Get wall, window and door settings
        $swap_window = Input::get('swap_window', null);
        $swap_wall = Input::get('swap_wall', null);
        $extra_door = Input::get('extra_door', null);
        $fanlight = Input::get('fanlight', null);
        $half_window = Input::get('half_window', null);
        $picture_window = Input::get('picture_window', null);

        // We are missing required data, lets restart
        if(is_null($swap_window) || is_null($swap_wall) || is_null($extra_door) || is_null($fanlight) || is_null($half_window) || is_null($picture_window)){
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size');
        }

        // Save customise settings into session
        \Laravel\Session::put('quote_customise_swap_window', $swap_window);
        \Laravel\Session::put('quote_customise_swap_wall', $swap_wall);
        \Laravel\Session::put('quote_customise_extra_door', $extra_door);
        \Laravel\Session::put('quote_customise_fanlight', $fanlight);
        \Laravel\Session::put('quote_customise_half_window', $half_window);
        \Laravel\Session::put('quote_customise_picture_window', $picture_window);

        return self::build_decking_page(\Laravel\Session::get('quote_layout'));
    }

    private function build_decking_page($layout)
    {
        // Calc available space based on studio size
        $slotsBreakdown = Layouts::layoutWallSlotsBreakdown($layout->id);
        $maximum_slots = $slotsBreakdown['totalSlots'] + 4; // Add 4 slots for cheap additional corner on the outside

        $data = new stdClass();
        $data->maximum_slots = $maximum_slots;

        // Slots per single large / small side
        $data->sizeSlots = new stdClass();
        $data->sizeSlots->singleLargeSideSlots = $slotsBreakdown['singleLargeSideSlots'];
        $data->sizeSlots->singleSmallSideSlots = $slotsBreakdown['singleSmallSideSlots'];

        // Delivery information
        $data->delivery = Quotation::calcDeliver();

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue('customise');
        $data->costs->composite_deck_910_910 = QuotationPriceAdjustments::getPrice('composite_deck_910_910');
        $data->costs->composite_deck_910_1820 = QuotationPriceAdjustments::getPrice('composite_deck_910_1820');
        $data->costs->composite_deck_910_2730 = QuotationPriceAdjustments::getPrice('composite_deck_910_2730');
        $data->costs->flyover_roof_910_910 = QuotationPriceAdjustments::getPrice('flyover_roof_910_910');
        $data->costs->flyover_roof_910_1820 = QuotationPriceAdjustments::getPrice('flyover_roof_910_1820');
        $data->costs->flyover_roof_910_2730 = QuotationPriceAdjustments::getPrice('flyover_roof_910_2730');

        // Notes
        $data->help = new stdClass();
        $data->help->composite_deck_910_910 = QuotationPriceAdjustments::getNote('composite_deck_910_910');
        $data->help->composite_deck_910_1820 = QuotationPriceAdjustments::getNote('composite_deck_910_1820');
        $data->help->composite_deck_910_2730 = QuotationPriceAdjustments::getNote('composite_deck_910_2730');
        $data->help->flyover_roof_910_910 = QuotationPriceAdjustments::getNote('flyover_roof_910_910');
        $data->help->flyover_roof_910_1820 = QuotationPriceAdjustments::getNote('flyover_roof_910_1820');
        $data->help->flyover_roof_910_2730 = QuotationPriceAdjustments::getNote('flyover_roof_910_2730');

        // Field defaults
        $data->defaults = new stdClass();
        $data->defaults->composite_deck_910_910 = \Laravel\Session::get('quote_decking_composite_deck_910_910', 0);
        $data->defaults->composite_deck_910_1820 = \Laravel\Session::get('quote_decking_composite_deck_910_1820', 0);
        $data->defaults->composite_deck_910_2730 = \Laravel\Session::get('quote_decking_composite_deck_910_2730', 0);
        $data->defaults->flyover_roof_910_910 = \Laravel\Session::get('quote_decking_flyover_roof_910_910', 0);
        $data->defaults->flyover_roof_910_1820 = \Laravel\Session::get('quote_decking_flyover_roof_910_1820', 0);
        $data->defaults->flyover_roof_910_2730 = \Laravel\Session::get('quote_decking_flyover_roof_910_2730', 0);

        return View::make('quotations.add_decking')->with('data', $data);
    }



    /*
     * Step 5 - Electrics
     */
    public function get_add_electrics()
    {
        return self::build_electrics_page();
    }

    public function post_add_electrics()
    {
        // Get decking and flyover data
        $dec_910 = Input::get('dec_910', null);
        $dec_1820 = Input::get('dec_1820', null);
        $dec_2730 = Input::get('dec_2730', null);
        $roof_910 = Input::get('roof_910', null);
        $roof_1820 = Input::get('roof_1820', null);
        $roof_2730 = Input::get('roof_2730', null);

        // We are missing required data, lets restart
        if(is_null($dec_910) || is_null($dec_1820) || is_null($dec_2730) || is_null($roof_910) || is_null($roof_1820) || is_null($roof_2730)){
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size');
        }

        // Save customise settings into session
        \Laravel\Session::put('quote_decking_composite_deck_910_910', $dec_910);
        \Laravel\Session::put('quote_decking_composite_deck_910_1820', $dec_1820);
        \Laravel\Session::put('quote_decking_composite_deck_910_2730', $dec_2730);
        \Laravel\Session::put('quote_decking_flyover_roof_910_910', $roof_910);
        \Laravel\Session::put('quote_decking_flyover_roof_910_1820', $roof_1820);
        \Laravel\Session::put('quote_decking_flyover_roof_910_2730', $roof_2730);

        return self::build_electrics_page();
    }

    private function build_electrics_page(){
        $data = new stdClass();

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue('deckingflyover');
        $data->costs->electrics_double_sockets_450 = QuotationPriceAdjustments::getPrice('electrics_double_sockets_450');
        $data->costs->electrics_double_sockets_1150 = QuotationPriceAdjustments::getPrice('electrics_double_sockets_1150');
        $data->costs->electrics_light_switch = QuotationPriceAdjustments::getPrice('electrics_light_switch');
        $data->costs->electrics_panel_heater = QuotationPriceAdjustments::getPrice('electrics_panel_heater');
        $data->costs->electrics_double_floor_socket = QuotationPriceAdjustments::getPrice('electrics_double_floor_socket');
        $data->costs->electrics_fused_spur_socket = QuotationPriceAdjustments::getPrice('electrics_fused_spur_socket');

        // Notes
        $data->help = new stdClass();
        $data->help->electrics_double_sockets_450 = QuotationPriceAdjustments::getNote('electrics_double_sockets_450');
        $data->help->electrics_double_sockets_1150 = QuotationPriceAdjustments::getNote('electrics_double_sockets_1150');
        $data->help->electrics_light_switch = QuotationPriceAdjustments::getNote('electrics_light_switch');
        $data->help->electrics_panel_heater = QuotationPriceAdjustments::getNote('electrics_panel_heater');
        $data->help->electrics_double_floor_socket = QuotationPriceAdjustments::getNote('electrics_double_floor_socket');
        $data->help->electrics_fused_spur_socket = QuotationPriceAdjustments::getNote('electrics_fused_spur_socket');

        // Field defaults
        $data->defaults = new stdClass();
        $data->defaults->electrics_double_sockets_450 = \Laravel\Session::get('quote_electrics_double_sockets_450', 0);
        $data->defaults->electrics_double_sockets_1150 = \Laravel\Session::get('quote_electrics_double_sockets_1150', 0);
        $data->defaults->electrics_light_switch = \Laravel\Session::get('quote_electrics_light_switch', 0);
        $data->defaults->electrics_panel_heater = \Laravel\Session::get('quote_electrics_panel_heater', 0);
        $data->defaults->electrics_double_floor_socket = \Laravel\Session::get('quote_electrics_double_floor_socket', 0);
        $data->defaults->electrics_fused_spur_socket = \Laravel\Session::get('quote_electrics_fused_spur_socket', 0);

        return View::make('quotations.add_electrics')->with('data', $data);
    }



    /*
     * Step 6 - Interior
     */
    public function get_add_interior()
    {
        return self::build_interior_page();
    }

    public function post_add_interior()
    {
        // Get decking and flyover data
        $sockets_450 = Input::get('sockets_450', null);
        $sockets_1150 = Input::get('sockets_1150', null);
        $light_switches = Input::get('light_switches', null);
        $panel_heater = Input::get('panel_heater', null);
        $double_floor_socket = Input::get('double_floor_socket', null);
        $spur_socket = Input::get('spur_socket', null);

        // We are missing required data, lets restart
        if(is_null($sockets_450) || is_null($sockets_1150) || is_null($light_switches) || is_null($panel_heater) || is_null($double_floor_socket) || is_null($spur_socket)){
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size');
        }

        // Save customise settings into session
        \Laravel\Session::put('quote_electrics_double_sockets_450', $sockets_450);
        \Laravel\Session::put('quote_electrics_double_sockets_1150', $sockets_1150);
        \Laravel\Session::put('quote_electrics_light_switch', $light_switches);
        \Laravel\Session::put('quote_electrics_panel_heater', $panel_heater);
        \Laravel\Session::put('quote_electrics_double_floor_socket', $double_floor_socket);
        \Laravel\Session::put('quote_electrics_fused_spur_socket', $spur_socket);

        return self::build_interior_page();
    }

    private function build_interior_page(){
        $data = new stdClass();

        // Delivery information
        $data->delivery = Quotation::calcDeliver();

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue('electrics');
        $data->costs->silver_aluminium_venitian_blind_no_screws = QuotationPriceAdjustments::getPrice('silver_aluminium_venitian_blind_no_screws');
        $data->costs->recessed_blinds = QuotationPriceAdjustments::getPrice('recessed_blinds');
        $data->costs->internal_910_partition_wall = QuotationPriceAdjustments::getPrice('internal_910_partition_wall');
        $data->costs->internal_door_dividing_studio = QuotationPriceAdjustments::getPrice('internal_door_dividing_studio');
        $data->costs->internal_wall_corner_post = QuotationPriceAdjustments::getPrice('internal_wall_corner_post');

        // Notes
        $data->help = new stdClass();
        $data->help->silver_aluminium_venitian_blind_no_screws = QuotationPriceAdjustments::getNote('silver_aluminium_venitian_blind_no_screws');
        $data->help->recessed_blinds = QuotationPriceAdjustments::getNote('recessed_blinds');
        $data->help->internal_910_partition_wall = QuotationPriceAdjustments::getNote('internal_910_partition_wall');
        $data->help->internal_door_dividing_studio = QuotationPriceAdjustments::getNote('internal_door_dividing_studio');
        $data->help->internal_wall_corner_post = QuotationPriceAdjustments::getNote('internal_wall_corner_post');

        // Field defaults
        $data->defaults = new stdClass();
        $data->defaults->silver_aluminium_venitian_blind_no_screws = \Laravel\Session::get('quote_internals_silver_aluminium_venitian_blind_no_screws', 0);
        $data->defaults->recessed_blinds = \Laravel\Session::get('quote_internals_recessed_blinds', 0);
        $data->defaults->internal_910_partition_wall = \Laravel\Session::get('quote_internals_internal_910_partition_wall', 0);
        $data->defaults->internal_door_dividing_studio = \Laravel\Session::get('quote_internals_internal_door_dividing_studio', 0);
        $data->defaults->internal_wall_corner_post = \Laravel\Session::get('quote_internals_internal_wall_corner_post', 0);

        return View::make('quotations.add_interior')->with('data', $data);;
    }



    /*
     * Step 7 - Other
     */
    public function get_add_other()
    {
        return self::build_other_page();
    }

    public function post_add_other()
    {
        // Get decking and flyover data
        $silver_aluminum = Input::get('silver_aluminum', null);
        $recessed_blinds = Input::get('recessed_blinds', null);
        $internal_901mm = Input::get('internal_901mm', null);
        $internal_door = Input::get('internal_door', null);
        $internal_wall_corner = Input::get('internal_wall_corner', null);

        // We are missing required data, lets restart
        if(is_null($silver_aluminum) || is_null($recessed_blinds) || is_null($internal_901mm) || is_null($internal_door) || is_null($internal_wall_corner)){
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size');
        }

        // Save customise settings into session
        \Laravel\Session::put('quote_internals_silver_aluminium_venitian_blind_no_screws', $silver_aluminum);
        \Laravel\Session::put('quote_internals_recessed_blinds', $recessed_blinds);
        \Laravel\Session::put('quote_internals_internal_910_partition_wall', $internal_901mm);
        \Laravel\Session::put('quote_internals_internal_door_dividing_studio', $internal_door);
        \Laravel\Session::put('quote_internals_internal_wall_corner_post', $internal_wall_corner);

        return self::build_other_page();
    }

    private function build_other_page(){
        $data = new stdClass();

        // Delivery information
        $data->delivery = Quotation::calcDeliver();

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue('interior');
        $data->costs->decoupled_floor = QuotationPriceAdjustments::getPrice('other_decoupled_floor');
        $data->costs->aquastep_oak_floor = QuotationPriceAdjustments::getPrice('other_aquastep_oak_floor');
        $data->costs->walls_to_timber = QuotationPriceAdjustments::getPrice('other_walls_to_timber');
        $data->costs->taller_walls = QuotationPriceAdjustments::getPrice('other_taller_walls');
        $data->costs->entry_steps = QuotationPriceAdjustments::getPrice('other_entry_steps');
        $data->costs->entry_handrail = QuotationPriceAdjustments::getPrice('other_entry_handrail');
        $data->costs->skirt = QuotationPriceAdjustments::getPrice('other_skirt');

        // Notes
        $data->help = new stdClass();
        $data->help->decoupled_floor = QuotationPriceAdjustments::getNote('other_decoupled_floor');
        $data->help->aquastep_oak_floor = QuotationPriceAdjustments::getNote('other_aquastep_oak_floor');
        $data->help->walls_to_timber = QuotationPriceAdjustments::getNote('other_walls_to_timber');
        $data->help->taller_walls = QuotationPriceAdjustments::getNote('other_taller_walls');
        $data->help->entry_steps = QuotationPriceAdjustments::getNote('other_entry_steps');
        $data->help->entry_handrail = QuotationPriceAdjustments::getNote('other_entry_handrail');
        $data->help->skirt = QuotationPriceAdjustments::getNote('other_skirt');

        // Field defaults
        $data->defaults = new stdClass();
        $data->defaults->decoupled_floor = \Laravel\Session::get('quote_other_decoupled_floor', 0);
        $data->defaults->aquastep_oak_floor = \Laravel\Session::get('quote_other_aquastep_oak_floor', 0);
        $data->defaults->walls_to_timber = \Laravel\Session::get('quote_other_walls_to_timber', 0);
        $data->defaults->taller_walls = \Laravel\Session::get('quote_other_taller_walls', 0);
        $data->defaults->entry_steps = \Laravel\Session::get('quote_other_entry_steps', 0);
        $data->defaults->entry_handrail = \Laravel\Session::get('quote_other_entry_handrail', 0);
        $data->defaults->skirt = \Laravel\Session::get('quote_other_skirt', 0);

        return View::make('quotations.add_other')->with('data', $data);
    }



    /*
     * Step 8 - Complete
     */
    public function get_complete()
    {
        return self::build_complete_page();
    }

    public function post_complete()
    {
        // Get decking and flyover data
        $decoupled_floor = Input::get('decoupled_floor', null);
        $aquastep_oak_floor = Input::get('aquastep_oak_floor', null);
        $walls_to_timber = Input::get('walls_to_timber', null);
        $taller_walls = Input::get('taller_walls', null);
        $entry_steps = Input::get('entry_steps', null);
        $entry_handrail = Input::get('entry_handrail', null);
        $skirt = Input::get('skirt', null);

        // We are missing required data, lets restart
        if(is_null($decoupled_floor) || is_null($aquastep_oak_floor) || is_null($walls_to_timber) || is_null($taller_walls) || is_null($entry_steps) || is_null($entry_handrail) || is_null($skirt)){
            return Redirect::to_action('quotations')->with('error', 'Please pick a studio size');
        }

        // Save customise settings into session
        \Laravel\Session::put('quote_other_decoupled_floor', $decoupled_floor);
        \Laravel\Session::put('quote_other_aquastep_oak_floor', $aquastep_oak_floor);
        \Laravel\Session::put('quote_other_walls_to_timber', $walls_to_timber);
        \Laravel\Session::put('quote_other_taller_walls', $taller_walls);
        \Laravel\Session::put('quote_other_entry_steps', $entry_steps);
        \Laravel\Session::put('quote_other_entry_handrail', $entry_handrail);
        \Laravel\Session::put('quote_other_skirt', $skirt);

        return self::build_complete_page();
    }

    private function build_complete_page(){
        $data = new stdClass();
        $data->error = (Session::get('error')) ? Session::get('error') : '';

        // Delivery information
        $data->delivery = Quotation::calcDeliver();

        // Costs
        $data->costs = new stdClass();
        $data->costs->init_cost = Quotation::calcSessionQuotationCurrentValue();

        // Determine default email address
        if(\Laravel\Session::get('quote_email')){
            $data->email = \Laravel\Session::get('quote_email');
        }else{
            if(\Laravel\Session::get('quote_account_id')){
                $customer = Customer::find(\Laravel\Session::get('quote_account_id'));
                $data->email = $customer->email;
            }else{
                $data->email = '';
            }
        }

        // Random
        $data->quote_update = \Laravel\Session::get('quote_id') ? true : false;
        $data->quote_id = \Laravel\Session::get('quote_id', 0);

        return View::make('quotations.complete')->with('data', $data);
    }



    /*
     * Save quote post endpoint
     */
    public function post_save_quote()
    {
        $email = Input::get('email', null);
        $postcode = strtolower(str_replace(' ', '', \Laravel\Session::get('quote_postcode')));

        // Make sure email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return Redirect::to_action('quotations/complete')->with('error', 'Email address is invalid');

        // Find existing or create new customer account
        $customer = Customer::where('email', '=', $email)->where('postcode', '=', $postcode)->first();
        if(is_null($customer)){
            $customer = new Customer();
            $customer->email = $email;
            $customer->postcode = $postcode;
            $customer->save();
        }

        // Do we need to resend email?
        // Has the owner of the quote changed?
        $resendEmail = false;
        if(\Laravel\Session::get('quote_id')){
            $quote = Quotation::find(\Laravel\Session::get('quote_id'));
            $quote_customer = Customer::find($quote->customer_id);
            if($quote_customer->email != $email) $resendEmail = true;
        }

        // Save quote
        $quote = self::saveQuote($customer);

        // Send email if new quote
        // If save email is changed resent email
        if(\Laravel\Session::get('quote_id', 0) == 0 || $resendEmail){
            self::NewQuoteEmail($customer, $quote);
        }

        // Forget quote as its all saved now
        self::resetQuotationSession();

        return Redirect::to_action('quotations/sign_in')->with('success', 'Congratulations, Your studio has been saved in your account!');
    }



    /*
     * Sign in
     */
    public function get_sign_in()
    {
        $data = array();
        $data['success'] = (Session::get('success')) ? Session::get('success') : '';
        $data['error'] = (Session::get('error')) ? Session::get('error') : '';
        return View::make('quotations.sign_in')->with('data', $data);
    }

    public function post_sign_in()
    {
        $data = array();
        $data['success'] = '';

        $email = \Laravel\Input::get('email');
        $postcode = strtolower(str_replace(' ', '', \Laravel\Input::get('postcode'))); // Ensure upper case and spaces removed for better compatability
        $customer = Customer::where('email', '=', $email)->where('postcode', '=', $postcode)->first();

        if(!$customer){
            $data['error'] = 'Unable to locate an account matching these details!';
        }else{
            \Laravel\Session::put('quote_account_id', $customer->id);
            return Redirect::to_action('quotations/my_quotes');
        }

        return View::make('quotations.sign_in')->with('data', $data);
    }



    /*
     * Sign out
     */
    public function get_sign_out(){
        \Laravel\Session::forget('quote_account_id');
        return Redirect::to_action('quotations/sign_in')->with('success', 'You have been signed out');
    }















    public function get_my_quotes(){
        $customer_id = \Laravel\Session::get('quote_account_id');
        $customer = Customer::find($customer_id);

        // Does this customer exist and we are logged in?
        if(is_null($customer)) return Redirect::to_action('quotations/sign_in')->with('success', 'Please login to access this area!');



        dd("list quotes");



    }














    /*
     * Load quotation endpoint
     */
    public function get_my_quotes_load($quote_id){
        // If the user clicks the link in the email then this code is used to bypass the login process
        $code = \Laravel\Input::get('c', null);

        // Does quote exist
        $quote = $quote = Quotation::find($quote_id);
        if(is_null($quote)) return Redirect::to_action('quotations/sign_in')->with('success', 'Quote could not be found!');

        // Check if quote belongs to the logged in user
        // If code is present skip login user checks and authenticate with code
        if(is_null($code)){
            $customer_id = \Laravel\Session::get('quote_account_id');
            $customer = Customer::find($customer_id);
            if(is_null($customer) && $customer->id != $quote->id){
                return Redirect::to_action('quotations/sign_in')->with('success', 'Quote could not be found!');
            }
        }else{
            if($quote->quick_access_code != $code){
                return Redirect::to_action('quotations/sign_in')->with('success', 'Quote could not be found!');
            }
        }

        // Load quote into session data
        self::loadQuote($quote);

        return Redirect::to_action('quotations/view', array('id' => $quote->quotation_layouts_id))->with('success', 'Successfully loaded quotation #' . $quote->id . ', please progress to view or edit your quotation.');
    }



    /*
     * Are we in the middle of a quotation?
     */
    public function establishedQuote(){
        $layout = \Laravel\Session::get('quote_layout', null);
        $quote_layout_id = \Laravel\Session::get('quote_layout_id', null);
        $quote_size = \Laravel\Session::get('quote_size', null);

        if($layout !== null && $quote_layout_id !== null && $quote_size !== null) return true;
        return false;
    }



    /*
     * Handle clearing of a quotation session data for a new session to start
     */
    public function resetQuotationSession(){
        // Init
        \Laravel\Session::forget('quote_id');
        \Laravel\Session::forget('quote_email');
        \Laravel\Session::forget('quote_layout');
        \Laravel\Session::forget('quote_layout_id');
        \Laravel\Session::forget('quote_size');
        //\Laravel\Session::forget('quote_postcode'); // Lets remember the post code to make it easier for the user

        //Customise
        \Laravel\Session::forget('quote_customise_swap_window');
        \Laravel\Session::forget('quote_customise_swap_wall');
        \Laravel\Session::forget('quote_customise_extra_door');
        \Laravel\Session::forget('quote_customise_fanlight');
        \Laravel\Session::forget('quote_customise_half_window');
        \Laravel\Session::forget('quote_customise_picture_window');

        //Decking & floyover
        \Laravel\Session::forget('quote_decking_composite_deck_910_910');
        \Laravel\Session::forget('quote_decking_composite_deck_910_1820');
        \Laravel\Session::forget('quote_decking_composite_deck_910_2730');
        \Laravel\Session::forget('quote_decking_flyover_roof_910_910');
        \Laravel\Session::forget('quote_decking_flyover_roof_910_1820');
        \Laravel\Session::forget('quote_decking_flyover_roof_910_2730');

        // Electrics
        \Laravel\Session::forget('quote_electrics_double_sockets_450');
        \Laravel\Session::forget('quote_electrics_double_sockets_1150');
        \Laravel\Session::forget('quote_electrics_light_switch');
        \Laravel\Session::forget('quote_electrics_panel_heater');
        \Laravel\Session::forget('quote_electrics_double_floor_socket');
        \Laravel\Session::forget('quote_electrics_fused_spur_socket');

        // Internals
        \Laravel\Session::forget('quote_internals_silver_aluminium_venitian_blind_no_screws');
        \Laravel\Session::forget('quote_internals_recessed_blinds');
        \Laravel\Session::forget('quote_internals_internal_910_partition_wall');
        \Laravel\Session::forget('quote_internals_internal_door_dividing_studio');
        \Laravel\Session::forget('quote_internals_internal_wall_corner_post');

        // Other
        \Laravel\Session::forget('quote_other_decoupled_floor');
        \Laravel\Session::forget('quote_other_aquastep_oak_floor');
        \Laravel\Session::forget('quote_other_walls_to_timber');
        \Laravel\Session::forget('quote_other_taller_walls');
        \Laravel\Session::forget('quote_other_entry_steps');
        \Laravel\Session::forget('quote_other_entry_handrail');
        \Laravel\Session::forget('quote_other_skirt');
    }



    /*
     * Save quote to customers account
     */
    private function saveQuote(Customer $customer){
        // Create new or update existing
        if(\Laravel\Session::get('quote_id')){
            $quote = Quotation::find(\Laravel\Session::get('quote_id'));
        }else{
            $quote = new Quotation();
            $quote->quick_access_code = md5(md5($customer->id) . time() . md5($quote->id));
        }

        $quote->customer_id = $customer->id;
        $quote->quotation_layouts_id = \Laravel\Session::get('quote_layout_id');
        $quote->postcode = \Laravel\Session::get('quote_postcode');
        $quote->price = Quotation::calcSessionQuotationCurrentValue();

        $quote->quote_customise_swap_window = \Laravel\Session::get('quote_customise_swap_window');
        $quote->quote_customise_swap_wall = \Laravel\Session::get('quote_customise_swap_wall');
        $quote->quote_customise_extra_door = \Laravel\Session::get('quote_customise_extra_door');
        $quote->quote_customise_fanlight = \Laravel\Session::get('quote_customise_fanlight');
        $quote->quote_customise_half_window = \Laravel\Session::get('quote_customise_half_window');
        $quote->quote_customise_picture_window = \Laravel\Session::get('quote_customise_picture_window');

        $quote->quote_decking_composite_deck_910_910 = \Laravel\Session::get('quote_decking_composite_deck_910_910');
        $quote->quote_decking_composite_deck_910_1820 = \Laravel\Session::get('quote_decking_composite_deck_910_1820');
        $quote->quote_decking_composite_deck_910_2730 = \Laravel\Session::get('quote_decking_composite_deck_910_2730');
        $quote->quote_decking_flyover_roof_910_910 = \Laravel\Session::get('quote_decking_flyover_roof_910_910');
        $quote->quote_decking_flyover_roof_910_1820 = \Laravel\Session::get('quote_decking_flyover_roof_910_1820');
        $quote->quote_decking_flyover_roof_910_2730 = \Laravel\Session::get('quote_decking_flyover_roof_910_2730');

        $quote->quote_electrics_double_sockets_450 = \Laravel\Session::get('quote_electrics_double_sockets_450');
        $quote->quote_electrics_double_sockets_1150 = \Laravel\Session::get('quote_electrics_double_sockets_1150');
        $quote->quote_electrics_light_switch = \Laravel\Session::get('quote_electrics_light_switch');
        $quote->quote_electrics_panel_heater = \Laravel\Session::get('quote_electrics_panel_heater');
        $quote->quote_electrics_double_floor_socket = \Laravel\Session::get('quote_electrics_double_floor_socket');
        $quote->quote_electrics_fused_spur_socket = \Laravel\Session::get('quote_electrics_fused_spur_socket');

        $quote->quote_internals_silver_aluminium_venitian_blind_no_screws = \Laravel\Session::get('quote_internals_silver_aluminium_venitian_blind_no_screws');
        $quote->quote_internals_recessed_blinds = \Laravel\Session::get('quote_internals_recessed_blinds');
        $quote->quote_internals_internal_910_partition_wall = \Laravel\Session::get('quote_internals_internal_910_partition_wall');
        $quote->quote_internals_internal_door_dividing_studio = \Laravel\Session::get('quote_internals_internal_door_dividing_studio');
        $quote->quote_internals_internal_wall_corner_post = \Laravel\Session::get('quote_internals_internal_wall_corner_post');

        $quote->quote_other_decoupled_floor = \Laravel\Session::get('quote_other_decoupled_floor');
        $quote->quote_other_aquastep_oak_floor = \Laravel\Session::get('quote_other_aquastep_oak_floor');
        $quote->quote_other_walls_to_timber = \Laravel\Session::get('quote_other_walls_to_timber');
        $quote->quote_other_taller_walls = \Laravel\Session::get('quote_other_taller_walls');
        $quote->quote_other_entry_steps = \Laravel\Session::get('quote_other_entry_steps');
        $quote->quote_other_entry_handrail = \Laravel\Session::get('quote_other_entry_handrail');
        $quote->quote_other_skirt = \Laravel\Session::get('quote_other_skirt');

        $quote->save();

        return $quote;
    }



    /*
     * Load quotation into session
     */
    private function loadQuote(Quotation $quote){
        // Find layout
        $layout = Layout::find($quote->quotation_layouts_id);
        $customer = Customer::find($quote->customer_id);

        // Init
        \Laravel\Session::put('quote_id', $quote->id);
        \Laravel\Session::put('quote_email', $customer->email);
        \Laravel\Session::put('quote_layout', $layout);
        \Laravel\Session::put('quote_layout_id', $layout->id);
        \Laravel\Session::put('quote_size', $layout->size_x . 'x' . $layout->size_y);
        \Laravel\Session::put('quote_postcode', $quote->postcode);

        //Customise
        \Laravel\Session::put('quote_customise_swap_window', $quote->quote_customise_swap_window);
        \Laravel\Session::put('quote_customise_swap_wall', $quote->quote_customise_swap_wall);
        \Laravel\Session::put('quote_customise_extra_door', $quote->quote_customise_extra_door);
        \Laravel\Session::put('quote_customise_fanlight', $quote->quote_customise_fanlight);
        \Laravel\Session::put('quote_customise_half_window', $quote->quote_customise_half_window);
        \Laravel\Session::put('quote_customise_picture_window', $quote->quote_customise_picture_window);

        //Decking & floyover
        \Laravel\Session::put('quote_decking_composite_deck_910_910', $quote->quote_decking_composite_deck_910_910);
        \Laravel\Session::put('quote_decking_composite_deck_910_1820', $quote->quote_decking_composite_deck_910_1820);
        \Laravel\Session::put('quote_decking_composite_deck_910_2730', $quote->quote_decking_composite_deck_910_2730);
        \Laravel\Session::put('quote_decking_flyover_roof_910_910', $quote->quote_decking_flyover_roof_910_910);
        \Laravel\Session::put('quote_decking_flyover_roof_910_1820', $quote->quote_decking_flyover_roof_910_1820);
        \Laravel\Session::put('quote_decking_flyover_roof_910_2730', $quote->quote_decking_flyover_roof_910_2730);

        // Electrics
        \Laravel\Session::put('quote_electrics_double_sockets_450', $quote->quote_electrics_double_sockets_450);
        \Laravel\Session::put('quote_electrics_double_sockets_1150', $quote->quote_electrics_double_sockets_1150);
        \Laravel\Session::put('quote_electrics_light_switch', $quote->quote_electrics_light_switch);
        \Laravel\Session::put('quote_electrics_panel_heater', $quote->quote_electrics_panel_heater);
        \Laravel\Session::put('quote_electrics_double_floor_socket', $quote->quote_electrics_double_floor_socket);
        \Laravel\Session::put('quote_electrics_fused_spur_socket', $quote->quote_electrics_fused_spur_socket);

        // Internals
        \Laravel\Session::put('quote_internals_silver_aluminium_venitian_blind_no_screws', $quote->quote_internals_silver_aluminium_venitian_blind_no_screws);
        \Laravel\Session::put('quote_internals_recessed_blinds', $quote->quote_internals_recessed_blinds);
        \Laravel\Session::put('quote_internals_internal_910_partition_wall', $quote->quote_internals_internal_910_partition_wall);
        \Laravel\Session::put('quote_internals_internal_door_dividing_studio', $quote->quote_internals_internal_door_dividing_studio);
        \Laravel\Session::put('quote_internals_internal_wall_corner_post', $quote->quote_internals_internal_wall_corner_post);

        // Other
        \Laravel\Session::put('quote_other_decoupled_floor', $quote->quote_other_decoupled_floor);
        \Laravel\Session::put('quote_other_aquastep_oak_floor', $quote->quote_other_aquastep_oak_floor);
        \Laravel\Session::put('quote_other_walls_to_timber', $quote->quote_other_walls_to_timber);
        \Laravel\Session::put('quote_other_taller_walls', $quote->quote_other_taller_walls);
        \Laravel\Session::put('quote_other_entry_steps', $quote->quote_other_entry_steps);
        \Laravel\Session::put('quote_other_entry_handrail', $quote->quote_other_entry_handrail);
        \Laravel\Session::put('quote_other_skirt', $quote->quote_other_skirt);
    }



    /*
     * Send email on new quote
     */
    private function NewQuoteEmail(Customer $customer, Quotation $quote){
        $data = array();
        $data['customer'] = $customer;
        $data['quote'] = $quote;

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'truecloudmedia.co.uk';
        $mail->SMTPAuth = true;
        $mail->Username = 'dev@truecloudmedia.co.uk';
        $mail->Password = 'OAK964WUuZlRfgn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('no-reply@boothsgardenstudios.co.uk', 'Booth Garden Studios');
        $mail->addAddress($customer->email);
        $mail->isHTML(true);

        $mail->Subject = 'Booth Garden Studios Quotation #' . $quote->id;
        $mail->Body = '
            <p><img src="' . \Laravel\URL::to('/') . 'img/logo-booths-large.png" alt="Garden Booth Studios" /></p>
            <p>Thank you for completing a quotation with Garden Booths Studio.</p>
            <p>Your perfect studio came to &pound;' . number_format($quote->price, 2) . '</p>
            <p>You can log into your account by <a href="' . action('quotations.sign_in') . '">clicking here</a> and using your email address and post code.</p>
            <p>
                <b>Email: </b> ' . $customer->email . '<br />
                <b>Post Code: </b> ' . $quote->postcode . '
            </p>
            <p>Or you can access your quote directly by clicking the below link.</p>
            <p><a href="' . action('quotations.my_quotes_load') . '/' . $quote->id . '?c=' . $quote->quick_access_code . '">' . action('quotations.my_quotes_load') . '/' . $quote->id . '?c=' . $quote->quick_access_code . '</a></p>
            <p>Garden Booth Studios</p>
        ';

        $mail->send();
    }

}