<?php

namespace App\Admin\View\Components\Select;

use Illuminate\View\Component;

class Option extends Component
{
    public $value;
    public $title;
    public $option;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $value = '', $option = null)
    {
        //
        $this->value = $value;
        $this->title = $title;
        $this->option = $option;
    }
    public function isSelected($option){
        if(gettype($option) == 'array'){
            return in_array($this->value, $option) ? 'selected' : '';
        }
        return $this->value === $option ? 'selected' : '';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select.option');
    }
}
