<?php

namespace App\Admin\Http\Controllers;

use Illuminate\Http\Request;

class BaseSearchSelectController extends Controller
{

    protected $request;

    protected $instance;

    public function selectSearch(Request $request){

        $this->request = $request;

        $this->data();
        
        $this->selectResponse();
        
        return $this->instance;

    }

    protected function data(){
        $this->instance = $this->repository->searchAllLimit(
            $this->request->input('term', ''), 
            $this->request->except('term', '_type', 'q')
        );
    }

    protected function selectResponse(){
        $this->instance = [ 'results' => $this->instance];
    }

}
