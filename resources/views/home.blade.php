@extends('layouts.app')
@section('title', 'مجرة - مصادر ومسارات متكاملة لتتعلم ما تحب')

@section('content')	
<!-- Header -->
<header class="header-lg container-fluid">
	<div class="row justify-content-center">
		<div class="col col-md-8 col-lg-6 text-center">
			<h1 class="header-title">
				مجرة ... مصادر و مسارات متكاملة <br>لتتعلم ما تحب
			</h1>
			<div class="header-search">
				<form action="/search" class="search-form" data-selector="search-form">
					<input type="search" name="q" placeholder="{{ __('What would you like to learn?')}}" 
						class="form-control" autocomplete="off">
					<button class="btn" type="button">
						<span class="material-icons">search</span>
					</button>
					<div class="search-results d-none" data-selector="search-results"></div>
				</form>
			</div>

			@if(isset($mostSearched) && !$mostSearched->isEmpty())
			<div class="most-searched">
				<h6>الأكثر بحثًا:</h6>
				<ul class="d-inline">
					@foreach ($mostSearched as $tool)
						<li><a href="{{ route('tools.show', $tool->id) }}">{{ $tool->title }}</a></li>	
					@endforeach
				</ul>
			</div>
			@endif

		</div>
	</div>
</header>

<!-- Courses Section -->
<section id="tools-section" class="container">
	<div class="row">
		<div class="col text-center">
			<h4 class="section-title">{{ __('Tools and Technologies') }}</h4>
		</div>
	</div>

	<div class="row cards-catalog justify-content-center">
		@foreach ($tools as $tool)	
			<div class="col-12 col-md-4">
				@include('components.tool-card')
			</div>
		@endforeach
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-3">
			<a href="{{ route('tools.index') }}" class="btn btn-primary btn-block">تصفح الكل</a>
		</div>
	</div>

</section>

@endsection