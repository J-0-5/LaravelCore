<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalTable extends Component
{
     /**
     * The ID Modal.
     *
     * @var number
     */
    public $idComponent;

    /**
     * The Title Modal.
     *
     * @var string
     */
    public $titleModal;

     /**
     * The Title Modal.
     *
     * @var string
     */
    public $classModal;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idComponent, $titleModal, $classModal)
    {
        $this->idComponent = $idComponent;
        $this->titleModal = $titleModal;
        $this->classModal = $classModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-table');
    }
}
