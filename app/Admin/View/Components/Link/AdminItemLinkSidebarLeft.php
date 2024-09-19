<?php

namespace App\Admin\View\Components\Link;

use Illuminate\View\Component;

class AdminItemLinkSidebarLeft extends Component
{
    public $dropdown;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dropdown = false)
    {
        //
        $this->dropdown = $dropdown;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link.admin-item-sidebar-left');
    }
}