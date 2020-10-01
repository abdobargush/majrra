@extends('layouts.app')
@section('title', __('Bookmarks'))

@section('content')
<header>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h2 class="mb-3">{{ __('Bookmarks') }}</h2>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-4">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<x-tutorials-list :tutorials="$bookmarks"></x-tools-list>
		</div>
	</div>
</div>
@endsection