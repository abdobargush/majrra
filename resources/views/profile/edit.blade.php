@extends('layouts.app')
@section('title',  __('Account settings'))

@section('content')
<header class="before-content">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h3 class="mb-3">{{ __('Account settings') }}</h3>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container">
	<div class="row">

		<div class="col-md-3">
			<div class="list-group">
				<a href="#profile-info" 
					class="list-group-item list-group-item-action 
						@unless ( 
								session('passwordUpdated') || 
								session('settingsUpdated')  ||
								$errors->has('email') || $errors->has('password') || $errors->has('old_password')
							) 
							active 
						@endunless
					"
					id="profile-info-tab" data-toggle="pill" role="tab" aria-controls="profile-info" aria-selected="true">
					<i class="material-icons text-icon">person_outline</i>
					{{ __('Profile Info') }}
				</a>
				<a href="#profile-settings" class="list-group-item list-group-item-action @if (session('settingsUpdated') || $errors->has('email')) active @endif" id="profile-settings-tab" data-toggle="pill" role="tab" aria-controls="profile-settings" aria-selected="true">
					<i class="material-icons text-icon">settings</i>
					{{ __('Account settings') }}
				</a>
				<a href="#profile-password" class="list-group-item list-group-item-action @if (session('passwordUpdated') || $errors->has('old_password', 'password')) active @endif" id="profile-password-tab" data-toggle="pill" role="tab" aria-controls="profile-password" aria-selected="true">
					<i class="material-icons text-icon">lock_outline</i>
					{{ __('Password') }}
				</a>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">

				<div class="card-body">

					<div class="tab-content" id="profile-tabContent">
						
						<div 
							class="tab-pane fade show 
								@unless ( 
										session('passwordUpdated') || 
										session('settingsUpdated')  ||
										$errors->has('email') || $errors->has('password') || $errors->has('old_password')
									) 
									active 
								@endunless
							" 
							id="profile-info" role="tabpanel" aria-labelledby="profile-info-tab">

							<form method="POST" action="{{ route('profile.updateInfo', auth()->id()) }}">
								@csrf
								@method('PATCH')

								@if (session('infoUpdated'))
									<div class="alert alert-success" role="alert">
										{{ __('Your profile was updated successfully.') }}
									</div>
								@endif

								<div class="form-group text-center">
									<a href="https://gravatar.com" target="_blank">
										<img src="{{ Auth::user()->profile->getAvatar(128) }}" class="rounded-circle" alt="{{ Auth::user()->profile->name }}">
									</a>
								</div>

								<div class="form-group">
									<label for="name">{{ __('Name') }}</label>

									<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->profile->name }}">

									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="link">{{ __('Link') }}</label>

									<input id="link" type="url" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') ?? Auth::user()->profile->link }}">

									@error('link')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="bio">{{ __('Bio') }}</label>
									<textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio">{{ old('bio') ?? Auth::user()->profile->bio }}</textarea>

									@error('bio')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-row justify-content-center">
									<div class="col-12 col-sm-4">
										<button type="submit" class="btn btn-primary btn-block">
											{{ __('Save') }}
										</button>
									</div>
								</div>

							</form>

						</div>

						<div class="tab-pane fade show @if (session('settingsUpdated') || $errors->has('email')) active @endif" id="profile-settings" role="tabpanel" aria-labelledby="profile-settings-tab">
							<form method="POST" action="{{ route('profile.updateSettings', auth()->id()) }}">
								@csrf
								@method('PATCH')

								@if (session('settingsUpdated'))
									<div class="alert alert-success" role="alert">
										{{ __('Your profile was updated successfully.') }}
									</div>
								@endif

								<div class="form-group">
									<label for="username">{{ __('Username') }}</label>
									<input id="username" class="form-control" name="username" value="{{ Auth::user()->username }}" disabled>
								</div>

								<div class="form-group">
									<label for="email">{{ __('Email Address') }}</label>
									<input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? Auth::user()->email }}" required>

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-row justify-content-center">
									<div class="col-12 col-sm-4">
										<button type="submit" class="btn btn-primary btn-block">
											{{ __('Save') }}
										</button>
									</div>
								</div>

							</form>
						</div>

						<div class="tab-pane fade show @if (session('passwordUpdated') || $errors->has('password') || $errors->has('old_password')) active @endif" id="profile-password" role="tabpanel" aria-labelledby="profile-password-tab">
							<form method="POST" action="{{ route('profile.updatePassword', auth()->id()) }}">
								@csrf
								@method('PATCH')

								@if (session('passwordUpdated'))
									<div class="alert alert-success" role="alert">
										{{ __('Your profile was updated successfully.') }}
									</div>
								@endif

								<div class="form-group">
									<label for="old-password">{{ __('Old Password') }}</label>
									<input name="old_password" id="old-password" type="password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password')}}" required>

									@error('old_password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="password">{{ __('New Password') }}</label>
									<input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" minlength="8" required>

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="password_confirmation">{{ __('Confirm Password') }}</label>
									<input name="password_confirmation" id="password-confirmation" type="password" class="form-control" data-rule-equalTo="#password" required>
								</div>

								<div class="text-center">
									<button type="submit" class="btn btn-primary">
										{{ __('Change Password') }}
									</button>
								</div>

							</form>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection