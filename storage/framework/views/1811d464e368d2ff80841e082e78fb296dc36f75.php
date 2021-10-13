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
                <li><a href="<?php echo e(route('member.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
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
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/datatables-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/prismjs-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/style-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/plugins-bundle.css')); ?>">
    <style>
        .inner-panel-padding {
            padding: 10px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <!-- .row -->
    <?php echo Form::open(['id'=>'saveUpdateProperty','class'=>'ajax-form','method'=>'POST']); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> Property Detail
                <div class="pull-right">
                        <div class="btn-group m-r-10">
<!--                                    <label class="">Status</label>-->
                                    <select name="propertyStatus" id="propertyStatus" class="form-control">
                                        <option value="Draft" <?php if(isset($status) && $status == 'Draft'): ?> selected="selected" <?php endif; ?> >
                                            Draft
                                        </option>
                                        <option value="Active" <?php if(isset($status) && $status == 'Active'): ?> selected="selected" <?php endif; ?> >
                                            Active
                                        </option>
                                        <option value="Inactive"
                                                <?php if(isset($status) && $status == 'Inactive'): ?> selected="selected" <?php endif; ?> >
                                            Inactive
                                        </option>
                                    </select>
                        </div>
                    </div>
                </div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Property Title</label>
                                    <input type="text" name="propertyTitle" id="propertyTitle" value="<?php echo e(isset($propertyTitle)?$propertyTitle:''); ?>"
                                           class="form-control"
                                           autocomplete="nope">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Reference ID</label>
                                    <input type="text" name="propertyRefId" id="propertyRefId" value="<?php echo e(isset($ref_id)?$ref_id:''); ?>"
                                           class="form-control"
                                           autocomplete="nope">
                                </div>
                            </div>
                        </div>


                        <div class="tabbable">
                            <ul class="nav nav-tabs wizard">
                                <li class="active"><a class="nav-link nav-item" href="#PropertyInfo" data-toggle="tab"
                                                      aria-controls="PropertyInfo" aria-expanded="false">Property info</a></li>
<!--                                <li><a class="nav-link nav-item" href="#LandInfo" data-toggle="tab"
                                                      aria-controls="LandInfo" aria-expanded="false">Land info</a>
                                </li>-->
                                <li><a href="#StructureInfo" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="StructureInfo" aria-expanded="false">Structure info</a></li>
                                <li><a href="#OtherInfo" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="OtherInfo" aria-expanded="false">Other info</a></li>
                                       <li><a href="#UnitInfo" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="UnitInfo" aria-expanded="false">Units info</a></li>
<!--                                <li><a href="#FinancialInfo" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="FinancialInfo" aria-expanded="false">Financial Info</a></li>-->
                                <li><a href="#ObservationInfo" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="ObservationInfo" aria-expanded="false">Observation</a></li>

                            </ul>

                        </div>


                        <div class="tab-content" id="myTabContent">
                            <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.PropertyInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.StructureInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
                            <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.OtherInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.UnitRefInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           
                            <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.ObservationInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-actions">
                                    <button type="submit" id="save-form" class="btn btn-success pull-right"><i
                                                class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/FormFieldsRepeater/repeater.js')); ?>"></script>

    <script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
        $("#repeaterAddOnCost").createRepeater({
            showFirstItemToDefault: true,
        });
        $("#repeaterUpload").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>

    <script data-name="basic">
        (function () {
            $("#country").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $("#governorate").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $(".propertyCity").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $(".propertyBlock").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });

            $("#propertyClass").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });

            $("#propertyClassification").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });

            $("#propertyCategorization").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $("#propertyType").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
        })()
    </script>
    <script>
        $('#save-form').click(function () {

            let propertyTitle = $("#propertyTitle");

            if (propertyTitle.val() == '') {
                alert('Please enter Property Title');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, $id)); ?>',
                container: '#saveUpdateProperty',
                type: "POST",
                redirect: true,
                file: true,
                data: $('#saveUpdateProperty').serialize()
            })
        });
//        function loadUnitFromXref()
//        {
//           $.ajax({
//               url:'<?php echo e(route($getUnitRoute, $id)); ?>',
//               type:'get',
//               success:function(response)
//                {
//                    console.log(response);
//                }
//           })
//        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/AddEditView.blade.php ENDPATH**/ ?>