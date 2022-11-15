<?php

namespace App\Modules\ModuleModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ModuleModule\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    protected $path = 'ModuleModule.views.html.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modules = Module::get();
        return view($this->path . 'home', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
}
