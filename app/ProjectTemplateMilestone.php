<?php

namespace App;

use App\Observers\ProjectTemplateMilestoneObserver;
use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProjectTemplateMilestone extends BaseModel
{

    protected static function boot()
    {
        parent::boot();

        static::observe(ProjectTemplateMilestoneObserver::class);

        static::addGlobalScope(new CompanyScope);
    }


    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withoutGlobalScopes(['enable']);
    }

    public function projectTemplate()
    {
        return $this->belongsTo(ProjectTemplate::class, 'project_template_id');
    }

    /*public function tasks()
    {
        return $this->hasMany(Task::class, 'milestone_id');
    }*/
}
