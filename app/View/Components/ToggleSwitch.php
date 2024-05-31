<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    /**
     * O nome do atributo do Input
     * @var string
     */
    public $attName;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attName)
    {
        $this->attName = $attName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle-switch');
    }
}
