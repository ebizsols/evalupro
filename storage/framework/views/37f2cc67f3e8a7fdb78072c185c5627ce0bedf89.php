<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?> #<?php echo e($project->id); ?> - <span
                        class="font-bold"><?php echo e(ucwords($project->project_name)); ?></span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('app.menu.invoices'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<style>
    .dropdown-content {
        width: 250px;
        max-height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
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
                            <div class="row">
                                <div class="col-xs-12" id="invoices-list-panel">
                                    <div class="white-box">
                                        <h2><?php echo app('translator')->get('app.menu.invoices'); ?></h2>

                                        <div class="row m-b-10">
                                            <div class="col-xs-12">
                                                <a href="javascript:;" id="show-invoice-modal"
                                                   class="btn btn-success btn-outline"><i class="ti-plus"></i> <?php echo app('translator')->get('modules.invoices.addInvoice'); ?></a>
                                            </div>
                                        </div>

                                        <ul class="list-group" id="invoices-list">
                                            <?php $__empty_1 = true; $__currentLoopData = $project->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-5 col-xs-12">
                                                            <?php echo e($invoice->invoice_number); ?>

                                                        </div>
                                                        <div class="col-sm-2">
                                                            <?php echo e(currency_position($invoice->total, $invoice->currency->currency_symbol)); ?>

                                                        </div>
                                                        <div class="col-sm-2 col-xs-12">
                                                            <?php if($invoice->credit_note): ?>
                                                                <label class="label label-warning">
                                                                    <?php echo e(strtoupper(__('app.credit-note'))); ?>

                                                                </label>
                                                            <?php else: ?>
                                                                <?php if($invoice->status == 'unpaid'): ?>
                                                                    <label class="label label-danger">
                                                                        <?php echo e(strtoupper($invoice->status)); ?>

                                                                    </label>
                                                                <?php elseif($invoice->status == 'paid'): ?>
                                                                    <label class="label label-success">
                                                                        <?php echo e(strtoupper($invoice->status)); ?>

                                                                    </label>
                                                                <?php elseif($invoice->status == 'canceled'): ?>
                                                                    <label class="label label-danger">
                                                                        <?php echo e(strtoupper($invoice->status)); ?>

                                                                    </label>
                                                                <?php else: ?>
                                                                    <label class="label label-info">
                                                                        <?php echo e(strtoupper(__('modules.invoices.partial'))); ?>

                                                                    </label>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12">
                                                            <span class=""><?php echo e($invoice->issue_date->format($global->date_format)); ?></span>
                                                            <a href="<?php echo e(route('admin.invoices.download', $invoice->id)); ?>" data-toggle="tooltip" data-original-title="Download" class="btn btn-default btn-circle m-l-10"><i class="fa fa-download"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <?php echo app('translator')->get('messages.noInvoice'); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </section>

                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

    
    <div class="modal fade bs-modal-lg in" id="add-invoice-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

    
    <div class="modal fade bs-modal-md in" id="taxModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    <?php echo app('translator')->get('app.loading'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                    <button type="button" class="btn blue"><?php echo app('translator')->get('app.save'); ?> <?php echo app('translator')->get('changes'); ?></button>
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

<script>
    $('#show-invoice-modal').click(function(){
        var url = '<?php echo e(route('admin.invoices.createInvoice', $project->id)); ?>';
        $('#modelHeading').html('Add Invoice');
        $.ajaxModal('#add-invoice-modal',url);
    })

    $('body').on('click', '.sa-params', function () {
        var id = $(this).data('invoice-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteRecoverInvoice'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('admin.invoices.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                            $('#invoices-list-panel ul.list-group').html(response.html);

                        }
                    }
                });
            }
        });
    });
    $('ul.showProjectTabs .projectInvoices').addClass('tab-current');
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/invoices/show.blade.php ENDPATH**/ ?>