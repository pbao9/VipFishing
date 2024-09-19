<?php

namespace App\Admin\View\Components\Input;

use Illuminate\View\Component;

class Input extends Component
{
    public $required;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'text', $required = false)
    {
        //
        $this->required = $required;
        $this->type = $type;
    }
    public function isRequired(){
        return $this->required === true ? [
            'required' => true, 
            'data-parsley-required-message' => __('Trường này không được bỏ trống.')
        ] : [];
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
