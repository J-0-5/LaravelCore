<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemMap extends Component
{

    public $time;
    public $description;
    public $date;
    public $status;
    public $typeDecision;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($time, $description, $date, $status, $typeDecision)
    {
        $this->time = $time;
        $this->description = $description;
        $this->date = $date;
        $this->status = $status;
        $this->typeDecision = $typeDecision;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-map');
    }
}
