<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public string $display;
    public string $patternName;
    public ?string $classes;
    public string $labelText;
    public array $collection;
    public ?string $selectedValue;
    public ?string $verificador;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $display = 'block', string $patternName, ?string $classes = null, string $labelText = '', 
        array $collection, ?string $selectedValue = null, ?string $verificador = null, bool $required = false)
    {
        $this->display = $display;
        $this->patternName = $patternName;
        $this->classes = $classes;
        $this->labelText = $labelText;
        $this->collection = $collection;
        $this->selectedValue = $selectedValue;
        $this->verificador = $verificador;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
