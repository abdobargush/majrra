<?php

namespace App\Http\Controllers;

use App\Models\SubmittedTutorial;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use App\Notifications\TutorialSubmitted as TutorialSubmittedNotification;

class SubmittedTutorialController extends Controller
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutorial.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Accept only ajax request
        if (! $request->ajax()) abort(404);

        $validated = $request->validate([
			'title' => 'nullable|string',
            'url' => 'required|url',
            'tools' => 'array',
            'filters' => 'array'
        ]);
        
        // Add the user id to the array
		$validated['added_by'] = auth()->id();
        
        // Create the tutorial in the db
        SubmittedTutorial::create($validated);

        // send ajax response
        response()->json(
            ['message' => __('Thank you! We have recieved your submission and will inform you when it\'s published.')
        ])->send();

        // Notify the user
        /** @var App\Models\User */
        $user = auth()->user();
        return $user->notify( new TutorialSubmittedNotification($user) );
    }

    
    /**
	 * Check if tutorial can be submitted
	 *
	 * @param Request $request
	 * @return bool
	 */
	public function check(Request $request)
	{
        // Check published Tutorials
        $tutorial = Tutorial::where('url', $request->input('url'))->first();

        // Check submitted but not published tutorials
        $submittedTutorial = SubmittedTutorial::where('url', $request->input('url'))->first();

        // return true if the tutorial not found and can be submitted
		return response()->json( $tutorial || $submittedTutorial ? false : true );
	}

}
