@extends('layouts.app')
@section('title',  $tutorial->title)

@section('content')
<header class="before-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card card-course">
					<div class="card-body d-flex align-items-center">
			
						@auth
							<form method="POST" action="{{ route('tutorials.upvote', $tutorial->id) }}" class="upvote-form">
								@csrf
			
								<button class="card-course-upvote {{ $tutorial->isUpvoted ? 'active' : '' }}">
									<span class="material-icons">keyboard_arrow_up</span>
									<p class="upvotes-counter mb-0">{{ $tutorial->upvotesCount() }}</p>
								</button>
							</form>
						@else
							<button class="card-course-upvote" data-target="#login-modal" data-toggle="modal">
								<span class="material-icons">keyboard_arrow_up</span>
								<p class="mb-0">{{ $tutorial->upvotesCount() }}</p>
							</button>
						@endauth
			
						<div class="card-course-content w-100">
							<h5 class="card-title d-flex align-items-start">
								<div style="flex:1">
									<a href="{{ route('tutorials.show', $tutorial->id) }}">{{ $tutorial->title }}</a>
									<a href="{{ $tutorial->url }}" class="font-weight-normal small mr-1"
										target="_blank">({{ $tutorial->domain }})</a>
								</div>
			
								@auth
								<form method="POST" action="{{ route('bookmarks.update', $tutorial->id) }}" class="bookmark-form">
									@csrf
			
									<button class="btn bookmark-btn d-none d-sm-inline-block {{ $tutorial->isBookmarked ? 'is-bookmarked' : ''}}">
										<span class="material-icons text-icon"></span>
										{{ __('Bookmark') }}
									</button>
								</form>
								@else
								<button class="btn bookmark-btn d-none d-sm-inline-block" data-target="#login-modal" data-toggle="modal">
									<span class="material-icons text-icon"></span>
									{{ __('Bookmark') }}
								</button>
								@endauth
			
							</h5>
							<div class="card-info">
								<span class="card-course-add-by d-inline-block ml-3">
									<span class="text-muted d-sm-inline d-none">أضيف بواسطة</span>
									<a href="{{ route('profile', $tutorial->addedBy->username) }}" class="text-muted">
										<img src="{{ $tutorial->addedBy->profile->avatar }}" class="rounded-circle ml-1" width="18"
										height="18">
										<u>{{ $tutorial->addedBy->profile->name }}</u>
									</a>
								</span>
			
								<a href="#" class="card-course-comments text-muted ml-3"><u>3 تعليقات</u></a>
			
							</div>
						</div>
			
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container">
	<div class="row justify-content-center">

	</div>
</div>
@endsection