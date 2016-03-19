<?php

    class Layouts {

        /*
         * Get studio layouts
         */
        public static function get_layouts($id=null)
        {
            // We return an array if returning all layouts
            // Other wise return the object if we looking up a specific layout id
            $return = array();

            // Are we looking for a specific studio layout id?
            // If not we return all layouts
            if($id){
                // Return a specific studio layout by ID
                if(($data = Layout::find($id)) != NULL){
                    $data->formatted_cost = $data->cost == '' ? '' : '&pound;' . number_format($data->cost,2);
                    $return = $data;
                }
            }else{
                // Get all studio layout data and iterate the returned data
                $layouts = DB::table('quotation_layouts')->order_by('size_y', 'asc')->order_by('size_x', 'asc')->get();
                foreach($layouts as $layout)
                {
                    $layout->formatted_cost = $layout->cost == '' ? '' : '&pound;' . number_format($layout->cost, 2);
                    $code = str_replace('.', '', $layout->size_x) . 'x' . str_replace('.', '', $layout->size_y);
                    $return[$code] = $layout;
                }
            }

            return $return;
        }

        /*
         * Find layouts by layout code (E.G 1820x4550)
         */
        public static function get_layoutsByCode($code){
            // Split code into x / y
            $split = explode('x', $code);
            $x = $split[0];
            $y = $split[1];

            // Search DB for specific layout matching x and y
            $layout = DB::table('quotation_layouts')->where('size_x', '=', $x)->where('size_y', '=', $y)->get();

            if($layout != null && sizeof($layout)){
                // BY default DB data is in an array, we want the first array. There should never be an instance where there is multiple data returned as the code should be unique
                $layout = $layout[0];
                $layout->formatted_cost = $layout->cost == '' ? '' : '&pound;' . number_format($layout->cost,2);
                return $layout;
            }

            return false;
        }

        /*
         * Calc available slots based on studio size
         */
        public static function layoutAvailableWallSlots($id){
            if($layout = Layouts::get_layouts($id)){
                // Get studio, sizing can diff between certain studios
                $studio = $layout->studio()->get();
                $studio = $studio[0];

                // Calc side 1 and 2 available space, then multiply by 2 for its opposing wall
                $side1 = ($layout->size_x / $studio->externalwallsingleslotlength) * 2;
                $side2 = ($layout->size_y / $studio->externalwallsingleslotlength) * 2;

                // Add both side values together and we now have the total available slots based on the size of the unit
                $slots = round($side1 + $side2);

                return $slots;
            }

            return 0;
        }





        public static function get_distinct_x($id=null)
        {
          $data = DB::table('quotation_layouts')->distinct()->select('size_x')->where('studio_id',"=" ,$id)->order_by('size_x', 'asc')->get();
          
          return $data;
        }

    }