<?php

namespace Modules\Valuation\Entities;

use Modules\Valuation\Entities\ValuationBaseModel;
use Illuminate\Support\Facades\DB;

class ValuationMenu extends ValuationBaseModel
{
    protected $fillable = [];


    public function getActiveMenu()
    {
        $this->where('status', 'Active');
        return $this->get();
    }

    public function menu_hierarchy($parentId, $removeMenuId = -1)
    {
        $companyId = company()->id;

        $results = DB::table('valuation_menus')
            ->where('status', 'Active')
            ->where('company_id', $companyId)
            ->where('parent', $parentId)->get()->toArray();
        foreach ($results as $key => $result) {
            $children = $this->menu_hierarchy($result->id, $removeMenuId);
            foreach ($children as $childKey => $child) {
                if ($child->id == $removeMenuId) {
                    unset($children[$childKey]);
                }
            }
            $results[$key]->children = (!empty($children)) ? $children : array();
            $return = $results;
        }
        return isset($return) ? $return : array();

    }

    public function getByCompanyId($companyId = 0)
    {
        return $this->where('status', 'Active')
            ->where('company_id', $companyId)
            ->get()->toArray();
    }
}
