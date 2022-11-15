<?php

namespace App\Modules\UserModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\UserModule\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\UserModule\UserModel;

class ProfileController extends Controller
{
    use ProfileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $path = 'UserModule.views.html.profile.';

    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $response = $this->user->showUser(Auth::user()->id);
        $user = $response['data'];
        return view($this->path . 'index', compact('user'));
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
        $response = $this->user->updateUser($request, $id);
        if ($response['state'] == 200) {
            return redirect()->route('profile.index')->with('success', $response['message']);
        }
        return redirect()->back()->withInput()->with('danger', $response['message']);
    }

    public function updatePassword(Request $request, $id)
    {
        $response = $this->user->updatePassword($request, $id);
        if ($response['state'] == 200) {
            return redirect()->route('profile.index')->with('success', $response['message']);
        }
        return redirect()->back()->withInput()->with('danger', $response['message']);
    }

    public function updatePhoto(Request $request, $id)
    {
        $response = $this->user->updatePhoto($request, $id);
        if ($response['state'] == 200) {
            return redirect()->route('profile.index')->with('success', $response['message']);
        }
        return redirect()->back()->withInput()->with('danger', $response['message']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test()
    {
        return UserModel::getHotbedResearchAll();
    }
}
