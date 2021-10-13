@php
    $openValuationMainMenu = (isset($openValuationMainMenu))?$openValuationMainMenu:false;
    $menuArray = isset($menuArray)?$menuArray:array();
    $modules = (isset($modules) && !empty($modules))?$modules:array();
    echo getValuationMenuHTML($menuArray, 1, $modules, $openValuationMainMenu);
@endphp

