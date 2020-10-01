<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TutorialsList extends Component
{
    /**
     * Tutorials list
     *
     * @var array
     */
    public $tutorials;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tutorials)
    {
        $this->tutorials = $tutorials;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tutorials-list');
    }
}
