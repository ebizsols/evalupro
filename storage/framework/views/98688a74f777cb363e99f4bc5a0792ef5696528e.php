<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.css')); ?>">
    <style>
        .list-group{
            margin-bottom:0px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo app('translator')->get($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
   
        <div class="col-lg-9 col-sm-4 col-md-4 col-xs-12">
            <div class="col-lg-12 col-md-12 pull-right hidden-xs hidden-sm">
                <?php echo Form::open(['id'=>'createProject','class'=>'ajax-form','method'=>'POST']); ?>

                <?php echo Form::hidden('dashboard_type', 'admin-client-dashboard'); ?>

                <div class="btn-group dropdown keep-open pull-right m-l-10">
                    <button aria-expanded="true" data-toggle="dropdown"
                            class="btn bg-white b-all dropdown-toggle waves-effect waves-light"
                            type="button"><i class="icon-settings"></i>
                    </button>
                    <ul role="menu" class="dropdown-menu  dropdown-menu-right dashboard-settings">
                            <li class="b-b"><h4><?php echo app('translator')->get('modules.dashboard.dashboardWidgets'); ?></h4></li>

                        <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $wname = \Illuminate\Support\Str::camel($widget->widget_name);
                            ?>
                            <li>
                                <div class="checkbox checkbox-info ">
                                    <input id="<?php echo e($widget->widget_name); ?>" name="<?php echo e($widget->widget_name); ?>" value="true"
                                        <?php if($widget->status): ?>
                                            checked
                                        <?php endif; ?>
                                            type="checkbox">
                                    <label for="<?php echo e($widget->widget_name); ?>"><?php echo app('translator')->get('modules.dashboard.' . $wname); ?></label>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <li>
                            <button type="button" id="save-form" class="btn btn-success btn-sm btn-block"><?php echo app('translator')->get('app.save'); ?></button>
                        </li>

                    </ul>
                </div>
                <?php echo Form::close(); ?>

                
                <select class="selectpicker language-switcher  pull-right" data-width="fit">
                    <option value="en" <?php if($global->locale == "en"): ?> selected <?php endif; ?> data-content='<span class="flag-icon flag-icon-gb" title="English"></span>'>En</option>
                    <?php $__currentLoopData = $languageSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($language->language_code); ?>" <?php if($global->locale == $language->language_code): ?> selected <?php endif; ?>  data-content='<span class="flag-icon flag-icon-<?php echo e($language->language_code); ?>" title="<?php echo e(ucfirst($language->language_name)); ?>"></span>'><?php echo e($language->language_code); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo app('translator')->get($pageTitle); ?></li>
            </ol>

        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.carousel.min.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.theme.default.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">
    <style>
        .col-in {padding: 0 20px !important;}
        .fc-event {font-size: 10px !important;}
        .dashboard-settings {padding-bottom: 8px !important;}
        .customChartCss { height: 100% !important; }
        .customChartCss svg { height: 400px; }
        @media (min-width: 769px) {
            #wrapper .panel-wrapper {height: 530px;overflow-y: auto;}
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="white-box">
        <div class="row">
            <div class="col-xs-12 m-b-10" style="display: flex;align-items: center;">
                <label style="font-size: 13px;margin-bottom: 0;margin-right: 10px;"><?php echo app('translator')->get('app.selectDateRange'); ?></label>
                <div class="input-daterange input-group" id="date-range" style="margin-right: 10px;">
                    <input type="text" class="form-control" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>" style="width: 110px;"
                        value="<?php echo e(\Carbon\Carbon::parse($fromDate)->timezone($global->timezone)->format($global->date_format)); ?>"/>
                    <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                    <input type="text" class="form-control" id="end-date" placeholder="<?php echo app('translator')->get('app.endDate'); ?>" style="width: 110px;"
                        value="<?php echo e(\Carbon\Carbon::parse($toDate)->timezone($global->timezone)->format($global->date_format)); ?>"/>
                </div>
                <button type="button" id="apply-filters" class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
            </div>
            
        </div>
    </div>

    <div class="white-box" id="dashboard-content">
             
    </div>

    <div class="modal fade bs-example-modal-md" id="leave-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">...</h4>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    
    <div class="modal fade bs-modal-md in" id="invoiceUploadModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"><?php echo app('translator')->get('modules.invoices.uploadInvoice'); ?></span>
                </div>
                <div class="modal-body">
                    <div class="row" id="file-dropzone">
                        <div class="row m-b-20" id="file-dropzone">
                            <div class="col-xs-12">
                                <form action="<?php echo e(route('admin.invoiceFile.store')); ?>"
                                      class="dropzone"
                                      id="file-upload-dropzone">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="fallback">
                                        <input name="file" type="file" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                    <button type="button" class="btn blue" data-dismiss="modal"><?php echo app('translator')->get('app.save'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

<?php $__env->stopSection(); ?>


<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/responsive.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>



<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>

<!--weather icon -->

<script src="<?php echo e(asset('plugins/bower_components/calendar/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/locale-all.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.js')); ?>"></script>

<script>

    var startDate = '';
    var endDate = '';

    function getLatestDate(){
        startDate = $('#start-date').val();
        if (startDate == '') { startDate = null; }
        endDate = $('#end-date').val();
        if (endDate == '') { endDate = null; }

        startDate = encodeURIComponent(startDate);
        endDate = encodeURIComponent(endDate);
    }

    $(function() {
        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '<?php echo e($global->date_picker_format); ?>',
            language: '<?php echo e($global->locale); ?>',
            autoclose: true
        });
    });
    $('#apply-filters').click(function() {
        getLatestDate();
        loadData();
    })
    
    getLatestDate();
    loadData();

    $('.keep-open .dropdown-menu').on({
        "click":function(e){
        e.stopPropagation();
        }
    });

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.dashboard.widget', "admin-finance-dashboard")); ?>',
            container: '#createProject',
            type: "POST",
            redirect: true,
            data: $('#createProject').serialize(),
            success: function(){
                window.location.reload();
            }
        })
    });

    function loadData () {
        var url = '<?php echo e(route('admin.financeDashboard')); ?>?startDate=' + startDate + '&endDate=' + endDate;

        $.easyAjax({
            url: url,
            container: '#dashboard-content',
            type: "GET",
            success: function (response) {
                $('#dashboard-content').html(response.view);
            }
        })
    }

    $(document).on('click', '.view-expense', function () {
        var id = $(this).data('expense-id');
        var url = "<?php echo e(route('admin.expenses.show',':id')); ?>";
        url = url.replace(':id', id);

        $('#modelHeading').html('...');
        $.ajaxModal('#leave-details', url);
    });

    $('body').on('click', '.view-payment', function () {
        var id = $(this).data('payment-id');
        var url = '<?php echo e(route('admin.payments.show', ":id")); ?>';
        url = url.replace(':id', id);

        $.ajaxModal('#leave-details', url);
    })

    $('body').on('click', '.delete-expense', function(){
        var id = $(this).data('expense-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.recoverExpense'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.expenses.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["expenses-table"].draw();
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '.delete-payment', function(){
        var id = $(this).data('payment-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.recoverPaymentRecord'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.payments.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["payments-table"].draw();
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '.reminderButton', function(){
        var id = $(this).data('invoice-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.assignClient'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.sendConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.all-invoices.payment-reminder',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["invoices-table"].draw();
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '#invoice .sendButton', function(){
        var id = $(this).data('invoice-id');
        var url = "<?php echo e(route('admin.all-invoices.send-invoice',':id')); ?>";
        url = url.replace(':id', id);

        var token = "<?php echo e(csrf_token()); ?>";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token},
            success: function (response) {
                if (response.status == "success") {
                    window.LaravelDataTables["invoices-table"].draw();
                }
            }
        });
    });

    $('body').on('click', '.unpaidAndPartialPaidCreditNote', function(){
        var id = $(this).data('invoice-id');
        swal({
            title: "<?php echo app('translator')->get('messages.confirmation.confirmCreditNotes'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.nonPaidInvoice'); ?>",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.createConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.all-credit-notes.convert-invoice',':id')); ?>";
                url = url.replace(':id', id);

                location.href = url;
            }
        });
    });

    function addShippingAddress(invoiceId) {
        let url = "<?php echo e(route('admin.all-invoices.shippingAddressModal', ':id')); ?>";
        url = url.replace(':id', invoiceId);

        $.ajaxModal('#leave-details', url);
    }

    // Change Status As cancelled
    $('body').on('click', '.sa-cancel', function(){
        var id = $(this).data('invoice-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.cancelInvoice'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.doIt'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.all-invoices.update-status',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'GET',
                        url: url,
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["invoices-table"].draw();
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '#estimate .sendButton', function(){
        var id = $(this).data('estimate-id');
        var url = "<?php echo e(route('admin.estimates.send-estimate',':id')); ?>";
        url = url.replace(':id', id);

        var token = "<?php echo e(csrf_token()); ?>";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token},
            success: function (response) {
                if (response.status == "success") {
                    window.LaravelDataTables["estimates-table"].draw();
                }
            }
        });
    });

    $('body').on('click', '#estimate .sa-params', function(){
        var id = $(this).data('estimate-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteEstimate'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.estimates.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["estimates-table"].draw();
                        }
                    }
                });
            }
        });
    });
    
    $('#invoice').on('click', '.invoice-upload', function(){
        var invoiceId = $(this).data('invoice-id');
        $('#file-upload-dropzone').prepend('<input name="invoice_id", value="' + invoiceId + '" type="hidden">');
    });

    Dropzone.options.fileUploadDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        dictDefaultMessage: "<?php echo app('translator')->get('modules.projects.dropFile'); ?>",
        uploadMultiple: false,
        dictCancelUpload: "Cancel",
        accept: function (file, done) {
            done();
        },
        init: function () {
            this.on('addedfile', function(){
                if(this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on("success", function (file, response) {
            });
            var newDropzone = this;

            $('#invoiceUploadModal').on('hide.bs.modal', function(){
                newDropzone.removeAllFiles(true);
            });

        }
    };

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/dashboard/finance.blade.php ENDPATH**/ ?>