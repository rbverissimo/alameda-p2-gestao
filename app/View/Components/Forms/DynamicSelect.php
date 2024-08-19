<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class DynamicSelect extends Component
{

    public string $labelSelectText;
    public ?string $labelButtonText;
    public int $verificador;
    public string $patternName;
    public array $collection;
    public string $selectedValue;
    public ?string $deletarButtonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $labelSelectText, ?string $labelButtonText = '', int $verificador, 
        string $patternName, array $collection, string $selectedValue, ?string $deletarButtonText = 'Deletar')
    {
        $this->labelSelectText = $labelSelectText;
        $this->labelButtonText = $labelButtonText;
        $this->verificador = $verificador;
        $this->patternName = $patternName;
        $this->collection = $collection;
        $this->selectedValue = $selectedValue;
        $this->deletarButtonText = $deletarButtonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.dynamic-select');
    }
}
