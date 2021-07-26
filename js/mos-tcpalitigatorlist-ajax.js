jQuery(document).ready(function($){	
	$('.mos-tcpalitigatorlist-form').submit(function(e){
		e.preventDefault();
        let ths = $(this);
        let html = 'Status: ';
		let form_data = $(this).serialize();
		let phone = $(this).find('.phone').val();
		let type = $(this).find('.type').val();
		//console.log(form_data);
        $.ajax({
            url: ajax_obj.ajax_url, // or example_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: {
                'action': 'number_tracking',
                'phone' : phone,
                'type' : type,
            },
            success: function(result){
                //console.log(result);
                if (result){
                    html += result;
                } else {
                    html += 'No data found';
                }
                ths.siblings('.result').html(html);
                //$('.track-output').html(result);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
	});
});