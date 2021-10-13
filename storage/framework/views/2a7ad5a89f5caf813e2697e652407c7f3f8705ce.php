<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?> #<?php echo e($project->id); ?> - <span
                        class="font-bold"><?php echo e(ucwords($project->project_name)); ?></span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.projects.edit', $project->id)); ?>" class="btn btn-sm btn-success btn-outline"><i
                        class="icon-note"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('modules.projects.members'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/icheck/skins/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/multiselect/css/multi-select.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    <?php echo $__env->make('admin.projects.show_project_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if(empty($baseProperty)): ?>
                        <div class="content-wrap">
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row">
                                        <?php echo Form::open(['id'=>'saveProjectBaseProperty','class'=>'ajax-form','method'=>'POST']); ?>

                                        <input type="hidden" name="projectId" value="<?php echo e($projectId); ?>">
                                        <div class="col-md-12 b-l">
                                            <div class="panel panel-inverse">

                                                <div class="panel-heading">Project base property not selected </div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Base Property</label>
                                                                <select name="projectBaseProperty"
                                                                        id="projectBaseProperty"
                                                                        class="form-control projectBaseProperty"
                                                                        required>
                                                                    <option value="0">--</option>
                                                                    <?php if(isset($properties)): ?>
                                                                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e(isset($property->id)?$property->id:''); ?>">
                                                                                <?php echo e(isset($property->title)?$property->title: '--'); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-actions">
                                                                <button type="submit" id="assignProperty"
                                                                        class="btn btn-success"><i
                                                                            class="fa fa-check"></i> Assign to Project
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>

                            </section>

                        </div><!-- /content -->

                    <?php else: ?>
                        <input type="hidden" name="projectId" value="<?php echo e($projectId); ?>">
                        <div class="content-wrap">
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">Base Property</div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <?php if(!empty($baseProperty)): ?>
                                                                <?php echo e(isset($baseProperty->title)?$baseProperty->title : 'Title not set'); ?>

                                                            <?php else: ?>
                                                                <label>Base property not selected</label>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <?php echo Form::open(['id'=>'createMembers','class'=>'ajax-form','method'=>'POST']); ?>

                                        <input type="hidden" name="basePropertyId" value="<?php echo e($basePropertyId); ?>">
                                        <div class="col-md-9 b-l">
                                            <div class="panel panel-inverse">

                                                <div class="panel-heading">Properties Compare With</div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 1</label>
                                                                <select name="comparePropertyOne"
                                                                        id="comparePropertyOne"
                                                                        class="form-control comparePropertyOne"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    <?php if(isset($properties)): ?>
                                                                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e(isset($property->id)?$property->id:''); ?>">
                                                                                <?php echo e(isset($property->title)?$property->title: '--'); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 2</label>
                                                                <select name="comparePropertyTwo"
                                                                        id="comparePropertyTwo"
                                                                        class="form-control comparePropertyTwo"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    <?php if(isset($properties)): ?>
                                                                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e(isset($property->id)?$property->id:''); ?>">
                                                                                <?php echo e(isset($property->title)?$property->title: '--'); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 3</label>
                                                                <select name="comparePropertyThree"
                                                                        id="comparePropertyThree"
                                                                        class="form-control comparePropertyThree"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    <?php if(isset($properties)): ?>
                                                                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e(isset($property->id)?$property->id:''); ?>">
                                                                                <?php echo e(isset($property->title)?$property->title: '--'); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-actions">
                                                                <button type="submit" id="compare"
                                                                        class="btn btn-success"><i
                                                                            class="fa fa-check"></i> Compare
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>

                            </section>
                            <hr/>
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row" id="comparisionResponse">
                                    </div>
                                </div>
                            </section>
                        </div><!-- /content -->
                    <?php endif; ?>

                </div><!-- /tabs -->
            </section>


        </div>


    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script type="text/javascript">

        $('ul.showProjectTabs .valuationMethodology').addClass('tab-current');

        /*var $baseProperty = $(".baseProperty");
        $baseProperty.select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        $baseProperty.on("change", function (e) {

        });*/

        var $comparePropertyOne = $(".comparePropertyOne");
        $comparePropertyOne.select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        $comparePropertyOne.on("change", function (e, item) {
            /*$(".comparePropertyTwo option[value='" +e.val+ "']").prop('disabled', true);*/
            //disableSel2Group(e,$comparePropertyTwo,'disabled');
        });

        /*function disableSel2Group(evt, target, disabled) {

            var id = evt.val;
            var aaList = $("option", target);
            $.each(aaList, function(idx, item) {
                let itemValue = $(item).val();
                if{}
                console.log(itemValue);
                $(item).prop('disabled', true);
            })
        }*/


        var $comparePropertyTwo = $(".comparePropertyTwo");
        $comparePropertyTwo.select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        $comparePropertyTwo.on("change", function (e) {

        });

        var $comparePropertyThree = $(".comparePropertyThree");
        $comparePropertyThree.select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        $comparePropertyThree.on("change", function (e) {

        });

        $('#assignProperty').click(function () {

            let projectBaseProperty = $('#projectBaseProperty').val();
            if(projectBaseProperty <= 0 ){
                alert('Please Select Property');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route('admin.valuation-method.saveProjectBaseProperty')); ?>',
                container: '#saveProjectBaseProperty',
                type: "POST",
                data: $('#saveProjectBaseProperty').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
                        console.log(response)
                    }
                }
            })
        });

        //    save project members
        $('#compare').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('admin.valuation-method.processComparison')); ?>',
                container: '#createMembers',
                type: "POST",
                data: $('#createMembers').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
                        let comparisionResponseHtml = response.comparisionResponseHtml;
                        $('#comparisionResponse').html(comparisionResponseHtml);
                        console.log(response);
                    }
                }
            })
        });


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/ValuationMethodology/ComparativeMethod.blade.php ENDPATH**/ ?>