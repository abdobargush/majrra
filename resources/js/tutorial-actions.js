/**
 * Initialize select2 for tutorial submission
 */
$('#select-category').select2({
	tags: true,
	dir: 'rtl',
	width: '100%'
});

/**
 * Initialize Submission form
 */
var submitForm = $('#submit-form');
submitForm.initAjaxForm({

	success: function (response) {

		// Show success message and reset the form
		submitForm.addAlert(response.message, 'success', true);
		submitForm.trigger('reset');

		// Reset category select
		$('#select-category').val(null).trigger('change');

	},
	error: function(errors) {

		submitForm.addAlert(Object.values(errors)[0], 'danger', true);
		
	}

});


/**
 * Validate unique url in submit form
 */
submitForm.find('[name="url"]').rules( 'add', {
	remote: {
		url: '/submit/check',
		type: 'post',
		data: {
			url: function () {
				return submitForm.find('[name="url"]').val()
			}
		}
	},
	messages: {
		remote: 'هذا الرابط مسجل لدينا بالفعل'
	}
});


/**
 * Bookmark tutorial
 */
$('.bookmark-form').on('submit', function (e) {
	e.preventDefault();

	const form = $(this);

	$.post({
		url: form.attr('action'),
		success: function (data) {
			form.find('.bookmark-btn').toggleClass('is-bookmarked');
		}
	});
})

/**
 * Upvote tutorial
 */
$('.upvote-form').on('submit', function (e) {
	e.preventDefault();

	const form = $(this);

	$.post({
		url: form.attr('action'),
		success: function (data) {
			form.find('.card-course-upvote').toggleClass('active');

			const upvotesCounter = form.find('.upvotes-counter');

			if (data.attached.length > 0) {
				upvotesCounter.text( parseInt( upvotesCounter.text() ) + 1 );
			} else {
				upvotesCounter.text( upvotesCounter.text() - 1 );
			}
		}
	});
})