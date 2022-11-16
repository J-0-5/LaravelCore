<?php

namespace App\Modules\DocManagementModule\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocManagementModuleController extends Controller
{
    protected $path = 'DocManagementModule.views.html.';

    public function index()
    {
        return view($this->path . 'index');
    }
}
