<?php

namespace App\Modules\RoleModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RoleModule\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [Rule::unique('roles')->whereNull('deleted_at'), 'required'],
        ]);
        try {
            Role::create([
                'name' => $request->name,
                'state' => 1
            ]);
            return redirect()->back()->with('success', 'Rol creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = Role::find($id);
            return json_encode(['state' => 200,'data' =>$role]);
        } catch (\Exception $e) {
            return json_encode(['state' => 500,'error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => [Rule::unique('roles')->ignore($id)->whereNull('deleted_at'), 'nullable'],
            'state' => 'nullable'
        ]);
        try {
            $role = Role::find($id);
            if(is_null($role)){
                return redirect()->back()->withInput()->with('danger','No se encontró el rol');
            }

            $role->update([
                'name' => $request->name ?? $role->name,
                'state' =>$request->state ?? $role->state,
                'role_documents'=> json_encode($request->documents)
            ]);
            return redirect()->back()->with('success', 'Rol actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);
            if(is_null($role)){
                return redirect()->back()->withInput()->with('danger','No se encontró el rol');
            }
            $role->delete();
            return redirect()->back()->with('success', 'Rol eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('danger', $e->getMessage());
        }
    }
}
