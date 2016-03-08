@layout('templates.main')

@section('content')

    <h1>{{ $data->title }}</h1>

    <form method="post" action="{{ action('quotations@create') }}" role="form">

        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <p>Simply click on the size options in the grid below and enter your email address and postcode - then press the "calculate" button to get the cost of your garden studio. </p>
                <p>This includes delivery, installation and Vat. The expense of a concrete foundation is not required due to the unique adjustable concrete feet used on your QC garden studio.</p>
                <p class="lead">To calculate total studio cost please enter your email address and postcode</p>
            </div>
            <div class="col-sm-4 hidden-xs">
                {{ HTML::image('img/pricing-diagram.png', '', array('class' => 'img-responsive', 'title' => 'Booths Garden Studios: Pricing Guide', 'alt' => 'Booths Garden Studios: Pricing Guide')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-inline">
                    <div class="form-group {{ $errors->has('email_address') ? 'error' : '' }}">
                        <label for="inputEmailAddress" class="sr-only">Email Address</label>
                        <input type="text" name="email_address" class="form-control input-lg" id="inputEmailAddress" placeholder="Email Address" value="{{ e(Input::old('email_address')) }}">
                    </div>
                    <div class="form-group {{ $errors->has('postcode') ? 'error' : '' }}">
                        <label for="inputPostcode1" class="sr-only">Postcode</label>
                        <input type="text" name="postcode" class="form-control input-lg" id="inputPostcode1" placeholder="Postcode" value="{{ e(Input::old('postcode')) }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" name="Request Price">Calculate</button>
                    </div>
                </div>
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ e($error) }}</p>
                @endforeach
                @forelse ($data->errors as $error)
                    <p class="text-danger">{{ $error }}</p>
                @empty
                @endforelse

                @if ($data->full_cost)
                    <br><br>
                    <p class="lead">The cost of your new studio will be approximately &pound;{{ $data->full_cost }} including delivery</p>
                    <p>For more, detailed information please <a href="/contact">call us</a> or <a href="mailto:info@boothsgardenstudios.co.uk">email us</a>.</p>
                @endif
            </div>
        </div>

        <div class="well" style="margin-top: 20px;">
            <div class="form-group table-responsive">
                <label for="Size" class="sr-only">Size</label>
                <table class="table table-bordered table-condensed table-pricing">
                    <tr>
                        <td colspan="2" rowspan="2"></td>
                        <td colspan="10" align="center"><small>Width of studio - all windows with 1 door</small></td>
                    </tr>
                    <tr>
                        <td>1820mm<br><em>6ft</em></td>
                        <td>2730mm<br><em>9ft</em></td>
                        <td>3640mm<br><em>12ft</em></td>
                        <td>4550mm<br><em>15ft</em></td>
                        <td>5460mm<br><em>18ft</em></td>
                        <td>6370mm<br><em>21ft</em></td>
                        <td>7280mm<br><em>24ft</em></td>
                        <td>8190mm<br><em>27ft</em></td>
                        <td>9100mm<br><em>30ft</em></td>
                        <td>10010mm<br><em>33ft</em></td>
                    </tr>
                    <tr>
                        <td rowspan="6">{{ HTML::image('img/depth.gif') }}</td><td>1820mm<br><em>6ft</em></td>
                        <td><input type="radio" name="size" value="1820x1820" <?php if (Input::old('size') == '1820x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="2730x1820" <?php if (Input::old('size') == '2730x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="3640x1820" <?php if (Input::old('size') == '3640x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="4550x1820" <?php if (Input::old('size') == '4550x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="5460x1820" <?php if (Input::old('size') == '5460x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="6370x1820" <?php if (Input::old('size') == '6370x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="7280x1820" <?php if (Input::old('size') == '7280x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="8190x1820" <?php if (Input::old('size') == '8190x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="9100x1820" <?php if (Input::old('size') == '9100x1820' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="1001x1820" <?php if (Input::old('size') == '1001x1820' ) : ?>checked<?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td>2730mm<br><em>9ft</em></td>
                        <td>&nbsp;</td>
                        <td><input type="radio" name="size" value="2730x2730" <?php if (Input::old('size') == '2730x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="3640x2730" <?php if (Input::old('size') == '3640x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="4550x2730" <?php if (Input::old('size') == '4550x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="5460x2730" <?php if (Input::old('size') == '5460x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="6370x2730" <?php if (Input::old('size') == '6370x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="7280x2730" <?php if (Input::old('size') == '7280x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="8190x2730" <?php if (Input::old('size') == '8190x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="9100x2730" <?php if (Input::old('size') == '9100x2730' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="1001x2730" <?php if (Input::old('size') == '1001x2730' ) : ?>checked<?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td>3640mm<br><em>12ft</em></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="radio" name="size" value="3640x3640" <?php if (Input::old('size') == '3640x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="4550x3640" <?php if (Input::old('size') == '4550x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="5460x3640" <?php if (Input::old('size') == '5460x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="6370x3640" <?php if (Input::old('size') == '6370x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="7280x3640" <?php if (Input::old('size') == '7280x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="8190x3640" <?php if (Input::old('size') == '8190x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="9100x3640" <?php if (Input::old('size') == '9100x3640' ) : ?>checked<?php endif; ?>></td>
                        <td><input type="radio" name="size" value="1001x3640" <?php if (Input::old('size') == '1001x3640' ) : ?>checked<?php endif; ?>></td>
                    </tr>
                </table>
            </div>
            <p>You can see extra options for your garden studio in this example floor plan and order form...</p>
            <p><a href="https://docs.google.com/spreadsheets/d/1D8fSwCT0I8NYRe-NQxDx5D_7244m33vfU6MtMOWWbNo/pubhtml" class="btn btn-primary" target="_blank">Example floor plan</a></p>
        </div>

    </form>

@endsection