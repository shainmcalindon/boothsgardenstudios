<?php

class Image extends Eloquent {
  
  public function gallery()
  {
    return $this->belongs_to('Gallery');
  }
}