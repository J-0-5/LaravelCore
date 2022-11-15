<?php

namespace App\Modules\PermissionModule;

use App\Modules\ModuleModule\Module;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Permission extends Model
{
    use LogsActivity;
    protected $table = 'permissions';

    protected $fillable = [
        'associate_id',
        'associate_to',
        'module_id',
        'actions',
        'creator_user_id'
    ];

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        if ($activity->causer) {
            $activity->description = "Se han " . __($eventName) . " los permisos del modulo " . $activity->subject->getModule->name ?? '---';
        }
    }
    /*End logs config */

    public function getModule()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
