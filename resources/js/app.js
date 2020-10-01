
require('./bootstrap');

$( function() {
	require('./validate');
	require('./auth');
	require('./search');
	require('./tutorial-actions');
});

/*
 * Helper to add bootstrap alerts using jquery
 */
$.fn.extend({
	addAlert: function (message, type = 'info', overwrite = false) {
		return this.each(function () {

			if (overwrite) {
				$(this).find('.alert').remove()
			}

			$(`<div class="alert alert-${type} alert-dismissible fade show" role="alert">
				${message}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>`).prependTo(this)

		})
	} 
})

/**
 * Helper for ajax forms submission
 */
$.fn.extend({

	initAjaxForm: function ( callback ) {
		return this.each(function () {

			// Select form
			var form = $(this);

			// Generate form data
			var formData = function () {
				var dataObj = {}
				var fieldSelector = 'input:not(disabled),select:not(disabled),textarea:not(disabled)';

				$(form).find(fieldSelector).each(function () {

					// continue if the input is radio or chekbox and not selected
					if (
						($(this).is(':radio') || $(this).is(':checkbox')) &&
						 $(this).is(':not(:checked)')
					) {
						return;
					}

					dataObj[ $(this).attr('name') ] = $(this).val()
				});

				return dataObj;
			}
			

			$(form).on('submit', function(e) {
				e.preventDefault();
			
				// Check validity with jquery-validation
				if ( !$(this).valid() ) return;
			
				$.ajax({
					method: $(this).attr('method'),
					url: $(this).attr('action'),
					data: formData(),
					success: function (response) {
						callback.success(response);
					},
					error: function(xhr, status, error) {
						callback.error(xhr.responseJSON.errors);
					}
				});
			
			});

		});
		
	}
});
