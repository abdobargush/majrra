<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$tools = Tool::withCount('tutorials')->orderByDesc('tutorials_count')->paginate(18);

		return view('tools/index', compact('tools'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Tool  $tool
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tool $tool)
	{
		// Get tutorials
		$tutorials = $tool->tutorials();

		// Apply filters
		$filtersList = ['price', 'difficulty', 'type'];

		foreach ($filtersList as $filter) {
			if ( request()->has($filter) ) {
				$tutorials->whereJsonContains("filters->$filter", request()->query($filter));
			}
		}

		$tutorials = $tutorials->paginate(10);

		// Add count to tool
		$tool->sourcesCount = $tutorials->count();

		// Get random tools as most searched
        $suggestedTools = Tool::withCount('tutorials')->get();
        if (! $suggestedTools->isEmpty() && $suggestedTools->count() >= 6) {
            $suggestedTools = $suggestedTools->random(6);
        }
		
		return view('tools/show', compact('tool', 'tutorials', 'suggestedTools'));
	}

}
