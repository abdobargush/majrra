<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;

class BookmarkController extends Controller
{
    /**
	 * Instantiate a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
    }
    
    public function index()
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $bookmarks = $user->bookmarks()->paginate(10);

        return view('bookmarks', compact('bookmarks'));
    }

    public function update($tutorial)
    {
        if (! request()->ajax()) {
            abort(403, __('Unauthorized'));
        }

        /** @var \App\Models\User */
        $user = auth()->user();
        
        return response()->json( $user->bookmarks()->toggle($tutorial), 200 );
    }
}
