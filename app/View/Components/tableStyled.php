<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tableStyled extends Component
{
    // /**
    //  * The rows.
    //  *
    //  * @var string
    //  */
    // public $rows;

    /**
     * The classTable.
     * @var string
     */
    public $classTable;

    // /**
    //  * The data.

    //  * @var array
    //  */
    // public $data;

    /**
     * Create a new component instance.
     * @param array $rows
     * @param string $classTable
     * @param array $data
     *
     * @return void
     */
    public function __construct($classTable)
    {
        $this->classTable = $classTable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tableStyled');
    }
}
