<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GameLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public $view = 'menu';

    public function render(): View
    {
        return view('layouts.game');
    }
}
