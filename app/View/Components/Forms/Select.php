<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public string $display;
    public string $patternName;
    public string $labelText;
    public array $collection;
    public ?string $selectedValue;
    public ?string $verificador;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $display = 'block', string $patternName, string $labelText, 
        array $collection, ?string $selectedValue = null, ?string $verificador = null)
    {
        $this->display = $display;
        $this->patternName = $patternName;
        $this->labelText = $labelText;
        $this->collection = $collection;
        $this->selectedValue = $selectedValue;
        $this->verificador = $verificador;
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
