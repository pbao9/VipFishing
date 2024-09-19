<?php

namespace App\Admin\View\Components\Input;

class InputPickAddressUser extends Input
{

    public $name;

    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $required = false)
    {
        //
        parent::__construct('text', $required);
        $this->name = $name;
        $this->label = $label;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.pick-address-user');
    }
}
