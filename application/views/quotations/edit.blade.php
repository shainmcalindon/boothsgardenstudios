@layout('templates.main')

@section('css')
<link href="/css/jquery.toast.css" rel="stylesheet" />
<style type="text/css">
.bgp-table { cursor:pointer; margin:0 auto; }
.bgp-table td { }
.bgp-table .bgp-floor { text-align:center; width:60px; height:60px; }
.bgp-table .bgp-innerwall-vertical,
.bgp-table .bgp-innerwall-vertical { width:10px; }
.bgp-table .bgp-innerwall-horizontal { height:10px; }
.bgp-table .bgp-wall-join { height:10px; width:10px; }
.bgp-table .bgp-outerwall-top td,
.bgp-table .bgp-outerwall-bottom td { height:10px; }
.bgp-table tr .bgp-outerwall:first-child,
.bgp-table tr .bgp-outerwall:last-child { width:10px; }
.bgp-table .hovering { opacity:0.5; }

.bgp-table .bgp-wall-join { background-color:#fff; }

.bgp-table .bgp-floor { background-color:#9f9; }
.bgp-table .bgp-innerwall { background-color:#99f; }
.bgp-table .bgp-outerwall { background-color:#f99; }

.help-legend-floor { background-color:#9f9; }
.help-legend-innerwall { background-color:#99f; }
.help-legend-outerwall { background-color:#f99; }



.bgp-label-front { text-transform:uppercase; text-align:center; }

/*
.bgp-table tr:first-child td { border-top:2px dashed #000; }
.bgp-table tr:last-child td { border-bottom:2px dashed #000; }
.bgp-table tr td:first-child { border-left:2px dashed #000; }
.bgp-table tr td:last-child { border-right:2px dashed #000; }
#options span { color:#aaa; }
#ignore .bgp-table .hovering { border:1px solid #f00; }
.mouse-left { border-left:5px solid #0f0 !important; }
.mouse-right { border-right:5px solid #0f0 !important; }
.mouse-top { border-top:5px solid #0f0 !important; }
.mouse-bottom { border-bottom:5px solid #0f0 !important }
*/
</style>
@endsection

@section('js')
<script type="text/javascript" src="/js/jquery.toast.js"></script>
<script type="text/javascript" src="/js/bootbox.js"></script>
<script type="text/javascript" src="/js/planner.js"></script>
@endsection

@section('content')

<h1>{{{ $data->title }}}</h1>

<div id="quote-help-content" style="display:none;">
	<h4>Creating your quotation</h4>
	<ol>
		<li>Click a box to view the options available for that space.</li>
		<li>In the popup that appears, select the options that you would like to apply to that space.</li>
		<li>Close the popup after you've made your selections - your choices are added automatically.</li>
		<li>When you've finished your selections, click the &quot;<strong>Save</strong>&quot; button to save and generate your quote.</li>
	</ol>
	<hr />
	<h4>Colour Coding</h4>
	<p><span class="label help-legend-innerwall">Internal walls</span></</p>
	<p><span class="label help-legend-outerwall">External walls</span></p>
	<p><span class="label help-legend-floor">Floor area</span></p>
</div>

<div class="row">
	<div class="col-md-8">
        <div class="btn-toolbar">
            <div class="btn-group pull-right">
                <button type="button" id="save-plan" class="btn btn-primary" disabled>Save changes</button>
                <button type="button" id="finish-plan" class="btn btn-primary" disabled>Submit</button>
            </div>
        </div>
		<div id="plan"></div>
		<div id="planoptions-display"></div>
	</div>
	<div class="col-md-4">
		<p><button type="button" id="quote-help" class="btn btn-primary btn-block" disabled>Help <span class="glyphicon glyphicon-question-sign"></span></button></p>
		<h2>Available Options</h2>
		<form id="planoptions" onsubmit="return false;">
			<ul class="nav nav-tabs">
				<?php $i = 0; foreach ($data->options as $group_name => $group_options) : $i++; ?>
				<li <?php if ($i == 1) : ?>class="active"<?php endif; ?> title="{{{ $group_name }}}"><a href="#options-{{{ $i }}}" data-toggle="tab">{{{ current(explode(" ", $group_name)) }}}</a></li>
				<?php endforeach; ?>
			</ul>
			<div class="tab-content">
				<?php $i = 0; foreach ($data->options as $group_name => $group_options) : $i++; ?>
				<div class="tab-pane <?php if ($i == 1) : ?>active<?php endif; ?>" id="options-{{{ $i }}}">
					<?php foreach ($group_options as $group_option) : ?>
						<div class="radio">
							<label>
								<input type="radio" name="option" data-planoption='{{{ json_encode($group_option->to_array()) }}}' /> {{{ $group_option->name }}} <span class="pull-right">&pound;{{{ $group_option->price }}}</span>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</form>
	</div>
</div>
<script>
$(function() {
	var bgp = new bgplanner('#plan', {
		rows: {{ (int) $data->plan->rows }},
		cols: {{ (int) $data->plan->columns }},
		planoptionsForm: '#planoptions',
		planoptionsRender: '#planoptions-display',
		saveUrl: '{{ action('quotations@save', array($data->plan->get_key())) }}'
	});
    bgp.loadData({{ $data->plan->getPlanoptionsJson() }});

    $('#save-plan').click(function() {
        var btn = $(this);
        var btns = $(this).parent().find('button').prop('disabled',true);
        var d = bgp.save();
        d.always(function() {
            btns.prop('disabled',false);
        }).fail(function() {
            $.toast('Error saving your plan; please try again');
        }).done(function() {
            $.toast('Your plan was saved');
        });
        return d;
    }).prop('disabled',false);

    $('#finish-plan').click(function() {
        var btn = $(this);
        var btns = $(this).parent().find('button').prop('disabled',true);
        var d = bgp.save();
        d.done(function() {
            window.location = '{{ action('quotations@submitted') }}';
        }).fail(function() {
            btns.prop('disabled',false);
        });
    }).prop('disabled',false);

	$('#plan').on('bgp.planoptions.added', function(e, planoption) {
		$.toast(planoption.name + ' has been added');
	});
});

$(function() {
	$('#quote-help').click(function() {
		bootbox.dialog({
			title: 'Help',
			message: $('#quote-help-content').html(),
			buttons: {
				'OK': {}
			}
		});
	}).prop('disabled',false);
});
</script>

@endsection











