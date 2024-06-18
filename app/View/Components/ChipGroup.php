<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChipGroup extends Component
{

    /**
     * O nome do input
     * 
     * @var string
     */
    public $name;

    /**
     * As informações que serão renderizadas nos chips
     * @var array
     */
    public $chips;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $chips)
    {
        $this->name = $name;
        $this->chips = $chips;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {  
        return view('components.chip-group');
    }
}
