<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;

class TutorialController extends Controller
{

	/**
	 * Instantiate a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth')->except('show');
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Tutorial  $tutorial
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tutorial $tutorial)
	{
		return view('tutorial.show', compact('tutorial'));
	}


	/**
	 * Toggle upvote
	 *
	 * @param \App\Models\Tutorial  $tutorial
	 * @return \Illuminate\Http\Response
	 */
	public function upvote(Tutorial $tutorial)
	{
		if (! request()->ajax()) {
            abort(403, __('Unauthorized'));
        }

        /** @var \App\Models\User */
        $user = auth()->user();
		
        return response()->json( $user->upvoted()->toggle($tutorial), 200 );
	}


}
