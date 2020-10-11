@extends('layouts.app')
@section('title', "تعلم {$tool->title}: [" . date("Y") . "] أفضل كورسات وشروحات {$tool->title}")
@section('description', "تريد تعلم {$tool->title}? تصفح أفضل الكورسات والمصادر التعليمية لتعلم {$tool->title} والتي يقوم المستخدمون بمشاركتها على مجرة والتصويت عليها.")
@section('metaImage', $tool->thumbnail)

@section('content')
<header class="before-content">
	<div class="container">
		<div class="col-12">
			<div class="tool-heading">
				<img class="tool-pic" src="{{ $tool->thumbnail }}" alt="tool-image">
				<div class="tool-info">
					<h3 class="tool-title">{{ $tool->title }}</h3>
					<div class="tool-source-info">
						<span class="material-icons text-icon">collections_bookmark</span>
						<span>{{ $tool->sourcesCount }}</span> مصدر
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="content" class="container">
	<div class="row">
		<div class="col-md-9">
			<x-tutorials-list :tutorials="$tutorials"></x-tools-list>

			<section id="intersets" class="py-4">
				<h4 class="mb-3">تقنيات قد تهمك</h4>
				<div class="row cards-catalog">
	
					@foreach ($suggestedTools as $tool)
					<div class="col-12 col-md-4">
						@include('components.tool-card', compact('tool'))
					</div>
					@endforeach

				</div>
			</section>

		</div>
		<div class="col-md-3 mb-5 mb-md-0">
			<form class="filter-box" action="">

				<div class="filter-section">
					<h5 class="filter-title">{{ __('Level') }}</h5>

					@unless (request()->has('difficulty') && request()->query('difficulty') != 'beginner')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="difficulty" value="beginner" id="beginner" class="custom-control-input"
							onChange="submit();" 
							{{ request()->query('difficulty') == 'beginner' ? 'checked' : '' }} />
						<label class="custom-control-label" for="beginner">{{ __('Beginner') }}</label>
					</div>
					@endunless

					@unless (request()->has('difficulty') && request()->query('difficulty') != 'advanced')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="difficulty" value="advanced" id="advanced" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('difficulty') == 'advanced' ? 'checked' : '' }} />
						<label class="custom-control-label" for="advanced">{{ __('Advanced') }}</label>
					</div>
					@endunless

				</div>

				<div class="filter-section">
					<h5 class="filter-title">{{ __('Price') }}</h5>

					@unless (request()->has('price') && request()->query('price') != 'free')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="price" value="free" id="free" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('price') == 'free' ? 'checked' : '' }} />
						<label class="custom-control-label" for="free">{{ __('Free') }}</label>
					</div>
					@endunless

					@unless (request()->has('price') && request()->query('price') != 'paid')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="price" value="paid" id="paid" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('price') == 'paid' ? 'checked' : '' }} />
						<label class="custom-control-label" for="paid">{{ __('Paid') }}</label>
					</div>
					@endunless

				</div>

				<div class="filter-section">
					<h5 class="filter-title">{{ __('Content type') }}</h5>

					@unless (request()->has('type') && request()->query('type') != 'video')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="type" value="video" id="video" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('type') == 'video' ? 'checked' : '' }} />
						<label class="custom-control-label" for="video">{{ __('Video') }}</label>
					</div>
					@endunless

					@unless (request()->has('type') && request()->query('type') != 'book')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="type" value="book" id="book" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('type') == 'book' ? 'checked' : '' }} />
						<label class="custom-control-label" for="book">{{ __('Book') }}</label>
					</div>
					@endunless

					@unless (request()->has('type') && request()->query('type') != 'interactive')
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="type" value="interactive" id="interactive" class="custom-control-input"
							onChange="submit();"
							{{ request()->query('type') == 'interactive' ? 'checked' : '' }} />
						<label class="custom-control-label" for="interactive">{{ __('Interactive') }}</label>
					</div>
					@endunless

				</div>

			</form><!-- End .filter-box -->
		</div>
	</div>
</div>

@endsection
