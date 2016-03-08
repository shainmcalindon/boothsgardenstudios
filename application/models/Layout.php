<?php

    class Layout extends Eloquent {
      
        public static $timestamps = false;

        public static $table = 'quotation_layouts';
        
        public function studio()
        {
          return $this->belongs_to('Studio');
        }
    }

?>