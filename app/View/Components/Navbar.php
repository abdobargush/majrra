<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
	/**
	 * The auth user
	 *
	 * @var mixed
	 */
	public $user;

	/**
	 * The user's profile
	 *
	 * @var mixed
	 */
	public $profile;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->user = Auth::user();
		$this->profile = $this->user->profile ?? null;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.navbar');
	}
}
