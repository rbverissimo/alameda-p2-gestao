<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{

    public string $patternName;
    public string $attrName;
    public ?mixed $dataInput;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $patternName, string $attrName, ?mixed $dataInput = null)
    {
        $this->patternName = $patternName;
        $this->attrName = $attrName;
        $this->dataInput = $dataInput;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
