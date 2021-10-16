<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Support\Facades\DB;


class ProjectAppointment extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }

    public function updateStatusActive($projectId, $appointmentId)
    {
        DB::statement('UPDATE project_appointments SET status = "Inactive" WHERE status = "Active" AND project_id = '.$projectId);
        DB::statement('UPDATE project_appointments SET status = "Active" WHERE  id = '.$appointmentId);
    }
}
