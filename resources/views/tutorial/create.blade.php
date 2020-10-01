@extends('layouts.app')
@section('title',  __('Submit a Tutorial'))

@section('content')
<header>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h3 class="mb-3">{{ __('Submit a Tutorial') }}</h3>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-5">
	<div class="row justify-content-center">

		<div class="col-md-6">
			<div class="card">

				<div class="card-body">

					<form method="POST" action="{{ route('tutorials.store') }}">
						@csrf

						@if (session('tutorialAdded'))
							<div class="alert alert-success text-center" role="alert">
								{{ __('Thank you! We have recieved your submission and will inform you when it\'s published.') }}
							</div>
						@endif

						<div class="form-group">
							<label for="url">{{ __('Url') }}</label>
							<input name="url" id="submit-url" type="url" class="form-control @error('url') is-invalid @enderror" placeholder="{{ __('Url of the tutorial') }}" required>

							@error('url')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
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
									<input type="radio" id="beginner" name="filters[level]" value="beginner">
									<label for="beginner">{{ __('Beginner') }}</label>
								</div>
								<div class="tag-control tag-radio">
									<input type="radio" id="advanced" name="filters[level]" value="advanced">
									<label for="advanced">{{ __('Advanced') }}</label>
								</div>
							</div>
							<div class="form-row align-items-center form-group">
								<p class="col-auto mb-0 ml-4">{{ __('Price') }}</p>
								<div class="tag-control tag-radio ml-2">
									<input type="radio" id="free" name="filters[price]" value="free">
									<label for="free">{{ __('Free') }}</label>
								</div>
								<div class="tag-control tag-radio">
									<input type="radio" id="paid" name="filters[price]" value="paid">
									<label for="paid">{{ __('Paid') }}</label>
								</div>
							</div>
							<div class="form-row align-items-center">
								<p class="col-auto mb-0 ml-4">{{ __('Content type') }}</p>
								<div class="tag-control tag-radio ml-2">
									<input type="radio" id="video" name="filters[type]" value="video">
									<label for="video">{{ __('Video') }}</label>
								</div>
								<div class="tag-control tag-radio ml-2">
									<input type="radio" id="book" name="filters[type]" value="book">
									<label for="book">{{ __('Book') }}</label>
								</div>
								<div class="tag-control tag-radio">
									<input type="radio" id="interactive" name="filters[type]" value="interactive">
									<label for="interactive">{{ __('Interactive') }}</label>
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
</div>
@endsection