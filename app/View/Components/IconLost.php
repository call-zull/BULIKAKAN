<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconLost extends Component
{
    /**
     * Create a new component instance.
     */
    // public string $color;

    public function __construct(string $color = '#4682B4')
    {
        // $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon-lost');
    }
}
