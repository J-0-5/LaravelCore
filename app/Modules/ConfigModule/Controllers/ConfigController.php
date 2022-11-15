<?php

namespace App\Modules\ConfigModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    protected $path = 'ConfigModule.views.html.';

    public function respond($state, $data = [], $error = null, $message = '')
    {
        return [
            'state' => $state, //response status
            'data' => $data, //response data
            'error' => $error, //bug for developer
            'message' => $message //user message
        ];
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $falcult = Parameter::where('reference', 'faculty')->first();
        $dat = ParameterValue::where('parameter_id', $falcult->id)->get();
        $programs = Parameter::where('reference', 'program')->first();
        // $parm = ParameterValue::where('parameter_id', $programs->id)->first();
        $parm_id = $programs->id;
        $fac = $falcult->id;



        $faculties = ParameterValue::where('parameter_id', getFacultieParameterID())->get();
        $inv_line = ParameterValue::where('parameter_id', getInvLineParameterID())->with('parent')
                    ->whereNull('deleted_at')->get();
        // $prog = ParameterValue::where('parameter_id', $programs->id)->get();

        // dd($dat);
        return view($this->path . 'index', compact('dat', 'parm_id', 'faculties', 'inv_line', 'fac'));
    }

    // public function getFaculty()
    // {
    //     try {
    //         $falcult = Parameter::where('reference', 'faculty')->first();
    //         $dat = ParameterValue::where('parameter_id', $falcult->id)->get();
    //         return $this->respond(200, $dat, null, 'Listado de Facultades');
    //     } catch (\Throwable $e) {
    //         return $this->respond(500, [], $e->getMessage(), 'Ha ocurrido un error de servidor');
    //     }
    // }

    public function getPrograms($id)
    {
        try {
            $prog = ParameterValue::where('parent_id', $id)->get();
            return $this->respond(200, $prog, null, 'Listado de Programas');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage(), 'Ha ocurrido un error de servidor');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    }
}
