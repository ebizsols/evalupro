<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">

        <!-- .page title -->
        <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($propertiesCount); ?></span> <span
                        class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('valuation::valuation.property.total'); ?></span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-4 col-sm-6 col-md-7 col-xs-12 text-right">
            <a href="<?php echo e(route('valuation.admin.property.addEditView')); ?>" class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('valuation::valuation.property.createProperty'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('filter-section'); ?>
<div class="row"  id="ticket-filters">
    
    <form action="" id="filter-form">
        <div class="col-xs-12">
            <h5 ><?php echo app('translator')->get('app.selectDateRange'); ?></h5>
            <div class="input-daterange input-group" id="date-range">
                <input type="text" class="form-control" autocomplete="off" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                       value=""/>
                <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                <input type="text" class="form-control" id="end-date"  autocomplete="off" placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                       value=""/>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <h5 >Type</h5>
                <select class="form-control select2" name="client" id="client" data-style="form-control">
                    <option value="all">All</option>
                   
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5>City</h5>
                <select class="form-control select2" name="category_id" id="category_id"
                        data-style="form-control">
                    <option value="all">All</option>
                   
                </select>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group p-t-10">
                <button type="button" id="apply-filters" class="btn btn-success col-md-6"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-xs-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                           id="users-table">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('valuation::valuation.property.sr'); ?></th>
                            <th><?php echo app('translator')->get('valuation::app.id'); ?></th>
                            <th><?php echo app('translator')->get('valuation::valuation.property.title'); ?></th>
                            <th><?php echo app('translator')->get('valuation::valuation.property.propertyType'); ?></th>
                            <th><?php echo app('translator')->get('valuation::valuation.property.propertyCity'); ?></th>
                            <th><?php echo app('translator')->get('valuation::app.action'); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

    <script>

        /*$(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });*/

        var table;
        $(function () {
            loadTable();
            /*$(".data-section").removeClass('col-md-9');
            $(".data-section").addClass('col-md-12');*/

            $('body').on('click', '.sa-params', function () {
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted Data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {

                        var url = "<?php echo e(route('valuation.admin.property.destroy',':id')); ?>";
                        url = url.replace(':id', id);

                        var token = "<?php echo e(csrf_token()); ?>";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unpropertyUI();
//                                    swal("Deleted!", response.message, "success");
                                    table._fnDraw();
                                }
                            }
                        });
                    }
                });
            });

        });

        function loadTable() {
            var startDate = $('#start-date').val();

            if (startDate == '') {
                startDate = null;
            }

            var endDate = $('#end-date').val();

            if (endDate == '') {
                endDate = null;
            }
            var status = $('#status').val();
            var client = $('#client').val();

            table = $('#users-table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: '<?php echo route($dataRoute); ?>?startDate=' + startDate + '&endDate=' + endDate + '&client=' + client + '&status=' + status,
                language: {
                    "url": "<?php echo __("app.datatable") ?>"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [
                    
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    {data: 'city', name: 'city'},
                    {data: 'action', name: 'action'}
                ]
            })
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/Index.blade.php ENDPATH**/ ?>