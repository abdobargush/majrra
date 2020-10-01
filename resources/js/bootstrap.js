window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
	
	window.Popper = require('popper.js').default;

	window.$ = window.jQuery = require('jquery');
	// Send csrf token with ajax requests
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	require('jquery-validation');
	require('bootstrap');
	require('select2');

} catch (e) { }
