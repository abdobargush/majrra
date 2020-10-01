<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        // Get tools list
        $tools = Tool::withCount('tutorials')
                    ->orderByDesc('tutorials_count')->limit(12)->get();
        
        // Get random tools as most searched
        $mostSearched = Tool::get();
        if (! $mostSearched->isEmpty() && $mostSearched->count() >= 5) {
            $mostSearched = $mostSearched->random(5);
        }

        return view('home', compact('tools', 'mostSearched'));
    }
    
}
