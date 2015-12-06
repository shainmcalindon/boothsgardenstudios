<?php

class Organisation extends Eloquent {
  
  public function posts()
  {
    return $this->has_many_and_belongs_to('Post');
  }
  
  public function pages()
  {
    return $this->has_many_and_belongs_to('Page');
  }
  
  public function categories()
  {
    return $this->has_many_and_belongs_to('Category', 'organisation_category');
  }
  
  public function galleries()
  {
    return $this->has_many_and_belongs_to('Gallery', 'organisation_gallery');
  }
  
  public function faqcategories()
  {
    return $this->has_many_and_belongs_to('Faqcategory', 'organisation_faqcategory');
  }
  
  public function faqs()
  {
    return $this->has_many_and_belongs_to('Faq', 'organisation_faq');
  }
  
  public function testimonials()
  {
    return $this->has_many_and_belongs_to('Testimonial', 'organisation_testimonial');
  }
}