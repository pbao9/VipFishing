<?php

namespace App\Admin\Http\Controllers;

use App\Admin\Support\Breadcrumb\Breadcrumb;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Mảng chứa đường dẫn tới views
     *
     * @var array
     */
    protected $view;
    /**
     * Mảng chứa tên route
     *
     * @var array
     */
    protected $route;

    protected Breadcrumb $crums;

    public function __construct(){

        $this->setView();

        $this->setRoute();

        $this->crums = (new Breadcrumb())->add(__('Dashboard'), route('admin.dashboard'));
    }

    public function getView(){
        return $this->view ?? [];
    }

    public function setView(){
        $this->view = $this->getView();
    }

    public function getRoute(){
        return $this->route ?? [];
    }

    public function setRoute(){
        $this->route = $this->getRoute();
    }
}
