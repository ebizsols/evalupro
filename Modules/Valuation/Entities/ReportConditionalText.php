<?php

namespace Modules\Valuation\Entities;


use Modules\Valuation\Entities\ValuationBaseModel;

class ReportConditionalText extends ValuationBaseModel
{
    // region Properties

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

}
