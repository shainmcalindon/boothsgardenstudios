@layout('templates.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')

<h1>{{ $data->title }}</h1>

<!-- Show errors messages -->
@if($data->error)
    <div id="error_message" class="alert alert-danger" role="alert">{{ $data->error }}</div>
@endif

<div class="well" style="margin-top: 20px;">             
  <h3 style="margin-top: 0;">QCB Pricing</h3>
    {{ HTML::image('img/mega-menu-qcb.jpg', '', array('class' => 'img-responsive pull-left', 'style' => 'height: 80px; margin: 0 20px 0 0;', 'title' => 'QCB', 'alt' => 'QCB')) }}
    <p class="lead">Professional quality cube garden office without the frills. Truly zero maintenance exterior with 25 yr guarantee. Free delivery up to 100 miles (&pound;6 per mile after that from PE8 5AS)</p>
    <div class="form-group table-responsive">
      <label for="Size" class="sr-only">Size</label>
      <table class="postcode-submit table table-bordered table-condensed table-pricing">
        <tr>
          <td colspan="2" rowspan="2"></td>
          <td colspan="10" align="center"><small>Width of studio - all windows with 1 door</small></td>
        </tr>                                              
        <tr>
          <td class="title-width">2440mm<br><em>8ft</em></td>
          <td class="title-width">3640mm<br><em>12ft</em></td>
          <td class="title-width">4880mm<br><em>16ft</em></td>
          <td class="title-width">6100mm<br><em>20ft</em></td>
        </tr>
                                                                               
        <tr>
          <td style="width: 104px;"><small>Depth of studio</small></td>    
          <td class="title-depth">2440mm<br><em>8ft</em></td>
          <td><input type="radio" name="size" id="2440x2440" value="2440x2440"><label for="2440x2440">{{ $data->layouts['2440x2440']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="3640x2440" value="3640x2440"><label for="3640x2440">{{ $data->layouts['3640x2440']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="4880x2440" value="4880x2440"><label for="4880x2440">{{ $data->layouts['4880x2440']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="6100x2440" value="6100x2440"><label for="6100x2440">{{ $data->layouts['6100x2440']->formatted_cost }}</label></td>
        </tr>                            
      </table>
    </div>
</div>
<div class="well" style="margin-top: 20px;">        
  <h3 style="margin-top: 0;">QC6 Pricing</h3>
    {{ HTML::image('img/mega-menu-qc6.jpg', '', array('class' => 'img-responsive pull-left', 'style' => 'height: 80px; margin: 0 20px 10px 0;', 'title' => 'QC6', 'alt' => 'QC67')) }}
    <p class="lead">The UKs biggest selling garden room with all the bells and whistle options. Truly zero maintenance exterior with 25 yr guarantee and free delivery up to 100 miles from  PE8 5AS. Ask for quote for over 100 miles please.</p>
    <div class="form-group table-responsive">
      <label for="Size" class="sr-only">Size</label>
      <table class="postcode-submit table table-bordered table-condensed table-pricing">
        <tr>
          <td colspan="2" rowspan="2"></td>
          <td colspan="10" align="center"><small>Width of studio - all windows with 1 door</small></td>
        </tr>                                              
        <tr>
          <td class="title-width">1820mm<br><em>6ft</em></td>
          <td class="title-width">2730mm<br><em>9ft</em></td>
          <td class="title-width">3640mm<br><em>12ft</em></td>
          <td class="title-width">4550mm<br><em>15ft</em></td>
          <td class="title-width">5460mm<br><em>18ft</em></td>
          <td class="title-width">6370mm<br><em>21ft</em></td>
          <td class="title-width">7280mm<br><em>24ft</em></td>
          <td class="title-width">8190mm<br><em>27ft</em></td>
          <td class="title-width">9100mm<br><em>30ft</em></td>
          <td class="title-width">10010mm<br><em>33ft</em></td>
        </tr>
                                                                               
        <tr>
          <td rowspan="5"><small>Depth of studio</small></td>
          <td class="title-depth">1820mm<br><em>6ft</em></td>
          <td><input type="radio" name="size" id="1820x1820" value="1820x1820"><label for="1820x1820">{{ $data->layouts['1820x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="2730x1820" value="2730x1820"><label for="2730x1820">{{ $data->layouts['2730x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="3640x1820" value="3640x1820"><label for="3640x1820">{{ $data->layouts['3640x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="4550x1820" value="4550x1820"><label for="4550x1820">{{ $data->layouts['4550x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="5460x1820" value="5460x1820"><label for="5460x1820">{{ $data->layouts['5460x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="6370x1820" value="6370x1820"><label for="6370x1820">{{ $data->layouts['6370x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="7280x1820" value="7280x1820"><label for="7280x1820">{{ $data->layouts['7280x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="8190x1820" value="8190x1820"><label for="8190x1820">{{ $data->layouts['8190x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="9100x1820" value="9100x1820"><label for="9100x1820">{{ $data->layouts['9100x1820']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="10010x1820" value="10010x1820"><label for="10010x1820">{{ $data->layouts['10010x1820']->formatted_cost }}</label></td>
        </tr> 
                                                    
        <tr>
          <td class="title-depth">2730mm<br><em>9ft</em></td>
          <td><input type="radio" name="size" id="1820x2730" value="1820x2730"><label for="1820x2730">{{ $data->layouts['1820x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="2730x2730" value="2730x2730"><label for="2730x2730">{{ $data->layouts['2730x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="3640x2730" value="3640x2730"><label for="3640x2730">{{ $data->layouts['3640x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="4550x2730" value="4550x2730"><label for="4550x2730">{{ $data->layouts['4550x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="5460x2730" value="5460x2730"><label for="5460x2730">{{ $data->layouts['5460x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="6370x2730" value="6370x2730"><label for="6370x2730">{{ $data->layouts['6370x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="7280x2730" value="7280x2730"><label for="7280x2730">{{ $data->layouts['7280x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="8190x2730" value="8190x2730"><label for="8190x2730">{{ $data->layouts['8190x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="9100x2730" value="9100x2730"><label for="9100x2730">{{ $data->layouts['9100x2730']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="10010x2730" value="10010x2730"><label for="10010x2730">{{ $data->layouts['10010x2730']->formatted_cost }}</label></td>
        </tr>
                                                     
        <tr>
          <td class="title-depth">3640mm<br><em>12ft</em></td>
          <td><input type="radio" name="size" id="1820x3640" value="1820x3640"><label for="1820x3640">{{ $data->layouts['1820x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="2730x3640" value="2730x3640"><label for="2730x3640">{{ $data->layouts['2730x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="3640x3640" value="3640x3640"><label for="3640x3640">{{ $data->layouts['3640x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="4550x3640" value="4550x3640"><label for="4550x3640">{{ $data->layouts['4550x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="5460x3640" value="5460x3640"><label for="5460x3640">{{ $data->layouts['5460x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="6370x3640" value="6370x3640"><label for="6370x3640">{{ $data->layouts['6370x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="7280x3640" value="7280x3640"><label for="7280x3640">{{ $data->layouts['7280x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="8190x3640" value="8190x3640"><label for="8190x3640">{{ $data->layouts['8190x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="9100x3640" value="9100x3640"><label for="9100x3640">{{ $data->layouts['9100x3640']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="10010x3640" value="10010x3640"><label for="10010x3640">{{ $data->layouts['10010x3640']->formatted_cost }}</label></td>
        </tr>                          
      </table>
  </div>
</div>
<div class="well" style="margin-top: 20px;">     
  <h3 style="margin-top: 0;">QC7 Pricing</h3>        
    {{ HTML::image('img/mega-menu-qc7.jpg', '', array('class' => 'img-responsive pull-left', 'style' => 'height: 80px; margin: 0 20px 10px 0;', 'title' => 'QC7', 'alt' => 'QC7')) }}
    <p class="lead">Luxury spec same as QC6 but for larger depth studios up to 15ft (4.5m) and over 30sqm. Truly zero maintenance exterior with 25 yr guarantee. Free delivery up to 100 miles from  PE8 5AS. Ask for quote if over 100 miles please.</p>
    <div class="form-group table-responsive">
      <label for="Size" class="sr-only">Size</label>
      <table class="postcode-submit table table-bordered table-condensed table-pricing">
        <tr>
          <td colspan="2" rowspan="2"></td>
          <td colspan="10" align="center"><small>Width of studio - all windows with 1 door</small></td>
        </tr>                                              
        <tr>
          <td class="title-width">1820mm<br><em>6ft</em></td>
          <td class="title-width">2730mm<br><em>9ft</em></td>
          <td class="title-width">3640mm<br><em>12ft</em></td>
          <td class="title-width">4550mm<br><em>15ft</em></td>
          <td class="title-width">5460mm<br><em>18ft</em></td>
          <td class="title-width">6370mm<br><em>21ft</em></td>
          <td class="title-width">7280mm<br><em>24ft</em></td>
          <td class="title-width">8190mm<br><em>27ft</em></td>
          <td class="title-width">9100mm<br><em>30ft</em></td>
          <td class="title-width">10010mm<br><em>33ft</em></td>
        </tr>
                                                                               
        <tr>
          <td><small>Depth of studio</small></td>
                            
          <td class="title-depth">4550mm<br><em>15ft</em></td>
          <td><input type="radio" name="size" id="1820x4550" value="1820x4550" <?php if(@$_POST['size'] == '182x455' ) : ?>checked<?php endif; ?>><label for="1820x4550">{{ $data->layouts['1820x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="2730x4550" value="2730x4550" <?php if(@$_POST['size'] == '2730x4550' ) : ?>checked<?php endif; ?>><label for="2730x4550">{{ $data->layouts['2730x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="3640x4550" value="3640x4550" <?php if(@$_POST['size'] == '3640x4550' ) : ?>checked<?php endif; ?>><label for="3640x4550">{{ $data->layouts['3640x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="4550x4550" value="4550x4550" <?php if(@$_POST['size'] == '4550x4550' ) : ?>checked<?php endif; ?>><label for="4550x4550">{{ $data->layouts['4550x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="5460x4550" value="5460x4550" <?php if(@$_POST['size'] == '5460x4550' ) : ?>checked<?php endif; ?>><label for="5460x4550">{{ $data->layouts['5460x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="6370x4550" value="6370x4550" <?php if(@$_POST['size'] == '6370x4550' ) : ?>checked<?php endif; ?>><label for="6370x4550">{{ $data->layouts['6370x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="7280x4550" value="7280x4550" <?php if(@$_POST['size'] == '7280x4550' ) : ?>checked<?php endif; ?>><label for="7280x4550">{{ $data->layouts['7280x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="8190x4550" value="8190x4550" <?php if(@$_POST['size'] == '8190x4550' ) : ?>checked<?php endif; ?>><label for="8190x4550">{{ $data->layouts['8190x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="9100x4550" value="9100x4550" <?php if(@$_POST['size'] == '9100x4550' ) : ?>checked<?php endif; ?>><label for="9100x4550">{{ $data->layouts['9100x4550']->formatted_cost }}</label></td>
          <td><input type="radio" name="size" id="10010x4550" value="10010x4550" <?php if(@$_POST['size'] == '10010x4550' ) : ?>checked<?php endif; ?>><label for="10010x4550">{{ $data->layouts['10010x4550']->formatted_cost }}</label></td>
        </tr>                                           
      </table>
    </div>
</div>

<div class="well">
    <div class="col-md-12">
        <div id="postcode_form_info" class="alert alert-info" role="alert" hidden></div>
        <div id="postcode_form_error" class="alert alert-danger" role="alert" hidden></div>
        <p>To calculate total studio cost please enter your postcode</p>
    </div>
    <div class="clearfix"></div>

    <form action="{{ action('quotations@customise') }}" class="form-inline" id="postcode_form" method="post">
        <input type="hidden" name="size" value="" />
        <div class="form-group">
            <input type="text" name="postcode" id="postcode" class="form-control" value="{{ $data->postcode  }}">
        </div>
        <button class="btn btn-success square" id="calculateBtn">Calculate</button>

        <div id="customise-block" hidden>
            <p>The cost of your new studio will be approximately <span id="customise_form_estimated_total"></span> including delivery</p>
            <p><small>To customise your studio and make additions, please click the button below.</small></p>
            <button class="btn btn-dark" id="customiseBtn">Customise my studio ></button>
        </div>
    </form>
</div>
      
@endsection

@section('script')
    <script type="text/javascript">
        // Used for postcode validation
        var regPostcode = /^([a-zA-Z]){1}([0-9][0-9]|[0-9]|[a-zA-Z][0-9][a-zA-Z]|[a-zA-Z][0-9][0-9]|[a-zA-Z][0-9]){1}([ ])([0-9][a-zA-z][a-zA-z]){1}$/;

        jQuery(function($){
            // Easy access
            var $calculate = $('#calculateBtn'),
                    $customise_block = $('#customise-block'),
                    $customise_btn = $('#customiseBtn'),
                    $postcode_form = $('#postcode_form');

            // Perform form validation to ensure all required data is set
            var validatePostcodeForm = function(){
                // Make sure we have a size selected
                if(!$('input[name="size"]', $postcode_form).val()){
                    $('#postcode_form_error').text('You must select a starting size from above!').slideDown();
                    return false;
                }

                // Make sure post code is valid
                if(regPostcode.test($('#postcode').val()) == false){
                    $('#postcode_form_error').text('Postcode is not valid!').slideDown();
                    return false;
                }

                return true;
            };

            // Handle calculator submit
            $calculate.click(function(e) {
                e.preventDefault(); // Stop form from submitting

                // Make sure customise button is hidden each time the user clicks the calc button
                // This is to stop them entering a bad post code after they have already clicked the calc button
                $customise_block.slideUp();

                // Reset info messages for new data
                $('#postcode_form_info').text('').hide();
                $('#postcode_form_error').text('').hide();

                // Validate form
                if(!validatePostcodeForm()) return false;

                // If we have got this far means there was no errors above
                // Show customisation button
                $customise_block.slideDown();
            });

            // Handle selecting studio size
            $('.postcode-submit input[name="size"]').on('click', function(){
                // Update estimated total
                $('#customise_form_estimated_total').html($(this).next().html());

                // Update hidden field so when form submitted we know the size selected
                $('#postcode_form input[name="size"]').val($(this).val());

                // Friendly message indicating what to do next
                $('#postcode_form_info').text('Enter your postcode so we can continue onto customise your studio!').show();

                // Only scroll and focus if the error message is not showing
                // This allows us to pre select the size and postcode fields but keep the user at the top of the page if error messages are shown
                if(!$('#error_message').is(':visible')){
                    // Auto focus the postcode input field
                    $('#postcode').focus();

                    // Take user to postcode form
                    $("html, body").animate({ scrollTop: $('#postcode_form_info').offset().top }, 1000);
                }
            });

            // Handle submitting to customise studio form to progress onto next step
            $customise_btn.click(function(e){
                e.preventDefault();

                // Validate form
                if(!validatePostcodeForm()) return false;

                // Submit form to progress onto next step
                $postcode_form.submit();
            });

            // If we are default a size selection set it using JS to simply things
            @if($data->size)
                $('.postcode-submit input[name="size"][value="{{ $data->size }}"]').prop('checked', true);
            @endif

            // Initial page load trigger a click on the initial size selection
            // This is to ensure the submit form and interface are in sync
            initial_selected_size = $('.postcode-submit input[name="size"]:checked');
            if(initial_selected_size.length) initial_selected_size.click();

            // Hide error message after 4 seconds of being on page
            // This also allows the user to click a size and auto scroll once the message has disappeared
            if($('#error_message').is(':visible')){
                setTimeout(function(){
                    $('#error_message').slideUp();
                }, 4000);
            }
        });
    </script>
@endsection