<?php

namespace Modules\Valuation\Entities;

use Modules\RestAPI\Entities\BaseModel;
use Modules\Valuation\Entities\ValuationBaseModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\RestAPI\Observers\MethodologyTemplateObserver;

class MethodologyTemplate extends ValuationBaseModel
{
    // region Properties

    protected $table = 'methodology_templates';

    protected $default = [
        'id',
    ];

    protected $hidden = [

    ];

    protected $guarded = [
        'id',
    ];

    protected $filterable = [
        'id',
    ];

    // public function ArrayComparison()
    // {
    //     return $this->json_encode();
    // }

    // static function ArrayComparison()
    // {
    //     return self::json_encode();
    // }
}
