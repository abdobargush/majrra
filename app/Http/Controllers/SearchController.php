<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Search Tools
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filteredTools = Tool::where('title', 'like', '%' . $request['q'] . '%')->limit(5)->get();
        return response()->json($filteredTools);
    }

}
