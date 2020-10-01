@extends('layouts.app')
@section('title', __('Forgot Your Password?'))

@section('content')
<header>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h3 class="mb-3">{{ __('Forgot Your Password?') }}</h3>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-5">
	<div class="row justify-content-center">
		<div class="col-md-8 col-lg-6">
			<div class="card">

				<div class="card-body">
					@error('email')
						<div class="alert alert-danger" role="alert">
							{{ $message }}
						</div>
					@enderror

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<form method="POST" action="{{ route('password.email') }}">
						@csrf
						<p>{{ __('Please enter your email address and we will send you password reset link.') }}</p>
						<div class="form-group">
							<label for="email">{{ __('Email Address') }}</label>

							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="example@mail.com" required autocomplete="email" autofocus>
						</div>

						<div class="form-row justify-content-center">
							<button type="submit" class="btn btn-primary mx-auto">
								{{ __('Send') }}
							</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection
