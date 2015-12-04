$('#rfid_serial').click( function(){ 
	
	var url_rfid_serial = $('.rfid_serial_input').data('rfid');

    $.ajax({
			type     : 'get',
			url      : url_rfid_serial,
			async	 : false
		}).success(function (response) {
			
			$('.rfid_serial_input').val(response.rfid_serial);
			$('#hidden_rfid_serial').val(response.rfid_serial);

			$.smallBox({
				title : "Scan Card Success",
				content : "We have already enrolled this user into RFID.",
				color : "#739E73",
				iconSmall : "fa fa-check bounce animated",
				timeout : 5000
			});
		}).error(function(e) {
			var obj = jQuery.parseJSON(e.responseText);

			$.smallBox({
				title : obj.title,
				content : obj.message,
				color : "#C46A69",
				iconSmall : "fa fa-warning shake animated",
				timeout : 6000
			});
		});
});