<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo app('translator')->get($pageTitle); ?> #<?php echo e($project->id); ?> - <span class="font-bold"><?php echo e(ucwords($project->project_name)); ?></span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
            <a href="javascript:;" id="createTaskCategory" class="btn btn-sm btn-outline btn-info"><i class="fa fa-plus"></i> <?php echo app('translator')->get('modules.taskCategory.addTaskCategory'); ?></a>

            <span id="filter-result" class="p-t-15 m-r-5"></span> &nbsp;
            <a href="javascript:;" id="toggle-filter" class="btn btn-sm btn-inverse btn-outline toggle-filter"><i class="fa fa-sliders"></i> <?php echo app('translator')->get('app.filterResults'); ?></a>
            <a href="<?php echo e(route('admin.projects.edit', $project->id)); ?>" class="btn btn-sm btn-success btn-outline" ><i class="icon-note"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo app('translator')->get($pageTitle); ?></a></li>
                <li class="active"><?php echo app('translator')->get('modules.tasks.taskBoard'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/lobipanel/dist/css/lobipanel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <style>
      .lobipanel>.panel-body {
          padding: 0 !important;
      }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    <?php echo $__env->make('admin.projects.show_project_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="content-wrap">
                        <section id="section-line-3" class="show">
                            <div class="row  white-box" style="display: none;" id="ticket-filters">
                                <input type="hidden" name="project_id" id="project_id" value="<?php echo e($project->id); ?>">
                                <input type="hidden" id="clientID" value="all">

                                <form action="" id="filter-form">
                                    <div class="col-md-3">
                                        <h5><?php echo app('translator')->get('app.selectDateRange'); ?></h5>
                                        <div class="input-daterange input-group m-t-5" id="date-range">
                                            <input type="text" class="form-control" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                                                   value="<?php echo e(\Carbon\Carbon::now()->timezone($global->timezone)->subDays(6)->format($global->date_format)); ?>"/>
                                            <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                                            <input type="text" class="form-control" id="end-date" placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                                                   value="<?php echo e(\Carbon\Carbon::now()->timezone($global->timezone)->addDays(7)->format($global->date_format)); ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <h5><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('modules.tasks.assignTo'); ?></h5>

                                        <div class="form-group">
                                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.tasks.assignTo'); ?>" id="assignedTo">
                                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                            value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('modules.tasks.assignBy'); ?></h5>

                                        <div class="form-group">
                                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.tasks.assignBy'); ?>" id="assignedBY">
                                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                            value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-t-10">
                                            <label class="control-label col-xs-12">&nbsp;</label>
                                            <button type="button" id="apply-filters" class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                                            <button type="button" id="reset-filters" class="btn btn-inverse btn-sm"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                                            <button type="button" class="btn btn-default btn-sm toggle-filter"><i class="fa fa-close"></i> <?php echo app('translator')->get('app.close'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="container-scroll white-box">
                                <button id="toggle_fullscreen" class="btn btn-default btn-outline btn-sm pull-right"><i class="icon-size-fullscreen"></i></button>
                                <button class="btn btn-default btn-outline btn-sm pull-right" id="my-tasks"><i class="fa fa-user"></i> <?php echo app('translator')->get('modules.tasks.myTask'); ?></button>
                                <button class="btn btn-default btn-outline btn-sm pull-right" id="show-all-tasks" style="display: none"><i class="fa fa-users"></i> <?php echo app('translator')->get('modules.tasks.showAll'); ?></button>

                                <div class="row container-row">
                                </div>
                            <!-- .row -->
                            </div>
                        </section>

                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

    
    <div class="modal fade bs-modal-md in" id="eventDetailModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                    <button type="button" class="btn blue"><?php echo app('translator')->get('app.saveChanges'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

    
    <div class="modal fade bs-modal-md in"  id="subTaskModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="subTaskModelHeading">Sub Task e</span>
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
        <!-- /.modal-dialog -->.
    </div>
    

    
    <div class="modal fade bs-modal-md in" id="taskCategoryModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <!-- /.modal-dialog -->.
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/lobipanel/dist/js/lobipanel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

    <!--slimscroll JavaScript -->
    <script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"></script>

    <script>
        $('#add-column').click(function () {
            $('#add-column-form').toggle();
        })
        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });

        loadData();
        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '<?php echo e($global->date_picker_format); ?>',
            language: '<?php echo e($global->locale); ?>',
            autoclose: true
        });
        // Colorpicker

        $(".colorpicker").asColorPicker();


        $('#save-form').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('admin.taskboard.store')); ?>',
                container: '#addColumn',
                data: $('#addColumn').serialize(),
                type: "POST"
            })
        });

        $('body').on('click', '.edit-type', function () {
            var id = $(this).data('column-id');
            var url = '<?php echo e(route("admin.taskboard.edit", ':id')); ?>';
            url = url.replace(':id', id);

            $('#modelHeading').html("<?php echo e(__('app.edit')." ".__('modules.lead.leadStatus')); ?>");
            $.ajaxModal('#eventDetailModal', url);
        })

        $('#createTaskCategory').click(function(){
            var url = '<?php echo e(route('admin.taskCategory.create-cat')); ?>';
            $('#modelHeading').html("<?php echo app('translator')->get('modules.taskCategory.manageTaskCategory'); ?>");
            $.ajaxModal('#taskCategoryModal',url);
        });

        
            
            
            

            
                
                
                
                
            
        

        $('#apply-filters').click(function () {
            loadData();
        });
        $('#reset-filters').click(function () {
            $('.select2').val('all');
            $('.select2').trigger('change');

            $('#start-date').val('<?php echo e($startDate); ?>');
            $('#end-date').val('<?php echo e($endDate); ?>');

            loadData();
        })

        $('.toggle-filter').click(function () {
            $('#ticket-filters').slideToggle();
        })

        function loadData () {
            var startDate = $('#start-date').val();

            if (startDate == '') {
                startDate = null;
            }

            var endDate = $('#end-date').val();

            if (endDate == '') {
                endDate = null;
            }

            var projectID = $('#project_id').val();
            var clientID = $('#clientID').val();
            var assignedBY = $('#assignedBY').val();
            var assignedTo = $('#assignedTo').val();

            var url = '<?php echo e(route('admin.taskboard.index')); ?>?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate) +'&clientID='+clientID +'&assignedBY='+ assignedBY+'&assignedTo='+ assignedTo+'&projectID='+ projectID;

            $.easyAjax({
                url: url,
                container: '.container-row',
                type: "GET",
                success: function (response) {
                    $('.container-row').html(response.view);
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                }
            })
        }

        //    update task
        function storeTask() {
            $.easyAjax({
                url: '<?php echo e(route('admin.all-tasks.store')); ?>',
                container: '#storeTask',
                type: "POST",
                data: $('#storeTask').serialize(),
                success: function (response) {
                    if (response.taskID) {
                        window.location.reload();
                    }
                }
            })
        };

        $('#my-tasks').click(function () {
            $('#assignedTo').val('<?php echo e($user->id); ?>');
            toggleFilter();
        });

        $('#show-all-tasks').click(function () {
            $('#assignedTo').val('all');
            toggleFilter();
        });

        function toggleFilter(){
            $('#assignedTo').select2().trigger('change');
            $('#show-all-tasks').toggle();
            $('#my-tasks').toggle();
            loadData()
        }
    </script>

    <script>
        $('#toggle_fullscreen').on('click', function(){
        // if already full screen; exit
        // else go fullscreen
        if (
            document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement
        ) {
            if (document.exitFullscreen) {
            document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
            }
        } else {
            element = $('.container-scroll').get(0);
            if (element.requestFullscreen) {
            element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
            }
        }
        });
    </script>
    <script>

        $('ul.showProjectTabs .projectTaskBoard').addClass('tab-current');
    </script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('pusher-event'); ?>
    <script>
    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('task-updated-channel');
    channel.bind('task-updated', function(data) {
        let authId = "<?php echo e($user->id); ?>";
        if (data.user_id != authId) {
            loadData();
        }

    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/tasks/kanbanboard.blade.php ENDPATH**/ ?>