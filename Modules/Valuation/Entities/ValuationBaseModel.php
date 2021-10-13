<?php

namespace Modules\Valuation\Entities;

use Illuminate\Database\Eloquent\Model;

class ValuationBaseModel extends Model
{
    protected $companyId = 0;

    public function __construct()
    {
        $this->companyId  = company()->id;
    }

    public function getAllForCompany()
    {
        return $this->where('company_id', $this->companyId)->get();
    }

    public function getForCompanyById($id = 0)
    {
        return $this->where('company_id', $this->companyId)->where('id', $id)->first();
    }

    public function countForCompany()
    {
        return $this->where('company_id', $this->companyId)->get()->count();
    }

    public function getAllAjaxForCompany()
    {
        return $this->where('company_id', $this->companyId)->get();
    }



}
