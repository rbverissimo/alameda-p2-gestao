<?php

namespace App\View\Components\Forms;

use App\ValueObjects\EnderecoVO;
use Illuminate\View\Component;

class DadosEndereco extends Component
{


    public string $tituloHeader;
    public EnderecoVO $model; 

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tituloHeader = 'Dados do endereço: ', EnderecoVO $model)
    {
        $this->tituloHeader = $tituloHeader;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.dados-endereco');
    }
}
