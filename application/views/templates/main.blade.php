<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if ($title) : ?><?php echo $title ?><?php else : ?>Garden Offices UK | Garden Cabins | Garden Outhouses | Booths Garden Studios<?php endif; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if ($description) : ?><?php echo $description ?><?php else : ?>Alex Booths is the expert Garden Offices designer at Booths Garden Studios who are the number 1 in the UK for supplying Zero Maintenance Garden Offices.<?php endif; ?>">
    <meta name="keywords" content="<?php if ($keywords) : ?><?php echo $keywords ?><?php else : ?><?php endif; ?>">
    <meta name="author" content="Shandy Digital">

    <!-- Le styles -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css') }}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
	
	@yield('css')
  
  
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}
    {{ HTML::script('js/jquery.migrate.min.js') }}
    {{ HTML::script('js/jquery.mobile.customized.min.js') }}
    {{ HTML::script('js/jquery.easing.1.3.js') }}
    {{ HTML::script('//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js') }}
	
	@yield('js')
	
    <!-- Fav and touch icons -->
    <!--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">-->
    <link rel="shortcut icon" href="/img/favicon.ico">
@if (Request::env() != 'local')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1263594-1', 'boothsgardenstudios.co.uk');
      ga('send', 'pageview');

    </script>
@endif
  </head>

  <body>
    <header>

      <nav class="navbar-top" role="navigation">
        <div class="container">
          <ul class="nav nav-pills pull-right" role="navigation">
            <?php if (URI::Segment(1) == 'user') : ?><li class=""><a href="/">Home</a></li><?php endif; ?>
            <?php if (URI::Segment(1) != 'user') : ?><li class="<?php if (URI::Segment(1) == 'about-us') { ?>active<?php } ?>"><a href="/about-us">About Us</a></li><?php endif; ?>
            <?php if (Auth::check()) : ?>
              <li><a href="/user/home">Dashboard</a></li>
              <li><a href="/user/logout">Logout</a></li>
              <?php else : ?>
              <!--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">My Studio <b class="caret"></b></a>
                <ul class="dropdown-menu pull-right" style="padding: 15px; padding-bottom: 0px; width: 300px;">
                  <li><form method="post" action="/user/" accept-charset="UTF-8">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="login" value="1">
                        <button class="btn btn-default" type="submit" id="sign-in">Sign in</button>
                      </div>
                    </form></li>
                </ul>
              </li>-->
              <?php endif; ?>
              <li class="<?php if (URI::Segment(1) == 'support') { ?>active<?php } ?>"><a href="/support">Support</a></li>
          </ul>
                <form class="form-inline newsletter-signup hidden-xs" action="http://www.aweber.com/scripts/addlead.pl" method="post">
                  <input type="hidden" value="1782232921" name="meta_web_form_id">
                  <input type="hidden" value="" name="meta_split_id">
                  <input type="hidden" value="bgsnews1" name="unit">
                  <input id="redirect_56786591caf1327979daf11fd5721a59" type="hidden" value="http://www.aweber.com/thankyou-coi.htm?m=audio" name="redirect">
                  <input type="hidden" value="" name="meta_redirect_onlist">
                  <input type="hidden" value="" name="meta_adtracking">
                  <input type="hidden" value="1" name="meta_message">
                  <input type="hidden" value="from" name="meta_required">
                  <input type="hidden" value="0" name="meta_forward_vars">
                  <div class="form-group">
                    <label>1% DISCOUNT FOR<br>BGS SUBSCRIBERS</label>
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="name">Name</label>
                    <input type="text" class="form-control input-sm name" name="name" placeholder="Enter name...">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="from">Email</label>
                    <input type="text" class="form-control input-sm from" name="from" placeholder="Enter email...">
                  </div>
                    <button class="btn btn-default btn-sm">GO</button>
                </form>
        </div>
      </nav>
      <?php if (URI::Segment(1) != 'user') : ?><div class="header-container">
        <div class="container">
          <div class="header clearfix">
            <a href="/" title="Booths garden Studios">{{ HTML::image('img/logo-booths-large.png', '', array('class' => 'pull-left booths-logo', 'title' => 'Booths Garden Studios', 'alt' => 'Booths Garden Studios')) }}</a>
            <div class="top-illustration pull-right hidden-xs"></div>
            <div class="header-strapline">
              <p>Portable Superior Garden Studio</p>
              <p>11 Year Guarantee</p>
              <p>Truly Zero Maintenance</p>
              <p>No Deposit Required</p>
            </div>
          </div>
        </div>
      </div><?php endif; ?>
    </header>

    <div class="main-content">
      <div class="container">

        <?php if (URI::Segment(1) != 'user') : ?><nav class="navbar navbar-default" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                Menu
              </button>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav">
                <li class="<?php if (URI::Segment(1) == '') { ?>active<?php } ?>"><a href="/">Home</a></li>
                <li class="dropdown <?php if (URI::Segment(1) == 'galleries') { ?>active<?php } ?>"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Galleries <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    @foreach ($galleries as $gallery)
                    <li class="<?php if (URI::Segment(2) == $gallery->slug) { ?>active<?php } ?>"><a href="/galleries/{{ $gallery->slug }}">{{ $gallery->title }}</a></li>
                    @endforeach
                  </ul>
                </li>
                <!--<li class="<?php if (URI::Segment(1) == 'videos') { ?>active<?php } ?>"><a href="/videos">Videos</a></li>-->
                <!--<li class="<?php if (URI::Segment(1) == 'quotations') { ?>active<?php } ?>"><a href="/quotations">Pricing</a></li>-->
                <li class="<?php if (URI::Segment(1) == 'quotations') { ?>active<?php } ?>" style="position:static;"><a href="/quotations/">Pricing</a></li>
                <!--<li class="dropdown <?php if (URI::Segment(1) == 'quotations') { ?>active<?php } ?>" style="position:static;"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pricing <b class="caret"></b></a>
                  <ul class="dropdown-menu" style="left:0;right:0;">
                    <li>
                      <div class="row">
                        <div class="col-sm-4"><a class="mega-menu" href="/quotations/qc7">
                          {{ HTML::image('img/mega-menu-qc7.jpg', '', array('class' => 'img-responsive hidden-xs', 'title' => 'QC7', 'alt' => 'QC7')) }}
                          <h4>QC7 <small>from &pound;10,314</small></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </a></div>
                        <div class="col-sm-4"><a class="mega-menu" href="/quotations/qc6">
                          {{ HTML::image('img/mega-menu-qc6.jpg', '', array('class' => 'img-responsive hidden-xs', 'title' => 'QC6', 'alt' => 'QC6')) }}
                          <h4>QC6 <small>from &pound;6,349</small></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </a></div>
                        <div class="col-sm-4"><a class="mega-menu" href="/quotations/qcb">
                          {{ HTML::image('img/mega-menu-qcb.jpg', '', array('class' => 'img-responsive hidden-xs', 'title' => 'QCB', 'alt' => 'QCB')) }}
                          <h4>QCB <small>from &pound;6,995</small></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </a></div>
                      </div>
                    </li>
                  </ul>
                </li>-->
                <!--<li class="<?php if (URI::Segment(1) == 'why-us') { ?>active<?php } ?>"><a href="/why-us">Why Us?</a></li>-->
                <li class="<?php if (URI::Segment(1) == 'visit-studio') { ?>active<?php } ?>"><a href="/visit-studio">Visit Studio</a></li>
                <li class="<?php if (URI::Segment(1) == 'case-studies') { ?>active<?php } ?>"><a href="/case-studies">Case Studies</a></li>
                <li class="<?php if (URI::Segment(1) == 'faqs') { ?>active<?php } ?>"><a href="/faqs">FAQ's</a></li>
                <li class="<?php if (URI::Segment(1) == 'contact') { ?>active<?php } ?>"><a href="/contact">Contact Us</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div>
        </nav><?php endif; ?>
        <?php if (URI::Segment(1) == 'user') : ?><div class="main-margin"></div><?php endif; ?>
        <main role="main" id="main">
          @yield('content') 
        </main>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="strapline">
          <p class="strapline-top">The UK's no.1 supplier of</p>
          <p class="strapline-bottom">Zero maintenance &</p>
          <p class="strapline-bottom">Portable garden studios</p>
        </div>
        <div class="copyright">
          <p>&copy; 2013 Booths Garden Studios</p>
          <p><a href="http://www.shandydigital.co.uk" target="_blank" title="Web design & development">Website development</a> by Shandy Digital</p>
        </div>
      </div>
    </footer>
    {{ HTML::script('js/tinymce/tinymce.min.js') }}
    {{ HTML::script('js/tinymce/tinymce.default.js') }}
    {{ HTML::script('js/affix.js') }}
    {{ HTML::script('js/alert.js') }}
    {{ HTML::script('js/button.js') }}
    {{ HTML::script('js/carousel.js') }}
    {{ HTML::script('js/collapse.js') }}
    {{ HTML::script('js/dropdown.js') }}
    {{ HTML::script('js/modal.js') }}
    {{ HTML::script('js/tooltip.js') }}
    {{ HTML::script('js/popover.js') }}
    {{ HTML::script('js/scrollspy.js') }}
    {{ HTML::script('js/tab.js') }}
    {{ HTML::script('js/transition.js') }}

    @yield('script')
  </body>
</html>
