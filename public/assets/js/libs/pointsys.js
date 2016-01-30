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

$('.redeem_points').click( function(){ 
	
	var url_rfid_serial = $(this).data('rfid');

	$.ajax({
			type     : 'get',
			url      : url_rfid_serial,
			async	 : false
		}).success(function (response) {
			$('#modalRedeemLabel').text('Player Name: ' + response.player_name );
			$('#player_points').text('Player Points: $' + response.points);
			$('#confirm_points').val(response.points);
			$('#player_id').val(response.player_id);
			$('#myModal').modal('show'); 

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

$('.confirm_redemption').click( function(){
	var redeem_points      = parseFloat($('#points_redeemed').val());
	var confirm_redemption = parseFloat($('#confirm_points').val());

	if(confirm_redemption >= redeem_points)
	{
		$('#playerPointsRedeem').removeClass('state-error');
		$('.note-error').text('');
		$('#points-redeem-form').submit();
	}
	else
	{	
		$('#playerPointsRedeem').addClass('state-error');
		$('.note-error').text('Insufficient points to redeem.');
	}

});

$('.player_points_redeem').autoNumeric('init', {aSep: '', vMin: '1.00' , vMax: '999999.99'});