@extends('layouts.app')
@section('title', __('Reset Your Password'))

@section('content')
<header>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h3 class="mb-3">{{ __('Reset Your Password') }}</h3>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-5">
	<div class="row justify-content-center">
		<div class="col-md-8 col-lg-6">
			<div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                minlength="6" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
                                minlength="6" required autocomplete="new-password">
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="col col-md-8">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

			</div>
		</div>
	</div>
</div>
@endsection
