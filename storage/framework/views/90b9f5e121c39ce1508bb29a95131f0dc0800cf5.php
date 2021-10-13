<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-10 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.all-time-logs.active-timelogs')); ?>"
                class="btn btn-primary btn-sm "><i
                         class="fa fa-clock-o"></i> <?php echo app('translator')->get('modules.projects.activeTimers'); ?>
                <span class="badge badge-purple activeCurrentTimerCount"><?php echo e($activeTimers); ?></span>
            </a>
            <a href="<?php echo e(route('admin.all-time-logs.calendar')); ?>"
                class="btn btn-inverse btn-sm "><i
                        class="fa fa-calendar"></i> <?php echo app('translator')->get('modules.leaves.calendarView'); ?>
            </a>
            
            <a href="<?php echo e(route('admin.all-invoices.create', ['type' => 'timelog'])); ?>"
                class="btn btn-inverse btn-outline btn-sm"><i
                         class="fa fa-plus"></i> <?php echo app('translator')->get('app.create'); ?> <?php echo app('translator')->get('app.invoice'); ?>
            </a>
            <a href="<?php echo e(route('admin.all-time-logs.by-employee')); ?>"
                class="btn btn-primary btn-outline btn-sm"><i
                         class="fa fa-user"></i> <?php echo app('translator')->get('app.employee'); ?> <?php echo app('translator')->get('app.menu.timeLogs'); ?>
            </a>
            <a href="javascript:;" id="show-add-form"
                class="btn btn-success btn-sm btn-outline"><i
                        class="fa fa-clock-o"></i> <?php echo app('translator')->get('modules.timeLogs.logTime'); ?>
            </a>
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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css')); ?>">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('filter-section'); ?>
<div class="row m-b-10">
    <?php echo Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']); ?>

    <div class="col-xs-12">
        <div class="example">
            <h5 class="box-title m-t-30"><?php echo app('translator')->get('app.selectDateRange'); ?></h5>
            <div class="input-daterange input-group" id="date-range">
                <input type="text" class="form-control" id="start-date" autocomplete="off" placeholder="<?php echo app('translator')->get('app.startDate'); ?>" value="" />
                <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                <input type="text" class="form-control" id="end-date" autocomplete="off" placeholder="<?php echo app('translator')->get('app.endDate'); ?>" value="" />
            </div>
        </div>
        </div>
    <?php if(in_array('projects', $modules)): ?>
        <div class="col-md-12 m-t-20">
            <h5 class="box-title"><?php echo app('translator')->get('app.selectProject'); ?></h5>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xs-12">
                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.selectProject'); ?>" id="project_id">
                            <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->id); ?>"><?php echo e(ucwords($project->project_name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="col-xs-12">
            <h5 class="box-title">
                <?php echo app('translator')->get('app.selectTask'); ?>
            </h5>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xs-12">
                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.selectTask'); ?>" id="task_id">
                            <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($task->id); ?>"><?php echo e(ucwords($task->heading)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-xs-12">
        <div class="form-group">
            <h5 class="box-title"><?php echo app('translator')->get('modules.employees.title'); ?></h5>
            <select class="form-control select2" name="employee" id="employee" data-style="form-control">
                <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($employee->id); ?>"><?php echo e(ucfirst($employee->name)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <h5 class="box-title"><?php echo app('translator')->get('app.invoiceGenerate'); ?></h5>
            <select class="form-control select2" name="invoice_generate" id="invoice_generate" data-style="form-control">
                <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                <option value="1"><?php echo app('translator')->get('app.yes'); ?></option>
                <option value="0"><?php echo app('translator')->get('app.no'); ?></option>
            </select>
        </div>
    </div>

    <div class="col-xs-12">
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
        <div class="col-xs-12" >
            <div class="white-box">

                <div class="row">
                    <div class="col-md-12 hide" id="hideShowTimeLogForm">
                        <?php echo Form::open(['id'=>'logTime','class'=>'ajax-form','method'=>'POST']); ?>

                            <div class="form-body">
                                <div class="row m-t-30">
                                    <?php if(in_array('projects', $modules)): ?>
                                        <div class="col-md-4 ">
                                            <div class="form-group">
                                                <label class="required"><?php echo app('translator')->get('app.selectProject'); ?></label>
                                                <select class="select2 form-control" name="project_id" data-placeholder="<?php echo app('translator')->get('app.selectProject'); ?>"  id="project_id2">
                                                    <option value="">--</option>
                                                    <?php $__currentLoopData = $timeLogProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($project->id); ?>"><?php echo e(ucwords($project->project_name)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-md-4 ">
                                        <div class="form-group">

                                            <label class="required"><?php echo app('translator')->get('app.selectTask'); ?></label>
                                            <select class="select2 form-control" name="task_id"             data-placeholder="<?php echo app('translator')->get('app.selectTask'); ?>" id="task_id2">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $timeLogTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($task->id); ?>"><?php echo e(ucwords($task->heading)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 " id="employeeBox">
                                        <div class="form-group">
                                            <label class="required"><?php echo app('translator')->get('modules.timeLogs.employeeName'); ?></label>
                                            <select class="form-control" name="user_id"
                                                    id="user_id" data-style="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('modules.timeLogs.startDate'); ?></label>
                                            <input id="start_date" name="start_date" type="text"
                                                   class="form-control"
                                                   value="<?php echo e(\Carbon\Carbon::today()->format($global->date_format)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('modules.timeLogs.endDate'); ?></label>
                                            <input id="end_date" name="end_date" type="text"
                                                   class="form-control"
                                                   value="<?php echo e(\Carbon\Carbon::today()->format($global->date_format)); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group bootstrap-timepicker timepicker">
                                            <label><?php echo app('translator')->get('modules.timeLogs.startTime'); ?></label>
                                            <input type="text" name="start_time" id="start_time"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group bootstrap-timepicker timepicker">
                                            <label><?php echo app('translator')->get('modules.timeLogs.endTime'); ?></label>
                                            <input type="text" name="end_time" id="end_time"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for=""><?php echo app('translator')->get('modules.timeLogs.totalHours'); ?></label>

                                        <p id="total_time" class="form-control-static">0 Hrs</p>
                                    </div>
                                </div>

                                <div class="row m-t-20">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="memo" class="required"><?php echo app('translator')->get('modules.timeLogs.memo'); ?></label>
                                            <input type="text" name="memo" id="memo"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions m-t-30">
                                <button type="button" id="save-form" class="btn btn-success"><i
                                            class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>

                                <button type="button" id="close-form" class="btn btn-default"><i
                                                class="fa fa-times"></i> <?php echo app('translator')->get('app.close'); ?></button>
                            </div>
                            <?php echo Form::close(); ?>

                        <hr>
                    </div>
                </div>
                <div class="table-responsive m-t-30">
                    <?php echo $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']); ?>

                </div>

            </div>
        </div>

    </div>
    <!-- .row -->

    
    <div class="modal fade bs-modal-md in" id="editTimeLogModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>

<?php echo $dataTable->scripts(); ?>


<script>
    // $('#employeeBox').hide();

    $('#close-form').click(function () {
        $('#hideShowTimeLogForm').addClass('hide');
    });

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.time-logs.store')); ?>',
            container: '#logTime',
            type: "POST",
            data: $('#logTime').serialize(),
            success: function (data) {
                if (data.status == 'success') {
                    showTable();
                    $('#hideShowTimeLogForm').toggleClass('hide', 'show');
                    $('#logTime')[0].reset();
                    $('#project_id2').val('');
                    $('#project_id2').select2();
                    $('#task_id2').val('');
                    $('#task_id2').select2();
                }
            }
        })
    });

    $('#project_id2').change(function () {
        var id = $(this).val();
        var url = '<?php echo e(route('admin.all-time-logs.members', ':id')); ?>';
        url = url.replace(':id', id);
        // $('#employeeBox').show();
        $.easyAjax({
            url: url,
            type: "GET",
            redirect: true,
            success: function (data) {
                $('#user_id').html(data.html);
                $('#task_id2').html(data.tasks);
                $('#user_id, #task_id2').select2();
                $("#task_id2").trigger('change');
            }
        })
    });

    $('#task_id2').change(function () {
        var id = $(this).val();
        var url = '<?php echo e(route('admin.all-time-logs.task-members', ':id')); ?>';
        url = url.replace(':id', id);
        // $('#employeeBox').show();
        $.easyAjax({
            url: url,
            type: "GET",
            redirect: true,
            success: function (data) {
                $('#user_id').html(data.html);
                $('#user_id, #task_id2').select2();
            }
        })
    });

    $('#show-add-form').click(function () {
        $('#hideShowTimeLogForm').toggleClass('hide', 'show');
    });
    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });

    jQuery('#date-range').datepicker({
        toggleActive: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    });

    var table;

    $('#all-time-logs-table').on('preXhr.dt', function (e, settings, data) {
        var startDate = $('#start-date').val();

        if(startDate == ''){
            startDate = null;
        }

        var endDate = $('#end-date').val();

        if(endDate == ''){
            endDate = null;
        }

        var projectID = $('#project_id').val();
        if (!projectID) {
            projectID = '';
        }

        var taskId = $('#task_id').val();
        var employee = $('#employee').val();
        var approved = $('#approved').val();
        var invoice = $('#invoice_generate').val();

        data['startDate'] = startDate;
        data['endDate'] = endDate;
        data['projectId'] = projectID;
        data['taskId']    = taskId;
        data['employee'] = employee;
        data['approved'] = approved;
        data['invoice'] = invoice;
    });

    function showTable(){
        window.LaravelDataTables["all-time-logs-table"].draw();
    }

    $('#filter-results').click(function () {
        showTable();
    });

    $('#reset-filters').click(function () {
        $('.select2').val('all');
        $('.select2').trigger('change');

        $('#start-date').val('<?php echo e($startDate); ?>');
        $('#end-date').val('<?php echo e($endDate); ?>');

        showTable();
    });

    $('body').on('click', '.sa-params', function(){
        var id = $(this).data('time-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteTimeLog'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.all-time-logs.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["all-time-logs-table"].draw();
                        }
                    }
                });
            }
        });
    });


    $('body').on('click', '.approve-timelog', function(){
        var id = $(this).data('time-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: '<?php echo app('translator')->get("app.yes"); ?>',
            cancelButtonText: '<?php echo app('translator')->get("app.no"); ?>',
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.all-time-logs.approve-timelog')); ?>";

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, id: id},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            showTable();
                        }
                    }
                });
            }
        });
    });

    $('#timer-list').on('click', '.stop-timer', function () {
        var id = $(this).data('time-id');
        var url = '<?php echo e(route('admin.all-time-logs.stopTimer', ':id')); ?>';
        url = url.replace(':id', id);
        var token = '<?php echo e(csrf_token()); ?>';
        $.easyAjax({
            url: url,
            type: "POST",
            data: {timeId: id, _token: token},
            success: function (data) {
                $('#timer-list').html(data.html);
                $('#activeCurrentTimerCount').html(data.activeTimers);
            }
        })

    });

    $('body').on('click', '.edit-time-log', function () {
        var id = $(this).data('time-id');

        var url = '<?php echo e(route('admin.time-logs.edit', ':id')); ?>';
        url = url.replace(':id', id);

        $('#modelHeading').html('Update Time Log');
        $.ajaxModal('#editTimeLogModal', url);

    });

    function exportTimeLog(){

        var startDate = $('#start-date').val();

        if(startDate == ''){
            startDate = null;
        }

        var endDate = $('#end-date').val();

        if(endDate == ''){
            endDate = null;
        }

        var projectID = $('#project_id').val();
        var employee = $('#employee').val();

        var url = '<?php echo e(route('admin.all-time-logs.export', [':startDate', ':endDate', ':projectId', ':employee'])); ?>';
        url = url.replace(':startDate', startDate);
        url = url.replace(':endDate', endDate);
        url = url.replace(':projectId', projectID);
        url = url.replace(':employee', employee);

        window.location.href = url;
    }

    $('#start_time, #end_time').timepicker({
        <?php if($global->time_format == 'H:i'): ?>
        showMeridian: false
        <?php endif; ?>
    }).on('hide.timepicker', function (e) {
        calculateTime();
    });

    jQuery('#start_date, #end_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    }).on('hide', function (e) {
        calculateTime();
    });

    function calculateTime() {
        var format = '<?php echo e($global->moment_format); ?>';
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();

        startDate = moment(startDate, format).format('YYYY-MM-DD');
        endDate = moment(endDate, format).format('YYYY-MM-DD');

        var timeStart = new Date(startDate + " " + startTime);
        var timeEnd = new Date(endDate + " " + endTime);

        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds

        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        if (hours < 0 || minutes < 0) {
            var numberOfDaysToAdd = 1;
            timeEnd.setDate(timeEnd.getDate() + numberOfDaysToAdd);
            var dd = timeEnd.getDate();

            if (dd < 10) {
                dd = "0" + dd;
            }

            var mm = timeEnd.getMonth() + 1;

            if (mm < 10) {
                mm = "0" + mm;
            }

            var y = timeEnd.getFullYear();

            // $('#end_date').val(mm + '/' + dd + '/' + y);
            calculateTime();
        } else {
            $('#total_time').html(hours + "Hrs " + minutes + "Mins");
        }

//        console.log(hours+" "+minutes);
    }

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/time-logs/index.blade.php ENDPATH**/ ?>