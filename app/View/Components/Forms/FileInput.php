<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class FileInput extends Component
{

    public string $labelText;
    public ?string $file;
    public string $attrName;
    public string $downloadRoute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $labelText, ?string $file = null, string $attrName, string $downloadRoute)
    {
        $this->labelText = $labelText;
        $this->file = $file;
        $this->attrName = $attrName;
        $this->downloadRoute = $downloadRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.file-input');
    }
}
