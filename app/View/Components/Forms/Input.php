<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{

    public ?string $labelText;
    public ?string $placeholder;
    public string $patternName;
    public string $attrName;
    public ?string $classes;
    public ?string $dataInput;
    public bool $required; 
    public bool $readonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $labelText = null, ?string $placeholder = null,
         string $patternName, string $attrName, ?string $classes = null, ?string $dataInput = null, bool $required = true, bool $readonly = false)
    {
        $this->labelText = $labelText;
        $this->placeholder = $placeholder;
        $this->patternName = $patternName;
        $this->attrName = $attrName;
        $this->classes = $classes;
        $this->dataInput = $dataInput;
        $this->required = $required;
        $this->readonly = $readonly;
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
