<?php

    class Postcodes
    {
        public $our_postcode = 'PE8 5AS';
        
        public function ShorthandPostcode($postcode)
        {
            $temp = explode(' ',$postcode);
            if(strlen($temp[0])>4)
            {
                if(is_numeric(substr($temp[0],4,1)))
                {
                    $temp[0] = substr($temp[0],0,4);
                }
                else
                {
                    $temp[0] = substr($temp[0],0,3);
                }
            }
            $this->outcode = $temp[0];    

            return true;
        }
        
        public static function ValidOutcode($postcode)
        {
            $temp = explode(' ', $postcode);
            if(strlen($temp[0])>4)
            {
                if(is_numeric(substr($temp[0],4,1)))
                {
                    $temp[0] = substr($temp[0],0,4);
                }
                else
                {
                    $temp[0] = substr($temp[0],0,3);
                }
            }
            $outcode = $temp[0];
            $get = DB::query("SELECT outcode FROM quotation_postcodes WHERE outcode='".strtoupper($outcode)."' LIMIT 1");
            if(count($get) > 0)
            {
                return true;
            }
            return false;
        }
        
        public function GetXY($postcode)
        {
            $temp = explode(' ',$postcode);
            if(strlen($temp[0])>4)
            {
                if(is_numeric(substr($temp[0],4,1)))
                {
                    $temp[0] = substr($temp[0],0,4);
                }
                else
                {
                    $temp[0] = substr($temp[0],0,3);
                }
            }
            $outcode = $temp[0];
            $get = DB::query("SELECT x,y FROM quotation_postcodes WHERE outcode='".$outcode."' LIMIT 1");
            $row = $get[0];
            if(count($row) > 0)
            {
                $this->x = $row->x;
                $this->y = $row->y; 
                return $row;
            }
            else
            {
                $_SESSION['error'] = "Postcode Incorrect.";
                return 0;   
            }
        }

        public function HowFar($postcode,$units = 'miles')
        {
                $their_xy = $this->GetXY($postcode);
                $our_xy   = $this->GetXY($this->our_postcode);
                
                $distance = sqrt(($their_xy->y-$our_xy->y)*($their_xy->y-$our_xy->y) + ($their_xy->x-$our_xy->x)*($their_xy->x-$our_xy->x));
                $distance = $distance/1000;

                if($units = 'miles')
                    $distance *= 0.6214;   

                return $distance;
        }

    }

?>