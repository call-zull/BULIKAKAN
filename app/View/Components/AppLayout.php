<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public string $title;

    public function __construct($title = 'Bulikakan')
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.app-layout');
    }
}
