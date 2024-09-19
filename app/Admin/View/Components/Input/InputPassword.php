<?php

namespace App\Admin\View\Components\Input;

class InputPassword extends Input
{
    public $type = 'password';
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.password');
    }
}
