<?php

namespace Modules\Valuation\Entities;

use Modules\Valuation\Entities\ValuationBaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ValuationSetting extends Model
{
    protected $table = 'rest_api_settings';

    protected $default = array(
        'id',
    );

}
