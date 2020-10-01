/**
 * Focus on search modal open
 */
$('#search-modal').on('shown.bs.modal', function () {
	$(this).find('[data-selector="search-input"]').trigger('focus');
});

/**
 * Search form logic
 */
var searchForm = $('[data-selector="search-form"]');

if (searchForm) {

	// Make seubmit on keyup
	searchForm.find('input').each(function () {

		var searchInput = $(this);

		searchInput.on('keyup', function(){

			// Stop if there is no value in search-input
			if (! searchInput.val()) {
				searchInput.parent().find('[data-selector="search-results"]')
					.addClass('d-none').removeClass('d-block');

				return;
			}
				
			// Submit search
			searchInput.parent().trigger('submit');
		});

	});
	

	$(document).on('click', (e)=>{
		// return if the click is inside the search form
		if ( searchForm.find(e.target).length > 0 ) return;

		// hide search results
		$(document).find('[data-selector="search-results"]').addClass('d-none').removeClass('d-block');
	});


	// Make ajax form submit
	searchForm.on('submit', (e)=>{
		e.preventDefault();

		// Hold the submitted form
		var submittedForm = $(e.target);

		$.get({
			url: submittedForm.attr('action') + '?q=' + submittedForm.find('input').val(),
			success: (response) => {

				var searchResults = submittedForm.find('[data-selector="search-results"]');

				// Generate search results content
				var searchResultsContent = '';

				if (response.length > 0) {

					// if there is results
					response.forEach(result => {
						searchResultsContent += `
							<a href="/tools/${result.id}" class="d-flex">
								<img src="${result.thumbnail}" width="24" height="24" alt="">
								<p class="mr-2 mb-0">${result.title}</p>
							</a>
						`;
					});

				} else {
					searchResultsContent = '<p class="text-center py-2 mb-0">لا يوجد نتائج لعرضها.</p>'
				}
	
				
				// Append search results content
				searchResults.html(searchResultsContent);
				
				// Show search results
				searchResults.addClass('d-block').removeClass('d-none');
			}
		});

	});

}