<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputInfo extends Component
{

    public string $patternName;
    public string $attrName;
    public ?int $verificador;
    public ?string $dataInput;
    public string $infoButtonText;
    public string $deletarButtonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $patternName, string $attrName, ?int $verificador = null, ?string $dataInput = null, 
        string $infoButtonText = 'Info', string $deletarButtonText = 'Deletar')
    {
        $this->patternName = $patternName;
        $this->attrName = $attrName;
        $this->verificador = $verificador;
        $this->dataInput = $dataInput;
        $this->infoButtonText = $infoButtonText;
        $this->deletarButtonText = $deletarButtonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-info');
    }
}
