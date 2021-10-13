<?php $__env->startSection('other-section'); ?>
<ul class="nav tabs-vertical">
     <li class="tab">
        <a href="<?php echo e(route('admin.settings.index')); ?>" class="text-danger"><i class="ti-arrow-left"></i> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <?php
    $openValuationMainMenu = (isset($openValuationMainMenu))?$openValuationMainMenu:false;
    $modules = (isset($modules) && !empty($modules))?$modules:array();
    echo getValuationSettingMenu($modules, $openValuationMainMenu)
    ?>
 
</ul>
<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    var screenWidth = $(window).width();
    if(screenWidth <= 768){

        $('.tabs-vertical').each(function() {
            var list = $(this), select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('settings_dropdown form-control');

            $('>li a', this).each(function() {
                var target = $(this).attr('target'),
                    option = $(document.createElement('option'))
                        .appendTo(select)
                        .val(this.href)
                        .html($(this).html())
                        .click(function(){
                            if(target==='_blank') {
                                window.open($(this).val());
                            }
                            else {
                                window.location.href = $(this).val();
                            }
                        });

                if(window.location.href == option.val()){
                    option.attr('selected', 'selected');
                }
            });
            list.remove();
        });

        $('.settings_dropdown').change(function () {
            window.location.href = $(this).val();
        })

    }
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/evalupro/public_html/resources/views/sections/valuation_sub_setting_menu.blade.php ENDPATH**/ ?>