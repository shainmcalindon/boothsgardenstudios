<?php

class Faqcategory extends Eloquent {
  
  public function organisations()
  {
    return $this->has_many_and_belongs_to('Organisation', 'organisation_faqcategory');
  }
  
  public function faqs()
  {
    return $this->has_many_and_belongs_to('Faq', 'faqcategory_faq');
  }
}