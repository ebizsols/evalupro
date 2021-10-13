<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route($listingPageRoute)); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('app.addNew'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo e(__($title)); ?></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="vtabs customvtab m-t-10">
                         <?php echo $__env->make('sections.valuation_sub_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                        <?php echo Form::open(['id'=>'saveUpdateMenu','class'=>'ajax-form','method'=>'POST']); ?>

                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input type="text" name="name" id="name" value="<?php echo e($name); ?>"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class=""><?php echo app('translator')->get('valuation::valuation.menu.validationName'); ?></label>
                                        <input type="text" name="validation_name" id="validationName"
                                               value="<?php echo e($validationName); ?>"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class=""><?php echo app('translator')->get('valuation::valuation.menu.route'); ?></label>
                                        <input type="text" name="route" id="route" value="<?php echo e($route); ?>"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                <?php if(isset($isHide) && $isHide == false): ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class=""><?php echo app('translator')->get('valuation::valuation.menu.menuParent'); ?></label>
                                            <select name="parentMenuId" id="parentMenuId" class="form-control" required>
                                                <option value="">--</option>
                                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menuIn->id); ?>"
                                                            <?php if($menuIn->id == $parent): ?> selected="selected" <?php endif; ?>>
                                                        <?php echo e($menuIn->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active" <?php if($status == 'Active'): ?> selected="selected" <?php endif; ?> >
                                                Active
                                            </option>
                                            <option value="Inactive"
                                                    <?php if($status == 'Inactive'): ?> selected="selected" <?php endif; ?> >
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->


                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"><i
                                        class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>

                        </div>
                        <?php echo Form::close(); ?>

                        </div>
                         </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->
    
    <div class="modal fade bs-modal-md in" id="departmentModel" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script data-name="basic">
        (function () {
            $("#parentMenuId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });

        })()
    </script>

    <script>

        $('#save-form').click(function () {

            let name = $("#name");

            if (name.val() == '') {
                alert('Please enter name');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, $id)); ?>',
                container: '#saveUpdateMenu',
                type: "POST",
                redirect: true,
                data: $('#saveUpdateMenu').serialize()
            })
        });

    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Settings/Menu/AddEditView.blade.php ENDPATH**/ ?>