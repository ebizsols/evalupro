<?php
    $openValuationMainMenu = (isset($openValuationMainMenu))?$openValuationMainMenu:false;
    $menuArray = isset($menuArray)?$menuArray:array();
    $modules = (isset($modules) && !empty($modules))?$modules:array();
    echo getValuationSettingMenuHTML($menuArray, 1, $modules, $openValuationMainMenu);
?>

<?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/sections/valuation_admin_setting_menu.blade.php ENDPATH**/ ?>