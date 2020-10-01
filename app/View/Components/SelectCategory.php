<?php

namespace App\View\Components;

use App\Models\Tool;
use Illuminate\View\Component;

class SelectCategory extends Component
{
    /**
	 * The categories list
	 *
	 * @var mixed
	 */
    public $categoriesList;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoriesList = Tool::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-category');
    }
}
