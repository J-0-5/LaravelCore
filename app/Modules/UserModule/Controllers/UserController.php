<?php

namespace App\Modules\UserModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\DocumentModule\Document;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\RoleModule\Role;
use App\Modules\UserModule\Controllers\UserTrait;
use App\Modules\UserModule\User;
use App\Modules\UserModule\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $path = 'UserModule.views.html.';

    protected $UserModel;
    protected $RoleModule;
    protected $Document;
    protected $ParameterValueModel;


    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->RoleModule = new Role();
        $this->Document = new Document();
        $this->ParameterValueModel = new ParameterValue();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->json_reply) {
            return $this->UserModel->getUsers($request);
        }
        $request->merge(['pagination' => 15]);
        $users = $this->UserModel->getUsers($request)['data'];

        return view($this->path . 'index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->merge(['reference' => 'gender']);
        $genders = $this->ParameterValueModel->getParameterValues($request)['data'];
        $roles = $this->RoleModule->getRoles()['data'];
        $request->merge(['reference' => 'user_document_types']);
        $user_document_types = $this->ParameterValueModel->getParameterValues($request)['data'];
        return view($this->path .  'create', compact('genders', 'roles', 'user_document_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response =  $this->UserModel->saveUser($request);
        if ($response['state'] == 200) {
            return redirect()->route('users.index')->with('success', $response['message']);
        }
        return redirect()->back()->withInput()->with('danger', $response['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = $this->RoleModule->getRoles()['data'];
        $user = $this->UserModel->showUser($id)['data'];
        return view($this->path .  'show', compact('roles', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $this->UserModel->showUser($id)['data'];
        $request->merge(['reference' => 'gender']);
        $genders = $this->ParameterValueModel->getParameterValues($request)['data'];
        $roles = $this->RoleModule->getRoles()['data'];
        $request->merge(['reference' => 'user_document_types']);
        $user_document_types = $this->ParameterValueModel->getParameterValues($request)['data'];

        return view($this->path .  'edit', compact('roles', 'user', 'genders', 'user_document_types'));
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
        $response =  $this->UserModel->updateUser($request, $id);
        if ($response['state'] != 200) {
            return redirect()->back()->withInput()->with('danger', $response['message']);
        }
        return redirect()->route('users.index')->with('success', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contractor = $this->UserModel->deleteUser($id);
        return $contractor;
    }

    public function getContractorDocuments($role)
    {
        $role = $this->RoleModule->getRole($role)['data'];
        $documents = [];
        $arr = json_decode($role->role_documents);
        if (is_array($arr)) {
            $documents = ParameterValue::whereIn('id',  $arr)->get();
        }
        return $documents;
    }

    public function updateOrCreateContractorDocuments($request, $contractor_id, $role)
    {
        $files = $this->getContractorDocuments($role);
        foreach ($files as $file) {
            $request->validate([
                $file->id => 'mimes:pdf,jpg,png,jpeg,PDF,JPG,PNG,JPEG',
            ]);
            if ($request->hasFile([$file->id])) {
                $file_document = $request->file([$file->id]);
                $saveFile = saveFile($file_document, '/contractors')['data'];

                $newRequest = new Request([
                    'associate_to' => 'users',
                    'associate_id' => $contractor_id,
                    'document_type' => $file->id,
                    'url' => $saveFile,
                    'description' => 'contractor document',
                    'creator_user_id' => Auth()->user()->id,
                ]);

                $doc = $this->Document->updateOrCreateDocument($newRequest);
            }
        }
    }
}
