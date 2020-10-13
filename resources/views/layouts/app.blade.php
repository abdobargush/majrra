<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Primary Meta Tags -->
	<title>@yield('title') @unless (Request::is('/')) | {{ __( config('app.name') ) }} @endunless</title>
	<meta name="title" content="@yield('title') @unless (Request::is('/')) | {{ __( config('app.name') ) }} @endunless">
	<meta name="description" content="@yield('description')">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ Request::url() }}">
	<meta property="og:title" content="@yield('title') @unless (Request::is('/')) | {{ __( config('app.name') ) }} @endunless">
	<meta property="og:description" content="@yield('description')">
	<meta property="og:image" content="@yield('metaImage', asset('/images/logo-meta.png'))">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ Request::url() }}">
	<meta property="twitter:title" content="@yield('title') @unless (Request::is('/')) | {{ __( config('app.name') ) }} @endunless">
	<meta property="twitter:description" content="@yield('description')">
	<meta property="twitter:image" content="@yield('metaImage', asset('/images/logo-meta.png'))"">
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">

	<!-- Material Icons CSS-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	@if( env('GOOGLE_TRACKING_ID') )	
	<!-- Google Analytics -->
	<script async src="{{ 'https://www.googletagmanager.com/gtag/js?id=' . env('GOOGLE_TRACKING_ID') }}"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '{{ env('GOOGLE_TRACKING_ID') }}' );
	</script>
	@endif

</head>

<body>
	<div id="app">

		<x-navbar></x-navbar>

		@yield('content')

		<footer class="container">
			<div class="footer-content">
				<div class="row align-items-center">
					<div class="col-12 col-md-6">
						<a href="#" class="footer-logo">مجرة</a>
						<ul class="footer-list mb-3 mb-md-0">
							<li>
								<a href="{{ route('page', 'about') }}">عن مجرة</a>
							</li>
							<li>
								<a href="{{ route('page', 'privacy') }}">سياسة الخصوصية</a>
							</li>
							<li>
								<a href="mailto:hello@majrra.com">تواصل معنا</a>
							</li>
						</ul>
					</div>
					<div class="col-12 col-md-6 text-right text-md-left">
						صنع ب <span class="material-icons text-icon m-0" style="color: #EF5350;">favorite</span> في طنطا
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p class="credits">
							© المحتوى منشور تحت
							<a href="https://creativecommons.org/licenses/by-sa/4.0/">رخصة المشاع الإبداعي BY-SA</a>
						</p>
					</div>
				</div>
			</div>
		</footer>

		@guest
		<!-- Login Modal -->
		<div class="modal modal-custom fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						{{ __('Close' )}}
					</button>
					<div class="modal-header">
						<h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<a href="{{ route('socialAuth', 'twitter') }}" class="btn btn-outline-white btn-block">
								<svg class="ml-1" viewBox="0 0 20 20" width="18" height="18">
                                    <path fill="currentColor" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
                                </svg>
								{{ __('Continue with Twitter') }}
							</a>
						</div>
						<div class="modal-divider">
							<span>{{ __('OR') }}</span>
						</div>
						<form id="login-form" action="/login" method="POST">
							@csrf
							<div class="form-group">
								<input type="email" id="login-email" name="email" class="form-control modal-control" placeholder="{{ __('Email Address') }}" autocomplete="email" required>
							</div>
							<div class="form-group">
								<input type="password" id="login-password" name="password" class="form-control modal-control" placeholder="{{ __('Password') }}" required>
							</div>
							<div class="form-group text-center  mb-4">
								<a href="{{ route('password.request') }}" class="text-white"><u>{{ __('Forgot Your Password?') }}</u></a>
							</div>
							<div class="form-row justify-content-center">
								<div class="col-12 col-md-6">
									<button type="submit" id="login-btn" class="btn btn-white btn-block">{{ ucfirst( __('login') ) }}</button>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<span>{{ __('Don\'t have an account?') }}</span>
						<a href="{{ route('register') }}" data-target="#register-modal" data-toggle="modal" onclick="$('#login-modal').modal('hide');">{{ __('Register now!') }}</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Register Modal -->
		<div class="modal modal-custom fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						{{ __('Close') }}
					</button>
					<div class="modal-header">
						<h5 class="modal-title" id="RegisterModalLabel">{{ __('New Account') }}</h5>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<a href="{{ route('socialAuth', 'twitter') }}" class="btn btn-outline-white btn-block">
								<svg class="ml-1" viewBox="0 0 20 20" width="18" height="18">
                                    <path fill="currentColor" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
                                </svg>
								{{ __('Continue with Twitter') }}
							</a>
						</div>
						<div class="modal-divider">
							<span>{{ __('OR') }}</span>
						</div>
						<form id="register-form" action="/register" method="POST">
							@csrf
							<div class="form-group">
								<input type="text" name="username" id="register-username" 
									class="form-control modal-control" placeholder="{{ __('Username' )}}" 
									data-validate="register-username" minlength="3" maxlength="32" required>
							</div>
							<div class="form-group">
								<input type="email" name="email" id="register-email" 
									class="form-control modal-control" placeholder="{{__('Email Address')}}" autocomplete="email"
									data-validate="register-email" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="register-password" 
									class="form-control modal-control" placeholder="{{ __('Password') }}" 
									minlength="6" required>
							</div>
							<div class="form-row justify-content-center">
								<div class="col-12 col-md-6">
									<button type="submit" id="register-btn" class="btn btn-white btn-block">{{ __('Signup') }}</button>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<span> {{ __('Already has an account?') }}</span>
						<a href="{{ route('login') }}" data-target="#login-modal" data-toggle="modal" onclick="$('#register-modal').modal('hide');">{{ __('Login now!') }}</a>
					</div>
				</div>
			</div>
		</div>
		@endguest

		@auth
		@include('tutorial.create-modal')
		@endauth

		<!-- Search Modal -->
		<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="SearchModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content bg-transparent">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						إغلاق
					</button>
					<form action="/search" class="search-form" data-selector="search-form">
						<input type="search" name="q" placeholder="{{ __('What would you like to learn?')}}" 
							class="form-control" autocomplete="off" data-selector="search-input">
						<button class="btn" type="submit">
							<span class="material-icons">search</span>
						</button>
						<div class="search-results d-none" data-selector="search-results"></div>
					</form>
				</div>
			</div>
		</div>

	</div>
	
</body>

</html>