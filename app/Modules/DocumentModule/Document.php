<?php

namespace App\Modules\DocumentModule;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\ApplicationModule\Application;
use App\Modules\ContractModule\Contract;
use App\Modules\DocumentModule\CertificatesPerMonthView;
use App\Modules\DocumentLogModule\DocumentLog;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Document extends Model
{
    use SoftDeletes, RestActions;

    protected $table = 'documents';
    protected $primaryKey = 'id';

    protected $fillable = [
        'associate_to',
        'associate_id',
        'document_type',
        'url',
        'description',
        'data',
        'creator_user_id',
    ];

    /* Accessors Config */
    public function getUrlAttribute($value)
    {
        $url = $value;
        if (!is_null($value) && !preg_match('/(https?:\/\/.*\.)/i', $value)) {
            $url = Storage::disk('s3')->url($value);
            // $url = str_replace('//', '/', $url);
        }
        return $url;
    }

    public function getDataAttribute($value)
    {
        if (!is_null($value))
            return json_decode($value);
    }
    /* End Accessors Config */

    public function getCertificatesPerMonths()
    {
        return CertificatesPerMonthView::all();
    }

    /* Relationships Config */
    public function getAssociate()
    {
        $classes = [
            'users' => User::class,
            'applications' => Application::class,
            'contracts' => Contract::class,
        ];

        $class = $classes[$this->associate_to];
        return $this->belongsTo($class, 'associate_id');
    }
    public function getDocumentType()
    {
        return $this->belongsTo(ParameterValue::class, 'document_type');
    }
    public function getCreatorUser()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
    public function getDocumentLogs()
    {
        return $this->hasMany(DocumentLog::class, 'document_id');
    }
    /*End Relationships config */

    /* Scopes Config */
    public function scopeWhereAssociate($query, $value)
    {
        if (!is_null($value))
            $query->where('associate_to', $value);
    }
    public function scopeWhereAssociateId($query, $value)
    {
        if (!is_null($value))
            $query->where('associate_id', $value);
    }
    public function scopeWhereDocumentType($query, $value)
    {
        if (!is_null($value))
            $query->where('document_type', $value);
    }
    public function scopeWhereDocumentTypeName($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getDocumentType', function ($query) use ($value) {
                $query->where('name', $value);
            });
    }
    public function scopeWhereDescription($query, $value)
    {
        if (!is_null($value)) {
            $query->where('description', $value);
        };
    }
    public function scopeWhereCreatorUserId($query, $value)
    {
        if (!is_null($value)) {
            $query->where('creator_user_id', $value);
        };
    }
    public function scopeWhereCreatorUserName($query, $value)
    {
        if (!is_null($value)) {
            $query->whereHas('getCreatorUser', function ($query) use ($value) {
                $query->where('name', $value);
            });
        }
    }
    public function scopeWhereActive($query, $value)
    {
        if (!is_null($value))
            $query->where('active', $value);
    }
    /*End Scopes Config */

    public function getDocument($id)
    {
        try {
            $document = $this::where('id', $id)->first();
            return $this->respond(200, $document, null, 'Documento encontrado');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage());
        }
    }

    public function getDocuments($request)
    {
        try {
            if (!is_null($request->pagination)) {
                $documents = $this::whereAssociate($request->associate_to)
                    ->whereAssociateId($request->associate_id)
                    ->whereDocumentType($request->document_type)
                    ->whereDescription($request->description)
                    ->whereCreatorUserId($request->creator_user_id)
                    ->whereCreatorUserName($request->creator_user_name)
                    ->whereActive($request->active)
                    ->paginate($request->pagination ?? 15);
            } else {
                $documents = $this::whereAssociate($request->associate_to)
                    ->whereAssociateId($request->associate_id)
                    ->whereDocumentType($request->document_type)
                    ->whereDescription($request->description)
                    ->whereCreatorUserId($request->creator_user_id)
                    ->whereCreatorUserName($request->creator_user_name)
                    ->whereActive($request->active)
                    ->get();
            }
            return $this->respond(200, $documents);
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage());
        }
    }

    public function validateDocument($request, $action = null, $id = null)
    {
        return Validator::make(
            $request->all(),
            [
                'associate_to' => ['nullable', 'string'],
                'associate_id' => ['nullable', 'numeric'],
                'document_type' => ['nullable', 'exists:parameter_values,id'],
                'url' => [Rule::requiredIf($action == 'create'), 'string'],
                'description' => 'nullable|string',
                'data' => 'nullable',
                'creator_user_id' => ['nullable', 'exists:users,id'],
            ]
        );
    }

    public function saveDocument($request)
    {
        $validator = $this->validateDocument($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $document = $this::create([
                'associate_to' => $request->associate_to,
                'associate_id' => $request->associate_id,
                'document_type' => $request->document_type,
                'url' => $request->url,
                'description' => $request->description,
                'data' => json_encode($request->data),
                'creator_user_id' => $request->creator_user_id ?? Auth::user()->id ?? null,
            ]);

            return $this->respond(200, $document, null, 'Documento creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear documento');
        }
    }

    public function updateDocument($id, $request)
    {
        $validator = $this->validateDocument($request);

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        $document = $this::find($id);
        if (is_null($document)) {
            return $this->respond(500, [], 'document not found', 'No se encontró el documento');
        }

        try {
            $document->update([
                'associate_to' => $request->associate_to ?? $document->associate_to,
                'associate_id' => $request->associate_id ?? $document->associate_id,
                'document_type' => $request->type ?? $document->document_type,
                'url' => $request->url ?? $document->url,
                'description' => $request->description ?? $document->description,
                'data' => json_encode($request->data) ?? $document->data,
                'creator_user_id' => $request->creator_user_id ?? $document->creator_user_id,
            ]);

            return $this->respond(200, $document, null, 'Documento actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al actualizar documento');
        }
    }

    public function deleteDocument($id)
    {
        try {
            $document = $this::find($id);
            if (is_null($document)) {
                return $this->respond(500, [], 'document not found', 'No se encontró el documento');
            }
            $document->delete();
            return $this->respond(200, $document, null, 'Documento eliminado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar documento');
        }
    }


    public function updateOrCreateDocument($request)
    {
        $validator = $this->validateDocument($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $document = $this->updateOrCreate([
                'associate_to' => $request->associate_to,
                'associate_id' => $request->associate_id,
                'document_type' => $request->document_type,
            ], [
                'associate_to' => $request->associate_to,
                'associate_id' => $request->associate_id,
                'document_type' => $request->document_type,
                'url' => $request->url,
                'description' => $request->description,
                'data' => json_encode($request->data),
                'creator_user_id' => $request->creator_user_id ?? Auth::user()->id,
            ]);

            return $this->respond(200, $document, null, 'Documento creado o actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear documento');
        }
    }
}
