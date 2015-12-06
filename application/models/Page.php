<?php

class Page extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation');
  }
  
  public function author()
  {
    return $this->belongs_to('User', 'author_id');
  }
}