<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalComponent extends Component
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
     * The button submit Modal.
     *
     * @var string
     */
    public $buttonSubmit;
     /**
     * The route name used on form.
     *
     * @var string
     */
    public $routeName;
     /**
     * The send method of request form.
     *
     * @var string
     */
    public $method;
     /**
     * Validate if needs to show delete button on form.
     *
     * @var string
     */
    public $buttonDelete;
     /**
     * Método secundario para actualizar.
     *
     * @var string
     */
    public $secondaryMethod;

     /**
     * Método secundario para actualizar.
     *
     * @var string
     */
    public $classModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idComponent, $titleModal, $buttonSubmit, $routeName, $method, $buttonDelete, $secondaryMethod, $classModal)
    {
        $this->idComponent = $idComponent;
        $this->titleModal = $titleModal;
        $this->buttonSubmit = $buttonSubmit;
        $this->routeName = $routeName;
        $this->method = $method;
        $this->buttonDelete = $buttonDelete;
        $this->secondaryMethod = $secondaryMethod;
        $this->classModal = $classModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-component');
    }
}
