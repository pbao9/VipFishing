<?php

namespace App\Admin\View\Components\Input;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InputPickAddress extends Input
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
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.input.pick-address');
    }
}
