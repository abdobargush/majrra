<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-logo"><a href="">{{ __( config('app.name') ) }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('submittedtutorial') }}'><i class='nav-icon la la-question'></i>{{ __('Submitted Tutorials') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tutorial') }}'><i class='nav-icon la la-graduation-cap'></i>{{ __('Published Tutorials') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tool') }}'><i class='nav-icon la la-toolbox'></i>{{ __('Tools') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i>{{ __('Users') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-alt'></i>{{ __('Pages') }}</a></li>