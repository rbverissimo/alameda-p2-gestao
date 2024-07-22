<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    /**
     * O nome do input dado pelo atributo
     * @var string
     */
    public $attName;

    /**
     * O ID do input
     * @var string
     */
    public $id;

    /**
     * @var bool
     */
    public $checked;


    /**
     * Create a new component instance.
     *
     * @param string $attName, o nome do atributo
     * @param bool $isChecked, o estado do switch
     * @return void
     */
    public function __construct($attName, $id, $checked = false)
    {
        $this->attName = $attName;
        $this->id = $id;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle-switch');
    }

    public function isChecked(): bool {
        return $this->checked;
    }
}
