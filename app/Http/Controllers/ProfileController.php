<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{


	/**
	 * Show user's profile
	 *
	 * @param string $username
	 * @return \Illuminate\Http\Response
	 */
	public function show($username)
	{
		// Get user
		$user = User::where('username', $username)->with(['profile'])->firstOrFail();

		// Get user's profile
		$profile = $user->profile;
		$profile->username = $username;

		// Get tutorials added by the user
		$addedTutorials = $user->tutorials()->without(['addedBy', 'addedBy.profile'])->get();
		foreach ($addedTutorials as $tutorial) {
			$tutorial->addedBy = $user;
		}

		// Get tutorials upvoted by the user
		$upvotedTutorials = $user->upvoted()->get();

		// return response()->json($addedTutorials);
		return view('profile/show', compact('profile', 'addedTutorials', 'upvotedTutorials'));
	}


	/**
	 *  Show edit form
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		return view('profile/edit');
	}


	/**
	 * Update user's profile info
	 *
	 * @param User $user
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function updateInfo(User $user, Request $request)
	{

		// Check if the logged user owns the resource
		if (auth()->id() != $user->id) {
			abort(403, __('Unauthorized'));
		}

		// Validate request data
		$validated = $request->validate([
			'name' => 'nullable|string|max:255',
			'link' => 'nullable|url|max:255',
			'bio' => 'nullable|string|max:255',
		]);

		// Update profile info
		$user->profile->update($validated);

		// Redirect back with success message
		return back()->with('infoUpdated', 'Profile updated successfully!');
	}


	/**
	 * Update user's account settings
	 *
	 * @param User $user
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function updateSettings(User $user, Request $request)
	{

		// Check if the logged user owns the resource
		if (auth()->id() != $user->id) {
			abort(403, __('Unauthorized'));
		}

		// Validate request datat
		$validated = $request->validate([
			'email' => 'required|email|max:255|unique:users,email,' . $user->id,
		]);

		// Save the new email
		$user->email = $validated['email'];
		$user->save();

		// Regenerate avatar
		$user->profile->update(['avatar' => $user->gravatar()]);

		// Redirect back with success message
		return back()->with('settingsUpdated', 'Account settings updated successfully!');
	}


	/**
	 * Update user's password
	 *
	 * @param User $user
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function updatePassword(User $user, Request $request)
	{

		// Check if the logged user owns the resource
		if (auth()->id() != $user->id) {
			abort(403, __('Unauthorized'));
		}

		// Validate request data
		$validated = $request->validate([
			'old_password' => [
				'required', 
				function($attribute, $value, $fail) {
					// Check if old passwod is wrong
					if (! Hash::check($value, auth()->user()->password) ) {
						return $fail( __('Old password is wrong!') );
					}
				}
			],
			'password' => 'required|min:6|confirmed',
		]);

		// Hash and save the new password
		$user->password = Hash::make($validated['password']);
		$user->save();

		// Redirect back with success message
		return back()->with('passwordUpdated', 'Password updated successfully!');
	}


}
