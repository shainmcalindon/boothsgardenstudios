<?php

class Gallery extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation', 'organisation_gallery');
  }
    
  public function images()
  {
    return $this->has_many('Image')->order_by('sort_order', 'asc');
  }
}