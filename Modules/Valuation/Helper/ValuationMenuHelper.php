<?php

use Modules\Valuation\Helper\ValuationModelHelper;

define('ValuationSettingMenuID', 2);
if (!function_exists('getValuationMenu')) {
    function getValuationMenu($modules = array(), $openValuationMainMenu = array())
    {
        $valuationMenuObj = ValuationModelHelper::valuationMenu();
        $data = array();
        $data['modules'] = $modules;
        $data['menuArray'] = $valuationMenuObj->menu_hierarchy(0, ValuationSettingMenuID);
        $data['openValuationMainMenu'] = $openValuationMainMenu;

        return View('valuation::sections.valuation_menu', $data);
    }
}
if (!function_exists('getValuationMenuHTML')) {
    function getValuationMenuHTML($hierarchy, $first = 1, $modules= array(), $openValuationMainMenu = '')
    {
        $HTML = '';
        foreach ($hierarchy as $hierarchyIn) {
            $route = (isset($hierarchyIn->route) && $hierarchyIn->route != '' )? $hierarchyIn->route : '';
            $route = ($route != '')?route($route):'javascript:void(0)';
            $name = isset($hierarchyIn->name) ? $hierarchyIn->name : '';
            $parent = isset($hierarchyIn->parent) ? $hierarchyIn->parent : '';
            $validation_name = isset($hierarchyIn->validation_name) ? $hierarchyIn->validation_name : '';
            $liClass = '';

            if ($first != 1) {
                $ulClass = 'class="nav nav-second-level"';
                $mainOpenTag = '<ul ' . $ulClass . '>';
                $mainCloseTag = '</ul>';
                $aOpen = '>';
                $aClose = '</a>';

                if($parent == 1){
                    $aOpen = 'class="waves-effect"><i class="ti-layout-list-thumb"></i> <span class="hide-menu">';
                    $aClose = '<span class="fa arrow"></span> </span></a>';
                }
            }else{
                if($openValuationMainMenu == 'open'){
                    $liClass = 'active';
                }

                $mainOpenTag = '';
                $mainCloseTag = '';
                $aOpen = 'class="waves-effect '.$liClass.'"><i class="ti-layout-list-thumb"></i> <span class="hide-menu">';
                $aClose = '<span class="fa arrow"></span> </span></a>';
            }


            $HTML .= '<li class="'.$liClass.'"><a href="' . $route . '"' .$aOpen. $name . $aClose . getValuationMenuHTML($hierarchyIn->children, 0) .'</li>';
        }
        if ($HTML != '') {
            $return = '';
            if(!in_array($validation_name,$modules)){
                $return = $mainOpenTag . $HTML . $mainCloseTag;
            }
            return  $return;
        }
    }
}

if (!function_exists('getValuationSettingMenu')) {
    function getValuationSettingMenu($modules = array(), $openValuationMainMenu = array())
    {
        $valuationMenuObj = ValuationModelHelper::valuationMenu();
        $data = array();
        $data['modules'] = $modules;
        $data['menuArray'] = $valuationMenuObj->menu_hierarchy(ValuationSettingMenuID);
        $data['openValuationMainMenu'] = $openValuationMainMenu;

        return View('valuation::sections.valuation_admin_setting_menu', $data);
    }
}
if (!function_exists('getValuationSettingMenuHTML')) {
    function getValuationSettingMenuHTML($hierarchy, $first = 1, $modules= array(), $openValuationMainMenu = '')
    {
        $HTML = '';
        foreach ($hierarchy as $hierarchyIn) {
            $route = (isset($hierarchyIn->route) && $hierarchyIn->route != '' )? $hierarchyIn->route : '';
            $routelistText = (isset($hierarchyIn->route) && $hierarchyIn->route != '' )? $hierarchyIn->route : '';
            $routeAddEditText = $routelistText.'.addEditView';
            $route = ($route != '')?route($route):'javascript:void(0)';
            $name = isset($hierarchyIn->name) ? $hierarchyIn->name : '';
            $parent = isset($hierarchyIn->parent) ? $hierarchyIn->parent : '';
            $validation_name = isset($hierarchyIn->validation_name) ? $hierarchyIn->validation_name : '';
            $liClass = '';

            if ($first != 1) {
                $ulClass = 'class="nav nav-second-level"';
                $mainOpenTag = '<ul ' . $ulClass . '>';
                $mainCloseTag = '</ul>';
                $aOpen = '>';
                $aClose = '</a>';

                if($parent == 1){
                    $aOpen = 'class="waves-effect"><span class="hide-menu">';
                    $aClose = ' </span></a>';
                }
            }else{
                if($openValuationMainMenu == 'open'){
                    $liClass = 'tab';
                    if(\Illuminate\Support\Facades\Route::currentRouteName() == $routelistText  || \Illuminate\Support\Facades\Route::currentRouteName() == $routeAddEditText){
                        //echo "<pre>"; print_r($route); exit;
                        $liClass = 'tab active';
                    }
                }

                $mainOpenTag = '';
                $mainCloseTag = '';
                $aOpen = 'class="waves-effect '.$liClass.'"><span class="hide-menu">';
                $aClose = '</a>';
            }


            $HTML .= '<li class="'.$liClass.'"><a href="' . $route . '"' .$aOpen. $name . $aClose . getValuationMenuHTML($hierarchyIn->children, 0) .'</li>';
        }
        if ($HTML != '') {
            $return = '';
            if(!in_array($validation_name,$modules)){
                $return = $mainOpenTag . $HTML . $mainCloseTag;
            }
            return  $return;
        }
    }
}

/**
 * first create table to save valuationmenu
 * table fields
 * id int auto increatment
 * name varchar 125
 * route text
 * lang_name text
 * icon varchar
 * parent_id int 125
 * status enum 'active' inactive
 *
 * --------------------
 * menu user role relation
 *
 *
 *
 *
 *
 *
 */