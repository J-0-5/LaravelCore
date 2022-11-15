<?php

namespace App\View\Components;

use Illuminate\View\Component;

class report extends Component
{
    /**
     * The titleCard.
     *
     * @var string
     */
    public $tituloCardTi;
    public $tituloCardCd;
    public $tituloCardFiltros;
    public $tituloCardFa;


    /**
     * Create a new component instance.
     * @param string $tituloCardTi
     * @param string $tituloCardCd
     * @param string $tituloCardFiltros
     * @param string $tituloCardFa

     *
     * @return void
     */
    public function __construct($tituloCardTi, $tituloCardCd, $tituloCardFiltros, $tituloCardFa)
    {
        $this->tituloCardTi = $tituloCardTi;
        $this->tituloCardCd = $tituloCardCd;
        $this->tituloCardFiltros = $tituloCardFiltros;
        $this->tituloCardFa = $tituloCardFa;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.report');
    }
}
