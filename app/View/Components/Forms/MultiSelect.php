<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class MultiSelect extends Component
{

    public string $headerText; 
    public ?string $buttonText;
    public ?string $labelText;
    public string $patternName;
    public ?array $collection;
    public ?string $deletarText;
    public ?array $columns_division;
    public string $mode;  // INPUT, INPUT-SELECT, SELECTION
    public ?string $inputAttrName;
    public ?string $inputLabelText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $headerText, ?string $buttonText = 'Adicionar', ?string $labelText = null, 
        string $patternName, ?array $collection = null, ?string $deletarText = 'Deletar', ?string $inputAttrName, ?string $inputLabelText = null,  
        ?array $columns_division = [5, 5, 2], string $mode = 'INPUT-SELECT')
    {
        $this->headerText = $headerText;
        $this->buttonText = $buttonText;
        $this->labelText = $labelText;
        $this->patternName = $patternName;
        $this->inputAttrName = $inputAttrName;
        $this->inputLabelText = $inputLabelText;
        $this->collection = $collection;
        $this->deletarText = $deletarText;
        $this->columns_division = $columns_division;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.multi-select');
    }
}
