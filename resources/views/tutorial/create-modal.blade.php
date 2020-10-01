<!-- Submit Modal -->
<div class="modal fade" id="submit-modal" tabindex="-1" role="dialog" aria-labelledby="SubmitModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				إغلاق
			</button>

			<div class="modal-header">
				<h5 class="modal-title" id="SubmitModalLabel">{{ __('Submit a Tutorial') }}</h5>
			</div>
			
			<div class="modal-body">
				<form id="submit-form" method="POST" action="{{ route('tutorials.store') }}">

					<div class="form-group">
						<label for="url">{{ __('Url') }}</label>
						<input name="url" id="submit-url" type="url" class="form-control @error('url') is-invalid @enderror" placeholder="{{ __('Url of the tutorial') }}">
					</div>
					
					<div class="form-group form-block">
						<p class="mb-0 text-muted text-center">
							<small>{{ __('Tell us more about this tutorial (optional)') }}</small>
						</p>
						<hr class="my-2">
						<div class="form-group">
							<label for="submit-title">{{ __('Title') }}</label>
							<input name="title" id="submit-title" class="form-control">
						</div>
						<div class="form-group">
							<x-select-category></x-select-category>
						</div>
						<div class="form-row align-items-center form-group">
							<p class="col-auto mb-0 ml-4">{{ __('Level') }}</p>
							<div class="tag-control tag-radio ml-2">
								<input type="radio" id="submit-beginner" name="filters[difficulty]" value="beginner">
								<label for="submit-beginner">{{ __('Beginner') }}</label>
							</div>
							<div class="tag-control tag-radio">
								<input type="radio" id="submit-advanced" name="filters[difficulty]" value="advanced">
								<label for="submit-advanced">{{ __('Advanced') }}</label>
							</div>
						</div>
						<div class="form-row align-items-center form-group">
							<p class="col-auto mb-0 ml-4">{{ __('Price') }}</p>
							<div class="tag-control tag-radio ml-2">
								<input type="radio" id="submit-free" name="filters[price]" value="free">
								<label for="submit-free">{{ __('Free') }}</label>
							</div>
							<div class="tag-control tag-radio">
								<input type="radio" id="submit-paid" name="filters[price]" value="paid">
								<label for="submit-paid">{{ __('Paid') }}</label>
							</div>
						</div>
						<div class="form-row align-items-center">
							<p class="col-auto mb-0 ml-4">{{ __('Content type') }}</p>
							<div class="tag-control tag-radio ml-2">
								<input type="radio" id="submit-video" name="filters[type]" value="video">
								<label for="submit-video">{{ __('Video') }}</label>
							</div>
							<div class="tag-control tag-radio ml-2">
								<input type="radio" id="submit-book" name="filters[type]" value="book">
								<label for="submit-book">{{ __('Book') }}</label>
							</div>
							<div class="tag-control tag-radio">
								<input type="radio" id="submit-interactive" name="filters[type]" value="interactive">
								<label for="submit-interactive">{{ __('Interactive') }}</label>
							</div>
						</div>
					</div>

					<div class="form-row justify-content-center">
						<div class="col-12 col-md-6">
							<button type="submit" id="register-btn" class="btn btn-primary btn-block">{{ __('Send') }}</button>
						</div>
					</div>

				</form>
			</div>

		</div>
	</div>
</div>