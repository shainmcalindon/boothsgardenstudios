<?php

class Category extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation', 'organisation_category');
  }
  
  public function posts()
  {
    return $this->has_many_and_belongs_to('Post');
  }
}