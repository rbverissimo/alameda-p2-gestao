<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModalPicker extends Component
{

    public string $headerText;
    public array $columnsNames;
    public string $patternName;
    public ?array $collection;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $headerText, array $columnsNames, string $patternName, ?array $collection)
    {
        $this->headerText = $headerText;
        $this->columnsNames = $columnsNames;
        $this->patternName = $patternName;
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modal-picker');
    }
}
