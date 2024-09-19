<?php

namespace App\Admin\View\Components\Layout;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var array
     */
    public $type;
    /**
     * The alert title.
     *
     * @var string
     */
    public $title;
    /**
     * The alert position.
     *
     * @var string
     */
    public $position;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->type = ['success', 'error', 'warning', 'info'];
        $this->title = __('Thông báo');
        $this->position = __('top-right');
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.layouts.alert');
    }
}