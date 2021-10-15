<?php

namespace App;

use App\Observers\ProjectObserver;
use App\Scopes\CompanyScope;
use App\Traits\CustomFieldsTrait;
use Carbon\Carbon;
use Zoha\Metable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ValuationInspectionField extends BaseModel
{


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope);
    }

}
