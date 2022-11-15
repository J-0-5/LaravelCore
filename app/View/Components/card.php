<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    /**
     * The quantity.
     *
     * @var number
     */
    public $quantity;

    /**
     * The titleCard.
     *
     * @var string
     */
    public $titleCard;

    /**
     * The classCard.
     *
     * @var string
     */
    public $classCard;

    /**
     * The textCard.
     *
     * @var string
     */
    public $textCard;

    /**
     * Create a new component instance.
     * @param number $quantity
     * @param string $titleCard
     * @param string $classCard
     * @param string $textCard
     *
     * @return void
     */


    public function __construct($quantity, $titleCard, $classCard, $textCard)
    {
        $this->quantity = $quantity;
        $this->titleCard = $titleCard;
        $this->classCard = $classCard;
        $this->textCard = $textCard;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
