<?php

namespace Modules\Valuation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Valuation\Entities\ValuationMenu;

class SeedValuationLeftMenuTableSeeder extends Seeder
{

    public function getMenuData($companyId = 0)
    {
        $menu = array();
        $menu['Valuation'] = array(
            'company_id' => $companyId,
            'name' => 'Valuation',
            'validation_name' => 'Valuation',
            'route' => 'valuation.member.dashboard',
            'lang_name' => 'valuation::app.menu.moduleName',
            'icon' => 'ti-layout-list-thumb',
            'order' => '1',
            'parent' => '0',
            'status' => 'Active');

        //Setting section
        $menu['setting'] = array(
            'company_id' => $companyId,
            'name' => 'Settings',
            'validation_name' => 'Settings',
            'route' => '',
            'lang_name' => 'valuation::valuation.settings.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '4',
            'parent' => '1',
            'status' => 'Active');

        $menu['setting']['children'][] = array(
            'company_id' => $companyId,
            'name' => 'Country',
            'validation_name' => 'Country',
            'route' => 'valuation.admin.settings.country',
            'lang_name' => 'valuation::valuation.settings.country',
            'icon' => 'ti-layout-list-thumb',
            'order' => '5',
            'parent' => '4',
            'status' => 'Active');

        $menu['setting']['children'][]  = array(
            'company_id' => $companyId,
            'name' => 'Governorates',
            'validation_name' => 'Governorates',
            'route' => 'valuation.admin.settings.governorate',
            'lang_name' => 'valuation::valuation.governorate.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '6',
            'parent' => '4',
            'status' => 'Active');

        $menu['setting']['children'][]  = array(
            'company_id' => $companyId,
            'name' => 'City',
            'validation_name' => 'City',
            'route' => 'valuation.admin.settings.city',
            'lang_name' => 'valuation::valuation.city.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '6',
            'parent' => '4',
            'status' => 'Active');

        $menu['setting']['children'][]  = array(
            'company_id' => $companyId,
            'name' => 'Block',
            'validation_name' => 'Block',
            'route' => 'valuation.admin.settings.block',
            'lang_name' => 'valuation::valuation.block.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '6',
            'parent' => '4',
            'status' => 'Active');
        
        $menu['setting']['children'][]  = array(
            'company_id' => $companyId,
            'name' => 'Menu',
            'validation_name' => 'Menu',
            'route' => 'valuation.admin.settings.menu',
            'lang_name' => 'valuation::valuation.menu.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '6',
            'parent' => '4',
            'status' => 'Active');

        $menu['setting']['children'][] = array(
            'company_id' => $companyId,
            'name' => 'Property Type',
            'validation_name' => 'PropertyType',
            'route' => 'valuation.admin.property.type',
            'lang_name' => 'valuation::valuation.property.type.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');

        $menu['setting']['children'][] = array(
            'company_id' => $companyId,
            'name' => 'Property Classification',
            'validation_name' => 'PropertyClassification',
            'route' => 'valuation.admin.property.classification',
            'lang_name' => 'valuation::valuation.property.classification.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');

        $menu['setting']['children'][] = array(
            'company_id' => $companyId,
            'name' => 'Property Categorization',
            'validation_name' => 'PropertyCategorization',
            'route' => 'valuation.admin.property.categorization',
            'lang_name' => 'valuation::valuation.property.categorization.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');

        $menu['setting']['children'][] = array(
            'company_id' => $companyId,
            'name' => 'Property Class',
            'validation_name' => 'PropertyClass',
            'route' => 'valuation.admin.property.class',
            'lang_name' => 'valuation::valuation.property.class.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');

        //Property section
        $menu['property'] = array(
            'company_id' => $companyId,
            'name' => 'Property',
            'validation_name' => 'Property',
            'route' => '',
            'lang_name' => 'valuation::valuation.property.title',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');
        $menu['property']['children'][]  = array(
            'company_id' => $companyId,
            'name' => 'List of properties',
            'validation_name' => 'PropertyList',
            'route' => 'valuation.admin.property',
            'lang_name' => 'valuation::valuation.property.propertyList',
            'icon' => 'ti-layout-list-thumb',
            'order' => '2',
            'parent' => '1',
            'status' => 'Active');
        return $menu;
    }

    public function insertMenuData($menu, $isFirst = true, $parentId = 0)
    {


        $second = 0;
        foreach ($menu as $key => $menuIn) {

            if($isFirst == true){
                $parentId = 0;
                if($second > 0){
                    $parentId = 1;
                    $isFirst = false;
                }
                $second++;
            }

            $valuationMenu = new valuationMenu();
            $valuationMenu->company_id = $menuIn['company_id'];
            $valuationMenu->name = $menuIn['name'];
            $valuationMenu->validation_name = $menuIn['validation_name'];
            $valuationMenu->route = $menuIn['route'];
            $valuationMenu->lang_name = $menuIn['lang_name'];
            $valuationMenu->icon = $menuIn['icon'];
            $valuationMenu->order = $menuIn['order'];
            $valuationMenu->parent = $parentId;
            $valuationMenu->status = $menuIn['status'];
            $valuationMenu->save();
            $parentId2 = $valuationMenu->id;

            if(isset($menuIn['children']) && !empty($menuIn['children'])){
                $this->insertMenuData($menuIn['children'],  false, $parentId2);
            }
        }
    }
    /**
     * Run the database seeds.
     *
     * @param $companyId
     * @return void
     */
    public function run($companyId = 0)
    {
        Model::unguard();

        $menu = $this->getMenuData($companyId);
        $this->insertMenuData($menu);

        // $this->call("OthersTableSeeder");
    }
}
