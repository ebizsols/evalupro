
<?php

    $openValuationMainMenu = (isset($openValuationMainMenu))?$openValuationMainMenu:false;
    $modules = (isset($modules) && !empty($modules))?$modules:array();
    //echo getValuationSettingMenu($modules, $openValuationMainMenu)
    
?>
<li class="tab "> <a href="<?php echo e(route('valuation.admin.settings.menu')); ?>">VMS Setting</a></li>

<?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/sections/admin_setting_menu.blade.php ENDPATH**/ ?>