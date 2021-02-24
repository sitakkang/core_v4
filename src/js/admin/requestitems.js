$(document).ready(function(){
	var url_ctrl = site_url+"admin/requestitems/";

	var table = $('#tabel_custom').DataTable({
        "ajax": url_ctrl+'table',
        "deferRender": true,
        "order": [["0", "desc"]]
    });

	// Select Row Table
	$('#tabel_custom tbody').on('click', 'tr', function(e){
     	e.preventDefault();
    	if($(this).hasClass('actived')){
			$(this).removeClass('actived');
			$(this).addClass('actived');
        }else{
            table.$('tr.actived').removeClass('actived');
            $(this).addClass('actived');
        }
    	//rowIndex = table.row(this).index();
		rowId = table.row(this).id();
		leftWidht = e.pageX-50;
    	$('#popup_menu').css({left:leftWidht+"px",top:e.pageY+"px"}).show("fast", function(){
    		$("button#edit_btn").attr('data-id', rowId);
    		$("button#delete_btn").attr('data-id', rowId);
    		$("button#reset_btn").attr('data-id', rowId);
    	});
    });

    $(document).on('click', function(e){
    	if(e.target.nodeName !== "TD"){
    		$('#popup_menu').hide();
    		$('#popup_menu').removeAttr('style');
    	}
	});

	$(document).on('click','#add_btn',function(e){
		e.preventDefault();
		window.location = 'requestitems/add';    
	});

	$(document).on('click','#save_add_btn',function(e){
		e.preventDefault();

		var lastnum = table.data().count() + 1;
		var request_number = $("input#request_number").val();
		var date = $("input#date").val();
		var user = $("#user option:selected").text();
		var status = $("#status option:selected").text();

		$.ajax({
			method:"POST",
			url:url_ctrl+'act_add',
			cache:false,
			data: {
				request_number:request_number,
	            date:date,
	            request_number:$("input#request_number").val(),
	            date:$("input#date").val(),
	            user:$("select#user").val(),
	            status:$("select#status").val()
			}
		})
		.done(function(result) {
			var obj = jQuery.parseJSON(result);
			if(obj.status == 1){
                notifNo(obj.notif);
			}
			if(obj.status == 2){
            	notifYesAuto(obj.notif);
			}
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	});

});