@layout('templates.main')

@section('content')

{{ HTML::script('js/word-and-character-counter.js') }}

<div class="row">
  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
    <nav class="navbar navbar-default navbar-admin" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav nav-pills nav-stacked user-nav">
            <?php if (Auth::user()->administrator > 0) : ?>
            <li><a class="<?php if (URI::Segment(2) == 'home') { ?>active<?php } ?>" href="/user/home">Dashboard</a></li>
            <li><a class="dropdown-toggle <?php if (URI::Segment(2) == 'pricing') { ?>active<?php } ?>" href="#" data-toggle="dropdown">Pricing <b class="caret"></b></a>
               <ul class="dropdown-menu">
                <!-- to do - make dynamic -->
                <li><a class="<?php if (URI::Segment(4) == '1') { ?>active<?php } ?>" href="/user/pricing/update/1">QC7</a></li>
                <li><a class="<?php if (URI::Segment(4) == '2') { ?>active<?php } ?>" href="/user/pricing/update/2">QC6</a></li>
                <li><a class="<?php if (URI::Segment(4) == '3') { ?>active<?php } ?>" href="/user/pricing/update/3">QCB</a></li>
               </ul>
            </li>
            <li><a class="<?php if (URI::Segment(2) == 'pages') { ?>active<?php } ?>" href="/user/pages/">Pages</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'posts') { ?>active<?php } ?>" href="/user/posts/">Case Studies</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'categories') { ?>active<?php } ?>" href="/user/categories/">Categories</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'galleries') { ?>active<?php } ?>" href="/user/galleries/">Galleries</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'faqcategories') { ?>active<?php } ?>" href="/user/faqcategories/">FAQ Categories</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'faqs') { ?>active<?php } ?>" href="/user/faqs/">FAQ's</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'testimonials') { ?>active<?php } ?>" href="/user/testimonials/">Testimonials</a></li>
            <!--<a class="<?php if (URI::Segment(2) == 'clients') { ?>active<?php } ?>" href="/user/clients/">Users</a>-->
            <?php else: ?>
            <li><a class="<?php if (URI::Segment(2) == 'profile') { ?>active<?php } ?>" href="/user/profile/">Profile</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'quotes') { ?>active<?php } ?>" href="/user/quotes/">Quotes</a></li>
            <li><a class="<?php if (URI::Segment(2) == 'contact') { ?>active<?php } ?>" href="/user/contact/">Contact</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </div>
  <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
    @if (Session::get('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('error') }}
    </div>

    @endif
    @if (Session::get('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('info') }}
    </div>

    @endif
    @if (Session::get('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
    
    @yield('user_content')
  </div>
</div>

@endsection