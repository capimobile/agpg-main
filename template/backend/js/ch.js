      function schedule() {
		 $(document).ready(function() {
		var category = $('#tgl').val();
		$.ajax({
			type: 'GET',
			url: 'modul/mod_appointment/chain.php',
			data: 'ko=' + category, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#id_schedule').html('<option>Loading...</option>');	
			},
			success: function(response) {
				$('#id_schedule').html(response);
			}
		});
		});
    
	};
	