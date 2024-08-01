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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $headerText, ?string $buttonText = 'Adicionar', ?string $labelText = null, 
        string $patternName, ?array $collection = null, ?string $deletarText = 'Deletar')
    {
        $this->headerText = $headerText;
        $this->buttonText = $buttonText;
        $this->labelText = $labelText;
        $this->patternName = $patternName;
        $this->collection = $collection;
        $this->deletarText = $deletarText;
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
