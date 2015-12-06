/**
 * options = {
*   rows: 3,
*   cols: 5,
*   planoptionsForm: '#planoptions',
*   planoptionsRender: '#planoptions-display',
*   saveUrl: 'http://....'
* }
 */
function bgplanner(container, options) {
    var me = this;

    this.$container = $(container);
    this.options = options;

    this.$table = $('<table />').addClass('bgp-table').appendTo(this.$container);
    this.$front = $('<p class="bgp-label-front">Front</p>').insertAfter(this.$table);
    this.$planoptionsForm = $(options.planoptionsForm);
	this.$planoptionsRender = $(options.planoptionsRender);

    // add rows
    for (var i = 0; i < options.rows; i++) $('<tr class="bgp-row" />').appendTo(this.$table);

    // add cells
    this.$table.find('tr').each(function() {
        for (var i = 0; i < options.cols; i++) $('<td class="bgp-floor" />').appendTo(this);
        // add inner vertical joins
        $(this).find('td').not(':last').after('<td class="bgp-innerwall bgp-innerwall-vertical" />');
    });

    // add divider rows
    this.$table.find('tr').not(':last').after('<tr class="bgp-row-divider" />');

    // add divider row cells
    this.$table.find('.bgp-row-divider').each(function() {
        for (var i = 0; i < options.cols; i++) $('<td class="bgp-innerwall bgp-innerwall-horizontal" />').appendTo(this);
        $(this).find('td').not(':last').after('<td class="bgp-wall-join" />');
    });

    // add top/bottom outer walls
    $('<tr />').insertBefore(this.$table.find('tr:first')).clone().insertAfter(this.$table.find('tr:last'));
    this.$table.find('tr:first').addClass('bgp-outerwall-top');
    this.$table.find('tr:last').addClass('bgp-outerwall-bottom');
    this.$table.find('tr:first, tr:last').each(function() {
        for (var i = 0; i < options.cols; i++) $('<td class="bgp-outerwall" />').appendTo(this);
        var td = $('<td class="bgp-outerwall bgp-wall-join" />');
        $(this).find('td').not(':last').each(function() {
            td.clone().insertAfter(this);
        });
    });

    // add left/right outer walls
    this.$table.find('tr').each(function() {
        $('<td class="bgp-outerwall" />').appendTo(this).clone().prependTo(this);
        if ($(this).hasClass('bgp-row-divider')) $(this).find('.bgp-outerwall').addClass('bgp-wall-join');
    });
    this.$table.find('tr:first, tr:last').each(function() {
        $(this).find('td:first, td:last').addClass('bgp-wall-join');
    })

    // set up the option selectors
    this.planoption_selected = null;
	this.$planoptionsForm.find(':radio').on('click change', function () {
		me.planoption_selected = $(this).data('planoption');
    });
    this.$planoptionsForm.find(':radio:first').click(); // set up the selected option

    // set up the customisable cells
    this.$table.find('.bgp-outerwall, .bgp-innerwall').not('.bgp-wall-join').each(function() {
        $(this).data('planoptions', []);
    }).hover(function(e) {
        $(this).addClass('hovering');
        me.renderPlanoptions(this);
    }, function(e) {
        $(this).removeClass('hovering');
        me.hidePlanoptions();
    }).click(function(e) {
        me.addPlanoption(this, me.planoption_selected);
    });
};

bgplanner.prototype.renderPlanoptions = function(element) {
    var planoptions = $(element).data('planoptions');
	console.log("1/", element, planoptions);
	var html = [];
	$.each(planoptions, function(k,v) {
		html.push(v.name);
	});
	html = html.join('<br />');
	
	this.$planoptionsRender.html(html);
	
    //
    //var find = false;
    //if (td.hasClass('bgp-outerwall')) find = 'outer_wall';
    //if (td.hasClass('bgp-innerwall')) find = 'inner_wall';
    //
    //console.log('find = ', find);
    //
    //// get the options for the td
    //var opts = $.map(plan_options, function(v, k) {
    //    if (find) {
    //        if (find == 'outer_wall'  &&  v.outer_wall == "1") return v;
    //        else if (find == 'inner_wall'  &&  v.inner_wall == "1") return v;
    //        else return;
    //    }
    //    else {
    //        if (v.outer_wall == "0"  &&  v.inner_wall == "0") return v;
    //        return;
    //    }
    //});
    //console.log("Valid options: ", opts);
    //
    //// format and display
    //var m = $('#options-modal');
    //var b = m.find('.modal-body').css({
    //    'max-height': '200px',
    //    'overflow': 'auto'
    //});
    //do {
    //    if (!opts.length) {
    //        b.html('<p>No options were found for this section</p>');
    //        break;
    //    }
    //    $.each(opts, function(k, v) {
    //        var f = $('<div class="form-action clearfix" />');
    //        $('<label class="col-xs-10" />').text(v.name).appendTo(f);
    //        $('<input type="text" class="form-control input-sm" placeholder="Qty" />').data('oos', v).prependTo(f).wrap('<div class="col-xs-2" />');
    //        f.appendTo(b);
    //    });
    //}
    //while (false);
    //m.modal('show');
	
	console.log(html);
    $(element).trigger('bgp.planoptions.show', {
		html: html
	});
};

bgplanner.prototype.hidePlanoptions = function() {
	this.$planoptionsRender.empty();
	this.$table.trigger('bgp.planoptions.hide');
};

bgplanner.prototype.addPlanoption = function(element, planoption) {
    var planoptions = $(element).data('planoptions');

    var td = $(element);
	
    // check outerwall and outerwall
    if (td.hasClass('bgp-outerwall')  &&  planoption.outer_wall) {
        // remove existing outer wall
        var temp = [];
        for (var i in planoptions) {
            if (!planoptions[i].outer_wall) temp.push(planoptions[i]);
        }
        planoptions = temp;
        planoptions.push(planoption);
    }

    // check innerwall and innerwall
    else if (td.hasClass('bgp-innerwall')  &&  planoption.inner_wall) {
        // remove existing inner wall
        var temp = [];
        for (var i in planoptions) {
            if (!planoptions[i].inner_wall) temp.push(planoptions[i]);
        }
        planoptions = temp;
        planoptions.push(planoption);
    }

    // decking
    else if (td.hasClass('bgp-outerwall')  &&  planoption.decking) {
        // remove existing decking
        var temp = [];
        for (var i in planoptions) {
            if (!planoptions[i].decking) temp.push(planoptions[i]);
        }
        planoptions = temp;
        planoptions.push(planoption);
    }

    // flyover
    else if (td.hasClass('bgp-outerwall')  &&  planoption.flyover) {
        // remove existing flyover
        var temp = [];
        for (var i in planoptions) {
            if (!planoptions[i].flyover) temp.push(planoptions[i]);
        }
        planoptions = temp;
        planoptions.push(planoption);
    }

    // additions
    else if (planoption.global) {
        planoptions.push(planoption);
    }

    // didn't match :(
    else {
        console.log('no match :(');
        return; // don't do any of the clean up stuff
    }

    // save the options back to the element
    td.data('planoptions', planoptions);
	
	this.renderPlanoptions(element);

    // trigger an event to say something happened
    td.trigger('bgp.planoptions.added', [ planoption ]);
};

bgplanner.prototype.save = function() {
	var d = $.Deferred();
	
	var data = [];
    this.$table.find('tr').each(function(rk, row) {
        $(row).find('td').each(function(ck, cell) {
            var planoptions = $(cell).data('planoptions');
            // sss -> handle quantities
            $(planoptions).each(function(k,v) {
                data.push({
                    id: v.id,
                    quantity: 1,
                    row: rk,
                    column: ck
                });
            });
        });
    });

    $.post(this.options.saveUrl, {
        table: data
    }).done(function() {
        d.resolve();
    }).fail(function() {
        d.reject();
    });
	
	return d;
};

bgplanner.prototype.loadData = function(data) {
    var $table = this.$table;
    var planner = this;
    var planoptions = this.$planoptionsForm.find(':radio').map(function(k, v) {
        return $(v).data('planoption');
    });
    //console.log('planoptions:', planoptions);
    $(data).each(function(k, record) {
        // get the td
        var td = $table.find('tr:eq('+record.row+')').find('td:eq('+record.column+')');
        if (!td) return;

        // find the plan option
        var planoption;
        planoptions.each(function(k, v) {
            //console.log("planoption.id", v.id, "record.id", record.id);
            if (v.id == record.id) {
                planoption = v;
                return false; // break out of the each loop
            }
        });

        if (planoption) {
            planner.addPlanoption(td, planoption);
        }
        else {
            console.log("Didn't find a planoption for record", record);
        }
    });

    planner.hidePlanoptions(); // oh dear - renders each time a planoption is added :(
};