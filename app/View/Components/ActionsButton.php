<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionsButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $detailRoute = 'home',
        public $editRoute = 'home',
        public $deleteRoute = 'home',
        public $complete = false,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.actions-button');
    }
}
