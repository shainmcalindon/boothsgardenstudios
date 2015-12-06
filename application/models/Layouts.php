<?php

    class Layouts {

        public static function get_layouts($id=null)
        {
            $return = array();

            $g = DB::table('quotation_layouts')->order_by('size_y', 'asc')->order_by('size_x', 'asc')->get();

            foreach($g as $r)
            {
                $code = str_replace('.','',$r->size_x).'x'.str_replace('.','',$r->size_y);
                
                $data = Layout::find($r->id);
                $data->formatted_cost = $r->cost == '' ? '' : '&pound;'.number_format($r->cost,2);
                $data->size_x = $r->size_x;
                $data->size_y = $r->size_y;
                
                $return[$code] = $data;
            }
            
            return $return;
        }
        
        public static function get_distinct_x($id=null)
        {
          $data = DB::table('quotation_layouts')->distinct()->select('size_x')->where('studio_id',"=" ,$id)->order_by('size_x', 'asc')->get();
          
          return $data;
        }

    }

?>