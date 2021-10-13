<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="javascript:;" id="createTaskCategory" class="btn btn-sm btn-outline btn-info"><i class="fa fa-plus"></i> <?php echo app('translator')->get('modules.taskCategory.addTaskCategory'); ?></a>
            <a href="javascript:;"  class="btn btn-outline btn-info btn-sm pinnedItem"><?php echo app('translator')->get('app.pinnedTask'); ?> <i class="icon-pin icon-2"></i></a>
            <a href="<?php echo e(route('admin.all-tasks.create')); ?>" class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('modules.tasks.newTask'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="<?php echo e(route('admin.task-label.index')); ?>" class="btn btn-outline btn-primary btn-sm"> <?php echo app('translator')->get('app.menu.taskLabel'); ?> </a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<style>
    .swal-footer {
        text-align: center !important;
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('filter-section'); ?>
    <div class="row m-b-10">
        <?php echo Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']); ?>

        <div class="col-xs-12">
            <div class="example">
                <h5 class="box-title"><?php echo app('translator')->get('app.selectDateRange'); ?></h5>

                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                            value=""/>
                    <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                    <input type="text" class="form-control" id="end-date" placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                            value=""/>
                </div>
            </div>
        </div>

            <?php if(in_array('projects', $modules)): ?>
                <div class="col-xs-12">
                    <h5 class="box-title"><?php echo app('translator')->get('app.selectProject'); ?></h5>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.selectProject'); ?>" id="project_id">
                                    <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                                value="<?php echo e($project->id); ?>"><?php echo e(ucwords($project->project_name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xs-12">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.client'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.client'); ?>" id="clientID">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                            value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('modules.tasks.assignTo'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.tasks.assignTo'); ?>" id="assignedTo">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                            value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('modules.tasks.assignBy'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.tasks.assignBy'); ?>" id="assignedBY">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                            value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.status'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('status'); ?>" id="status">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $taskBoardStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->id); ?>"><?php echo e(ucwords($status->column_name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.label'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="selectpicker form-control" data-placeholder="<?php echo app('translator')->get('app.label'); ?>" id="label">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $taskLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-content="<span class='badge b-all' style='background:<?php echo e($label->label_color); ?>;'><?php echo e($label->label_name); ?></span> " value="<?php echo e($label->id); ?>"><?php echo e($label->label_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <h5 class="box-title"><?php echo app('translator')->get('app.billableTask'); ?></h5>
                    <select class="form-control select2" name="billable" id="billable" data-style="form-control">
                        <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                        <option value="1"><?php echo app('translator')->get('app.yes'); ?></option>
                        <option value="0"><?php echo app('translator')->get('app.no'); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12">

                <div class="checkbox checkbox-info">
                    <input type="checkbox" id="hide-completed-tasks" checked>
                    <label for="hide-completed-tasks"><?php echo app('translator')->get('app.hideCompletedTasks'); ?></label>
                </div>
            </div>

            <div class="col-xs-12">
                </button>
                <div class="form-group">
                    <label class="control-label col-xs-12">&nbsp;</label>
                    <button type="button" id="filter-results" class="btn btn-success col-md-6"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                    <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="white-box">

                    <div class="table-responsive">
                        <?php echo $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']); ?>

                    </div>

                </div>
            </div>

        </div>
        <!-- .row -->

        
        <div class="modal fade bs-modal-md in" id="editTimeLogModal" role="dialog" aria-labelledby="myModalLabel"
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
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn blue">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
        
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <?php if($global->locale == 'en'): ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.<?php echo e($global->locale); ?>-AU.min.js"></script>
    <?php else: ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.<?php echo e($global->locale); ?>.min.js"></script>
    <?php endif; ?>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>

    <?php echo $dataTable->scripts(); ?>


    <script>

        $(document).ready(function(){
            showTable();
        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });

        $('#allTasks-table').on('preXhr.dt', function (e, settings, data) {
            var startDate = $('#start-date').val();

            if (startDate == '') {
                startDate = null;
            }

            var endDate = $('#end-date').val();

            if (endDate == '') {
                endDate = null;
            }

            var projectID = $('#project_id').val();
            if (!projectID) {
                projectID = 0;
            }
            var clientID = $('#clientID').val();
            var assignedBY = $('#assignedBY').val();
            var assignedTo = $('#assignedTo').val();
            var status = $('#status').val();
            var category_id = $('#category_id').val();
            var label = $('#label').val();
             var billable = $('#billable').val();


            if ($('#hide-completed-tasks').is(':checked')) {
                var hideCompleted = '1';
            } else {
                var hideCompleted = '0';
            }

            data['clientID'] = clientID;
            data['assignedBY'] = assignedBY;
            data['assignedTo'] = assignedTo;
            data['status'] = status;
            data['category_id'] = category_id;
            data['hideCompleted'] = hideCompleted;
            data['projectId'] = projectID;
            data['startDate'] = startDate;
            data['endDate'] = endDate;
            data['label'] = label;
            data['billable'] = billable;

        });

        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '<?php echo e($global->date_picker_format); ?>',
            language: '<?php echo e($global->locale); ?>',
            autoclose: true,
            weekStart:'<?php echo e($global->week_start); ?>',
        });

        table = '';

        function showTable() {
            window.LaravelDataTables["allTasks-table"].draw();
        }

        $('#filter-results').click(function () {
            showTable();
        });

        $('#reset-filters').click(function () {
            $('.select2').val('all');
            $('.select2').trigger('change');

            $('#start-date').val('<?php echo e($startDate); ?>');
            $('#end-date').val('<?php echo e($endDate); ?>');

            $(".selectpicker").val('all');
            $(".selectpicker").selectpicker("refresh");

            showTable();
        })


        $('body').on('click', '.sa-params', function () {
            var id = $(this).data('task-id');
            var recurring = $(this).data('recurring');

            var buttons = {
                cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                confirm: {
                    text: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                    value: 'confirm',
                    visible: true,
                    className: "danger",
                }
            };

            if(recurring == 'yes')
            {
                buttons.recurring = {
                    text: "<?php echo e(trans('modules.tasks.deleteRecurringTasks')); ?>",
                    value: 'recurring'
                }
            }

            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.confirmation.recoverDeletedTask'); ?>",
                dangerMode: true,
                icon: 'warning',
                buttons: buttons
            }).then(function (isConfirm) {
                if (isConfirm == 'confirm' || isConfirm == 'recurring') {

                    var url = "<?php echo e(route('admin.all-tasks.destroy',':id')); ?>";
                    url = url.replace(':id', id);

                    var token = "<?php echo e(csrf_token()); ?>";
                    var dataObject = {'_token': token, '_method': 'DELETE'};

                    if(isConfirm == 'recurring')
                    {
                        dataObject.recurring = 'yes';
                    }

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: dataObject,
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                window.LaravelDataTables["allTasks-table"].draw();
                            }
                        }
                    });
                }
            });
        });

        $('#allTasks-table').on('click', '.show-task-detail', function () {
            $(".right-sidebar").slideDown(50).addClass("shw-rside");

            var id = $(this).data('task-id');
            var url = "<?php echo e(route('admin.all-tasks.show',':id')); ?>";
            url = url.replace(':id', id);

            $.easyAjax({
                type: 'GET',
                url: url,
                success: function (response) {
                    if (response.status == "success") {
                        $('#right-sidebar-content').html(response.view);
                    }
                }
            });
        })

        $('#allTasks-table').on('click', '.change-status', function () {
            var url = "<?php echo e(route('admin.tasks.changeStatus')); ?>";
            var token = "<?php echo e(csrf_token()); ?>";
            var id =  $(this).data('task-id');
            var status =  $(this).data('status');

            $.easyAjax({
                url: url,
                type: "POST",
                data: {'_token': token, taskId: id, status: status, sortBy: 'id'},
                success: function (data) {
                    if (data.status == "success") {
                        window.LaravelDataTables["allTasks-table"].draw();
                    }
                }
            })
        })

        $('#createTaskCategory').click(function(){
            var url = '<?php echo e(route('admin.taskCategory.create-cat')); ?>';
            $('#modelHeading').html("<?php echo app('translator')->get('modules.taskCategory.manageTaskCategory'); ?>");
            $.ajaxModal('#taskCategoryModal',url);
        });

        function exportData(){

            var startDate = $('#start-date').val();

            if (startDate == '') {
                startDate = null;
            }

            var endDate = $('#end-date').val();

            if (endDate == '') {
                endDate = null;
            }

            var projectID = $('#project_id').val();
            if (!projectID) {
                projectID = 0;
            }

            if ($('#hide-completed-tasks').is(':checked')) {
                var hideCompleted = '1';
            } else {
                var hideCompleted = '0';
            }

            var url = '<?php echo route('admin.all-tasks.export', [':startDate', ':endDate', ':projectId', ':hideCompleted']); ?>';

            url = url.replace(':startDate', startDate);
            url = url.replace(':endDate', endDate);
            url = url.replace(':hideCompleted', hideCompleted);
            url = url.replace(':projectId', projectID);

            window.location.href = url;
        }

        $('.pinnedItem').click(function(){
            var url = '<?php echo e(route('admin.all-tasks.pinned-task')); ?>';
            $('#modelHeading').html('Pinned Task');
            $.ajaxModal('#taskCategoryModal',url);
        })

    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/tasks/index.blade.php ENDPATH**/ ?>