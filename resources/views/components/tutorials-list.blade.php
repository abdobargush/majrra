<div id="courses-list">

@forelse ($tutorials as $tutorial)
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
						<a href="{{ $tutorial->url }}" target="_blank">
							{{ $tutorial->title }}
							<span class="ont-weight-normal small mr-1">({{ $tutorial->domain }})</span>
						</a>
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
					
					@if ($tutorial->filters)
					<ul class="tags-list d-sm-inline-block d-none">
						<form action="">
							@foreach ($tutorial->filters as $filter)
								<li>{{ __( ucfirst($filter) ) }}</li>
							@endforeach
						</form>
					</ul>
					@endif
					
				</div>
			</div>

		</div>
	</div>
@empty
	<div class="card">
		<div class="card-body text-center">
			{{ __('No results found.') }}
		</div>
	</div>
@endforelse

<!-- Pagination -->
@if ( method_exists($tutorials, 'links') )
<nav aria-label="Page navigation" class="text-center">
	{{ $tutorials->links() }}
</nav>
@endif

</div>