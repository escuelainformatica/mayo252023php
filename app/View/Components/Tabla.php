<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabla extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $valores=[])
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $campos=array_keys(reset($this->valores));
        return view('components.tabla',['campos'=>$campos]);
    }
}
