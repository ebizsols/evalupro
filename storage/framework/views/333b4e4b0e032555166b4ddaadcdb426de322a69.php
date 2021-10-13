<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">

        <!-- .page title -->
        <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($totalClients); ?></span> <span
                        class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.dashboard.totalClients'); ?></span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-4 col-sm-6 col-md-7 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.clients.create')); ?>"
            class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('modules.client.addNewClient'); ?> <i class="fa fa-plus"
                                                                                               aria-hidden="true"></i></a>
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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
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
                <h5 ><?php echo app('translator')->get('app.client'); ?></h5>
                <select class="form-control select2" name="client" id="client" data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5><?php echo app('translator')->get('app.category'); ?></h5>
                <select class="form-control select2" name="category_id" id="category_id"
                        data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->category_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5><?php echo app('translator')->get('modules.productCategory.subCategory'); ?></h5>
                <select class="form-control select2" name="sub_category_id" id="sub_category_id"
                        data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->category_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <h5><?php echo app('translator')->get('modules.logTimeSetting.project'); ?></h5>
                <select class="form-control select2" name="project_id" id="project_id"
                        data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($project->id); ?>"><?php echo e($project->project_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5><?php echo app('translator')->get('modules.contracts.contractType'); ?></h5>
                <select class="form-control select2" name="contract_type_id" id="contract_type_id"
                        data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($contract->id); ?>"><?php echo e($contract->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5><?php echo app('translator')->get('modules.stripeCustomerAddress.country'); ?></h5>
                <select class="form-control select2" name="country_id" id="country_id"
                        data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->nicename); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php echo $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']); ?>

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
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>

    <?php echo $dataTable->scripts(); ?>


    <script>
        var subCategories = <?php echo json_encode($subcategories, 15, 512) ?>;
        $('#category_id').change(function (e) {
            // get projects of selected users
            var opts = '';

            var subCategory = subCategories.filter(function (item) {
                return item.category_id == e.target.value
            });
            subCategory.forEach(project => {
                console.log(project);
            opts += `<option value='${project.id}'>${project.category_name}</option>`
        })

            $('#sub_category_id').html('<option value="0">Select Sub Category...</option>'+opts)
            $("#sub_category_id").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
        });
        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '<?php echo e($global->date_picker_format); ?>',
            language: '<?php echo e($global->locale); ?>',
            autoclose: true,
            weekStart:'<?php echo e($global->week_start); ?>',
        });
        var table;
        $(function () {
            $('body').on('click', '.sa-params', function () {
                var id = $(this).data('user-id');
                swal({
                    title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                    text: "<?php echo app('translator')->get('messages.confirmation.recoverDeleteUser'); ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                    cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm){
                    if (isConfirm) {

                        var url = "<?php echo e(route('admin.clients.destroy',':id')); ?>";
                        url = url.replace(':id', id);

                        var token = "<?php echo e(csrf_token()); ?>";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.easyBlockUI('#clients-table');
                                    window.LaravelDataTables["clients-table"].draw();
                                    $.easyUnblockUI('#clients-table');
                                }
                            }
                        });
                    }
                });
            });

        });

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        })

        $('#apply-filters').click(function () {
            $('#clients-table').on('preXhr.dt', function (e, settings, data) {
                var startDate = $('#start-date').val();

                if (startDate == '') {
                    startDate = null;
                }

                var endDate = $('#end-date').val();

                if (endDate == '') {
                    endDate = null;
                }
                var category_id = $('#category_id').val();
                var sub_category_id = $('#sub_category_id').val();
                var project_id = $('#project_id').val();
                var contract_type_id = $('#contract_type_id').val();
                var country_id = $('#country_id').val();

                var client = $('#client').val();
                data['startDate'] = startDate;
                data['endDate'] = endDate;
                data['client'] = client;
                data['category_id'] = category_id;
                data['sub_category_id'] = sub_category_id;
                data['project_id'] = project_id;
                data['contract_type_id'] = contract_type_id;
                data['country_id'] = country_id;

            });
            $.easyBlockUI('#clients-table');
            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');
        });

        $('#reset-filters').click(function () {
            $('#filter-form')[0].reset();
            $('.select2').val('all');
            $('#filter-form').find('select').select2();

            $.easyBlockUI('#clients-table');
            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');
        })

        function exportData(){

            var client = $('#client').val();
            var status = $('#status').val();

            var url = '<?php echo e(route('admin.clients.export', [':status', ':client'])); ?>';
            url = url.replace(':client', client);
            url = url.replace(':status', status);

            window.location.href = url;
        }

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/clients/index.blade.php ENDPATH**/ ?>