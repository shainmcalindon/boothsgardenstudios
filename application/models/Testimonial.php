<?php 

class Testimonial extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation', 'organisation_testimonial');
  }
}