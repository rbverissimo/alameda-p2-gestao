<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchInput extends Component
{

    public $placeholder;

    /**
     * Esse atributo especifica qual o domínio
     * esse input mapeará ao receber os dados do back-end. 
     * 
     * @var string
     */
    public $dominio;

    public $labelText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder, $dominio, $labelText)
    {
        $this->placeholder = $placeholder;
        $this->dominio = $dominio;
        $this->labelText = $labelText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-input');
    }
}
