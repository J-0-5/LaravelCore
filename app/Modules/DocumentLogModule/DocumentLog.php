<?php

namespace App\Modules\DocumentLogModule;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\DocumentModule\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentLog extends Model
{
    use SoftDeletes, RestActions;

    protected $table = 'document_logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'document_id',
        'data',
        'status',
        'creator_user_id',
    ];

    /* Accessors Config */
    public function getDataAttribute($value)
    {
        if (!is_null($value))
            return json_decode($value);
    }
    /* End Accessors Config */

    /* Relationships Config */
    public function getDocument()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
    public function getCreatorUser()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
    /*End Relationships config */

    /* Scopes Config */
    public function scopeWhereDocument($query, $value)
    {
        if (!is_null($value))
            $query->where('document_id', $value);
    }
    public function scopeWhereStatus($query, $value)
    {
        if (!is_null($value))
            $query->where('status', $value);
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
    /*End Scopes Config */

    public function getDocumentLog($id)
    {
        try {
            $document_log = $this::where('id', $id)->first();
            return $this->respond(200, $document_log, null, 'Log de Documento encontrado');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage());
        }
    }

    public function getDocumentLogs($request)
    {
        try {
            if (!is_null($request->pagination)) {
                $document_logs = $this::whereDocument($request->document)
                    ->whereStatus($request->status)
                    ->whereCreatorUserId($request->creator_user_id)
                    ->whereCreatorUserName($request->creator_user_name)
                    ->paginate($request->pagination ?? 15);
            } else {
                $document_logs = $this::whereDocument($request->document)
                    ->whereStatus($request->status)
                    ->whereCreatorUserId($request->creator_user_id)
                    ->whereCreatorUserName($request->creator_user_name)
                    ->get();
            }
            return $this->respond(200, $document_logs);
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage());
        }
    }

    public function validateDocumentLog($request, $action = null, $id = null)
    {
        return Validator::make(
            $request->all(),
            [
                'document_id' => [Rule::requiredIf($action == 'create')],
                'data' => 'nullable',
                'status' => ['nullable', 'exists:parameter_values,id'],
                'creator_user_id' => 'nullable|exists:users,id',
            ]
        );
    }

    public function saveDocumentLog($request)
    {
        $validator = $this->validateDocumentLog($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $document_log = $this::create([
                'document_id' => $request->document_id,
                'data' => json_encode($request->data),
                'status' => $request->status,
                'creator_user_id' => $request->creator_user_id,
            ]);

            return $this->respond(200, $document_log, null, 'Log Documento creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear log de documento');
        }
    }

    public function updateDocumentLog($id, $request)
    {
        $validator = $this->validateDocumentLog($request);

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        $document_log = $this::find($id);
        if (is_null($document_log)) {
            return $this->respond(500, [], 'document_log not found', 'No se encontró el log del documento');
        }

        try {
            $document_log->update([
                'document_id' => $request->document_id ?? $document_log->document_id,
                'status' => $request->status ?? $document_log->status,
                'data' => json_encode($request->data) ?? $document_log->data,
                'creator_user_id' => $request->creator_user_id ?? $document_log->creator_user_id,
            ]);

            return $this->respond(200, $document_log, null, 'Log de Documento actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al actualizar log del documento');
        }
    }

    public function deleteDocumentLog($id)
    {
        try {
            $document_log = $this::find($id);
            if (is_null($document_log)) {
                return $this->respond(500, [], 'document_log not found', 'No se encontró el log del documento');
            }
            $document_log->delete();
            return $this->respond(200, $document_log, null, 'Log del Documento eliminado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar log del documento');
        }
    }
}
