
@php

    $openValuationMainMenu = (isset($openValuationMainMenu))?$openValuationMainMenu:false;
    $modules = (isset($modules) && !empty($modules))?$modules:array();
    //echo getValuationSettingMenu($modules, $openValuationMainMenu)
    
@endphp
<li class="tab "> <a href="{{ route('valuation.admin.settings.menu') }}">VMS Setting</a></li>

