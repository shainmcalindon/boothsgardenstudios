<?php

class Faq extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation', 'organisation_faq');
  }
  
  public function faqcategories()
  {
    return $this->has_many_and_belongs_to('Faqcategory', 'faqcategory_faq');
  }
}