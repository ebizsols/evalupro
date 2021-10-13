<?php

namespace App;

use App\Observers\AcceptEstimateObserver;
use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AcceptScope extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::observe(AcceptEstimateObserver::class);

        static::addGlobalScope(new CompanyScope);

    }

    public function getSignatureAttribute()
    {
        return asset_url('scope/accept/'.$this->attributes['signature']);
    }
}
