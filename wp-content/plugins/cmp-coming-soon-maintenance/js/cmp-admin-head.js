jQuery(document).ready(function($){

	// toggle cmp activation via menu bar ajax
	jQuery('#cmp-status-menubar').click(function() {
		var security = jQuery(this).data('security');
		var data = {
			action: 'cmp_toggle_activation',
			security: security,
			payload: 'toggle_cmp_status'
		};


		$.post(ajaxurl, data, function(response) {	
			if (response == 'success') {
				jQuery('.cmp-status input[type=radio]').prop('disabled', function (_, val) { return ! val; });
				jQuery('#cmp-status').prop('checked', function (_, val) { return ! val; });

			} 
		});

	});
});