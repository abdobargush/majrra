@extends('layouts.app')
@section('title', $profile->name ? $profile->name : $profile->username)

@section('content')
<!-- Header -->
<header class="has-tabs mb-4">
	<div class="container">

		<div class="row justify-content-center">
			<div class="col-12 col-md-6 text-center">
				<img src="{{ $profile->getAvatar('108') }}" class="rounded-circle mb-3" alt="{{ $profile->name }}">
				<div class="mb-2">
					<h4 class="d-inline-block mb-0">{{ $profile->name }}</h4>
					<h6 class="d-inline-block mb-0">{{ '@' . $profile->username }}</h6>
				</div>

				@if ($profile->bio)
				<p class="mb-1">{{ $profile->bio }}</p>
				@endif

				@if ($profile->link)
				<a href="{{ $profile->link }}" dir="ltr" class="text-white" target="_blank">
					<u>
						<i class="material-icons md-24 text-icon">link</i>
						{{ $profile->link }}
					</u>
				</a>
				@endif
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col col-md-9">

			<ul class="nav nav-tabs nav-fill w-100" id="tutorialsTab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="added-tab" data-toggle="tab" href="#added" role="tab" aria-controls="added" aria-selected="true">{{ __('Submitted') }}</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="upvoted-tab" data-toggle="tab" href="#upvoted" role="tab" aria-controls="upvoted" aria-selected="false">{{ __('Upvoted') }}</a>
				</li>
			</ul>

			</div>
		</div>

	</div>
</header>

<!-- Tutorials -->
<div class="container mb-4">
	<div class="row justify-content-center">
		<div class="col col-md-9">
			<div class="tab-content" id="tutorialsTabContent">

				<div class="tab-pane fade show active" id="added" role="tabpanel" aria-labelledby="added-tab">
					<x-tutorials-list :tutorials="$addedTutorials"></x-tutorials-list>
				</div>

				<div class="tab-pane fade" id="upvoted" role="tabpanel" aria-labelledby="upvoted-tab">
					<x-tutorials-list :tutorials="$upvotedTutorials"></x-tutorials-list>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection