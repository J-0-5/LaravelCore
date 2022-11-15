<?php

namespace App\Modules\DocumentModule\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RestActions;
use App\Modules\DocumentModule\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    use RestActions;

    protected $DocumentModel;

    public function __construct()
    {
        $this->DocumentModel = new Document();
    }

    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $path = $request->path ?? "/";
        $response = saveFile($file, $path);
        if ($response['state'] != 200) {
            return json_encode($response);
        }
        $url = Storage::disk('s3')->url($response['data']);
        $request->merge(['url' => $url]);
        $saveDocumentResponse = $this->DocumentModel->saveDocument($request);
        return $saveDocumentResponse;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $getDocumentResponse = $this->DocumentModel->getDocument($id);
            return $getDocumentResponse;
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al descargar documento');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
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
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $deleteDocumentResponse = $this->DocumentModel->deleteDocument($id);
            if ($deleteDocumentResponse['state'] != 200) {
                return $deleteDocumentResponse;
            }
            $document = $deleteDocumentResponse['data'];
            $url = str_replace("https://proyectos-desarrollo.s3.us-east-2.amazonaws.com/UABYSDesarrollo/", "", $document->url);
            $response = deleteFile($url);
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar documento');
        }
    }

    public function download($id)
    {
        try {
            $getDocumentResponse = $this->DocumentModel->getDocument($id);
            if ($getDocumentResponse['state'] != 200) {
                return $getDocumentResponse;
            }
            $document = $getDocumentResponse['data'];
            $url = str_replace("https://proyectos-desarrollo.s3.us-east-2.amazonaws.com/UABYSDesarrollo/", "", $document->url);
            return Storage::disk('s3')->download($url);
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al descargar documento');
        }
    }
}
