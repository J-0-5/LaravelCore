<?php

namespace App\View\Components;

use Illuminate\View\Component;

class statCard extends Component
{
    public $tituloCard;
    public $cantidad;
    public $classCard;
    public $themeIcon;



    /**
     * Crear una nueva instancia de componente.

     * @return void
     */

    public function __construct($tituloCard, $cantidad, $classCard, $themeIcon)
    {
        $this->tituloCard = $tituloCard;
        $this->cantidad = $cantidad;
        $this->classCard = $classCard;
        $this->themeIcon = $themeIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stat-card');
    }
}
