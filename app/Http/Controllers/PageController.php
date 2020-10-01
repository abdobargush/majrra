<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Dispaly the page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('page', compact('page'));
    }
}
