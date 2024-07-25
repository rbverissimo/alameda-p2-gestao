<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class CalculoContaCard extends Component
{

    public array $resultadoCalculo;
    public int $tamanhoColuna;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $resultadoCalculo, int $tamanhoColuna)
    {
        $this->resultadoCalculo = $resultadoCalculo;
        $this->tamanhoColuna = $tamanhoColuna;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.calculo-conta-card');
    }
}
