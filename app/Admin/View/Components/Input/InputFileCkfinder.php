<?php

namespace App\Admin\View\Components\Input;

class InputFileCkfinder extends Input
{
    public $value;

    public $showFile;

    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type = 'text', $value = '', $required = false)
    {
        //
        parent::__construct($type, $required);
        $this->name = $name;
        $this->value = $value ? asset($value) : '';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.file');
    }
}
