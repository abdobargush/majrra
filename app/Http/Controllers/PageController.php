<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Dispaly the page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Page $page)
    {
        return view('page', compact('page'));
    }
}
