jQuery(document).ready(function($){
    
    $('#websolns_admin_options > .nav-tab-wrapper a').click(function(e){
        e.preventDefault();
        var item = $(this).data('id'); 
        $('#websolns_admin_options > .nav-tab-wrapper > .nav-tab-active').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#websolns_admin_options > form > .group.active')
            .removeClass('active')
            .fadeOut('normal',function(){
                $('#'+item).addClass('active').fadeIn('normal');    
            });
    });
   
   
   var startDateTextBox = $('#start_time');
   var endDateTextBox = $('#end_time');
    
    startDateTextBox.datetimepicker({ 
    	onClose: function(dateText, inst) {
    		if (endDateTextBox.val() != '') {
    			var testStartDate = startDateTextBox.datetimepicker('getDate');
    			var testEndDate = endDateTextBox.datetimepicker('getDate');
    			if (testStartDate > testEndDate)
    				endDateTextBox.datetimepicker('setDate', testStartDate);
    		}
    		else {
    			endDateTextBox.val(dateText);
    		}
    	},
    	onSelect: function (selectedDateTime){
    		endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
    	},
        beforeShow: function (input, inst) {

             var offset = startDateTextBox.offset();
             setTimeout(function () {
                inst.dpDiv.css({
                    top: offset.top+startDateTextBox.outerHeight()
                });
            }, 0);

        }
    });
    endDateTextBox.datetimepicker({ 
    	onClose: function(dateText, inst) {
    		if (startDateTextBox.val() != '') {
    			var testStartDate = startDateTextBox.datetimepicker('getDate');
    			var testEndDate = endDateTextBox.datetimepicker('getDate');
    			if (testStartDate > testEndDate)
    				startDateTextBox.datetimepicker('setDate', testEndDate);
    		}
    		else {
    			startDateTextBox.val(dateText);
    		}
    	},
    	onSelect: function (selectedDateTime){
    		startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
    	},
        beforeShow: function (input, inst) {

             var offset = endDateTextBox.offset();
             setTimeout(function () {
                inst.dpDiv.css({
                    top: offset.top+endDateTextBox.outerHeight()
                });
            }, 0);

        }
    });
    
    $('#custom_bg_image').click(function(e) {
    	var that = $(this);
        e.preventDefault();
        var custom_uploader;
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            that.attr('src',attachment.url);
            that.siblings('.default_view').html('<img style="width:150px;height:150px;" src="'+attachment.url+'"/>');
            that.siblings('[name="websolns_custom_bg_image"]').val(attachment.id);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

    $('#websolns_tel').mask('(000) 000-0000');
    
    $('#websolns_hours > tbody > tr:not(:first-of-type)').each(function(){
    	
    	var startTimeTextBox = $(this).find('.websolns_open');
    	var endTimeTextBox = $(this).find('.websolns_close');
    	
    	    startTimeTextBox.timepicker({ 
    	    	onSelect: function (selectedDateTime){
    	    		update_bus_hours();
    	    	},
    	        beforeShow: function (input, inst) {

    	             var offset = startTimeTextBox.offset();
    	             setTimeout(function () {
    	                inst.dpDiv.css({
    	                    top: offset.top+startTimeTextBox.outerHeight()
    	                });
    	            }, 0);

    	        }
    	    , timeFormat: 'hh:mm tt'});
    	    
    	    endTimeTextBox.timepicker({ 
    	    	onSelect: function (selectedDateTime){
    	    		update_bus_hours();
    	    	},
    	        beforeShow: function (input, inst) {
    	        	
    	             var offset = endTimeTextBox.offset();
    	             setTimeout(function () {
    	                inst.dpDiv.css({
    	                    top: offset.top+endTimeTextBox.outerHeight()
    	                });
    	            }, 0);

    	        }
    	    , timeFormat: 'hh:mm tt'});
    	
    });
    
    $('.websolns_closed').change(function(){
    	update_bus_hours();
    });
    
    var update_bus_hours = function(){
    	var hr_opt =[];
    	$('#websolns_hours > tbody > tr:not(:first-of-type)').each(function(i){
    		var startTime = $(this).find('.websolns_open').val();
        	var endTime = $(this).find('.websolns_close').val();
        	var closed = $(this).find('.websolns_closed').is(':checked');
        	hr_opt.push({'start':startTime,'end':endTime,'closed':closed});
    	});
    	$('[name="websolns_hours"]').attr('value',JSON.stringify(hr_opt));
    };
    
    countChar($('#charcount_input')[0])
});

function countChar(val) {
	var len = val.value.length;
	if(len>60){
		val.value=val.value.substring(0,60);
	}else{
		document.getElementById('charNum').innerHTML=60-len+"/60";
		if((60-len)<9)
			document.getElementById('charNum').style.color ="red";
		else
			document.getElementById('charNum').style.color ="initial";
	}
};

