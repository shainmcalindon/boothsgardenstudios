@layout('templates.main')

@section('content')

<h1>{{ $data->title }}</h1>

<div class="row">
  <div class="col-xs-12 col-sm-8">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <ul>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
    </ul>
  </div>
  <div class="col-sm-4 hidden-xs">
    {{ HTML::image('img/pricing-diagram.png', '', array('class' => 'img-responsive', 'title' => 'Booths Garden Studios: Pricing Guide', 'alt' => 'Booths Garden Studios: Pricing Guide')) }}
  </div>
</div>
<form method="post" role="form" action="#postcode-submit">
<div class="well" style="margin-top: 20px;">     
  <h3 style="margin-top: 0;">QC7 Pricing</h3>        
    <div class="form-group table-responsive">
      <label for="Size" class="sr-only">Size</label>
      <table id="postcode-submit" class="table table-bordered table-condensed table-pricing">    
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

      <?php /*
        <select class="form-control" id="Size">
        @foreach ($data->layouts as $layout)
        <option value="{{ $layout->id }}">{{ $layout->size_x }} x {{ $layout->size_y }} </option>
        @endforeach
      </select> */ ?>
    </div>
</div>
<p>Simply click on the size options in the grid above and enter your postcode - then press the "calculate" button to get the cost of your garden studio. </p>
<p>This includes delivery, installation and Vat. The expense of a concrete foundation is not required due to the unique adjustable concrete feet used on your QC garden studio.</p>
<p class="lead">To calculate total studio cost please enter your postcode</p>
<!--<div class="form-group">
<label for="inputName1" class="col-lg-2 control-label">Name</label>
<div class="col-lg-10">
<input type="text" name="name" class="form-control" id="inputName1" placeholder="Name" value="<?=@$_POST['name']?>">
</div>
</div>
<div class="form-group">
<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
<div class="col-lg-10">
<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email" value="<?=@$_POST['email']?>">
</div>
</div>
<div class="form-group">
<label for="inputTelephone1" class="col-lg-2 control-label">Telephone</label>
<div class="col-lg-10">
<input type="text" name="telephone" class="form-control" id="inputTelephone1" placeholder="Telephone" value="<?=@$_POST['telephone']?>">
</div>
</div>-->
<div class="form-inline">
  <div class="form-group">
    <label for="inputPostcode1" class="sr-only">Postcode</label>
    <input type="text" name="postcode" class="form-control input-lg" id="inputPostcode1" placeholder="Postcode" value="<?php echo @$_POST['postcode']?>">
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-lg" name="Request Price">Calculate</button>
  </div>
</div>
@forelse ($data->errors as $error)
<p class="text-danger">{{ $error }}</p>
@empty
@endforelse 
 
@if ($data->full_cost)
  <br><br>
  <p class="lead" id="full-cost">The cost of your new studio will be approximately &pound;{{ $data->full_cost }} including delivery</p>
  <p>For more, detailed information please <a href="/contact">call us</a> or <a href="mailto:info@boothsgardenstudios.co.uk">email us</a>.</p>
@endif
</form>
<br><br>
<p>You can see extra options for your garden studio in this example floor plan and order form...</p>
<p><a href="https://docs.google.com/spreadsheets/d/1D8fSwCT0I8NYRe-NQxDx5D_7244m33vfU6MtMOWWbNo/pubhtml" class="btn btn-primary" target="_blank">24' x 9' (7280mm x 2730mm) example floor plan</a></p>

<script>
  $("#full-cost").addClass("fade-in");
</script>

<!--<div class="well">
        <table class="table table-bordered table-condensed table-pricing">
            <tr><td colspan="2" rowspan="2"></td><td colspan="10" align="center"><small>Width of studio - all windows with 1 door</small></td></tr> 
            <tr><td>1.82</td><td>2.73</td><td>3.64</td><td>4.55</td><td>5.46</td><td>6.37</td><td>7.28</td></tr> 
            <tr><td rowspan="6">{{ HTML::image('img/depth.gif') }}</td><td>1.82</td><td>{{ $data->layouts['182x182']->formatted_cost }}</td><td>{{ $data->layouts['182x273']->formatted_cost }}</td><td>{{ $data->layouts['182x364']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>2.73</td><td>{{ $data->layouts['273x182']->formatted_cost }}</td><td>{{ $data->layouts['273x273']->formatted_cost }}</td><td>{{ $data->layouts['273x364']->formatted_cost }}</td><td>{{ $data->layouts['273x455']->formatted_cost }}</td><td>{{ $data->layouts['273x546']->formatted_cost }}</td><td>{{ $data->layouts['273x637']->formatted_cost }}</td><td>{{ $data->layouts['273x728']->formatted_cost }}</td></tr>                                             
            <tr><td>3.64</td><td>{{ $data->layouts['364x182']->formatted_cost }}</td><td>{{ $data->layouts['364x273']->formatted_cost }}</td><td>{{ $data->layouts['364x364']->formatted_cost }}</td><td>{{ $data->layouts['364x455']->formatted_cost }}</td><td>{{ $data->layouts['364x546']->formatted_cost }}</td><td>{{ $data->layouts['364x637']->formatted_cost }}</td><td>{{ $data->layouts['364x728']->formatted_cost }}</td></tr>                                             
            <tr><td>4.55</td><td>{{ $data->layouts['455x182']->formatted_cost }}</td><td>{{ $data->layouts['455x273']->formatted_cost }}</td><td>{{ $data->layouts['455x364']->formatted_cost }}</td><td>{{ $data->layouts['455x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>5.46</td><td>{{ $data->layouts['546x182']->formatted_cost }}</td><td>{{ $data->layouts['546x273']->formatted_cost }}</td><td>{{ $data->layouts['546x364']->formatted_cost }}</td><td>{{ $data->layouts['546x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>6.37</td><td>{{ $data->layouts['637x182']->formatted_cost }}</td><td>{{ $data->layouts['637x273']->formatted_cost }}</td><td>{{ $data->layouts['637x364']->formatted_cost }}</td><td>{{ $data->layouts['637x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>7.28</td><td>{{ $data->layouts['728x182']->formatted_cost }}</td><td>{{ $data->layouts['728x273']->formatted_cost }}</td><td>{{ $data->layouts['728x364']->formatted_cost }}</td><td>{{ $data->layouts['728x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>8.19</td><td>&nbsp;</td><td>{{ $data->layouts['819x273']->formatted_cost }}</td><td>{{ $data->layouts['819x364']->formatted_cost }}</td><td>{{ $data->layouts['819x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                             
            <tr><td>9.10</td><td>&nbsp;</td><td>{{ $data->layouts['910x273']->formatted_cost }}</td><td>{{ $data->layouts['910x364']->formatted_cost }}</td><td>{{ $data->layouts['910x455']->formatted_cost }}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>                                        
        </table>
  <p>You can see extra options for your garden studio in this example floor plan and order form...</p>
  <p><a href="https://docs.google.com/spreadsheets/d/1D8fSwCT0I8NYRe-NQxDx5D_7244m33vfU6MtMOWWbNo/pubhtml" class="btn btn-primary" target="_blank">24' x 9' (7280mm x 2730mm) example floor plan</a></p>
</div>-->
      
@endsection