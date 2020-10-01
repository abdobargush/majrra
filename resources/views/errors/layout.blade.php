<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ __('Error') }} @yield('errorNumber') - @yield('title') | {{ __( config('app.name') ) }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Material Icons CSS-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<style>
		.error-number {
			font-size: 8rem;
			line-height: 0.85;
		}
		.error-description {
			font-size: 1.25rem;
		}
		@media screen and (min-width: 576px) {
			.error-number {
				font-size: 12rem;
			}
		}
	</style>

</head>

<body>
	<div id="app">

		<div class="container">

			<div class="row min-vh-100 align-items-center justify-content-center">
				<div class="col-md-12 text-center">
					<h2 class="error-number mb-0">
						@yield('errorNumber')
					</h2>
					<h1 class="error-title h2">
						@yield('title')
					</h1>
					<p class="error-description mb-4 text-muted">
						@yield('description')
					</p>
					<a href="/" class="btn btn-primary">
						{{ __('Back to home' )}}
					</a>
				</div>
			</div>

		</div>

	</div>
	
</body>

</html>