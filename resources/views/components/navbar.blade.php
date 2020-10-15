<nav class="navbar navbar-expand">

	<a class="navbar-brand" href="/">{{ __('Majrra') }}</a>

	<ul class="navbar-nav d-none d-md-block">
		<li class="nav-item active">
			<a class="nav-link" href="{{ route('tools.index') }}">تصفح التقنيات<span class="sr-only">(current)</span></a>
		</li>
	</ul>

	<ul class="navbar-nav mr-auto align-items-center">

		<li class="nav-item">
			<a class="nav-link" href="#search-modal" data-toggle="modal">
				<i class="material-icons text-icon">search</i>
				<span class="d-none d-md-inline-block">{{ __('Search') }}</span>
			</a>
		</li>

		@guest
		<li class="nav-item">
			<a class="nav-link" href="{{ route('register') }}" data-target="#register-modal" data-toggle="modal">
				<i class="material-icons text-icon">person_outline</i>
				<span class="d-none d-md-inline-block">{{ __('Register / Login') }}</span>
			</a>
		</li>
		@endguest

		@auth
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="{{ $profile->getAvatar(32) }}" class="rounded-circle ml-1" alt="{{ $user->username }}">

				<span class="d-none d-md-inline-block">
				@isset( $profile->name )
					{{ $profile->name }}
				@else
					{{ $user->username }}
				@endisset
				</span>
				
			</a>
			<div class="dropdown-menu text-right" aria-labelledby="navbarDropdown">

				@if ($user->is_admin)
				<a class="dropdown-item" href="/admin">
					<i class="material-icons text-icon">admin_panel_settings</i>
					{{ __('Admin Panel') }}
				</a>
				<div class="dropdown-divider"></div>
				@endif

				<a class="dropdown-item" href="{{ route('profile', $user->username) }}">
					<i class="material-icons text-icon">person_outline</i>
					الملف الشخصي
				</a>
				<a class="dropdown-item" href="{{ route('bookmarks') }}">
					<i class="material-icons text-icon">bookmark_outline</i>
					المحفوظات
				</a>
				<a class="dropdown-item" href="{{ route('profile.edit') }}">
					<i class="material-icons text-icon">settings</i>
					إعدادات الحساب
				</a>
				<div class="dropdown-divider"></div>
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button class="dropdown-item" style="outline: none!important">
						<i class="material-icons text-icon">power_settings_new</i>
						تسجيل الخروج
					</button>
				</form>
			</div>
		</li>
		@endauth
		
		<li class="nav-item">
			<a class="nav-link navbar-btn" 
				href="@guest {{ route('login') }} @else # @endguest" 
				data-target="@guest #login-modal @else #submit-modal @endguest" data-toggle="modal">
				<i class="material-icons text-icon">add</i>
				<span class="d-none d-md-inline-block">{{ __('Submit a tutorial') }}</span>
			</a>
		</li>

	</ul>

</nav>