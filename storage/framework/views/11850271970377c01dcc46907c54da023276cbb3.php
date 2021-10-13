<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($totalProducts); ?></span> <span class="font-12 text-muted m-l-5"><?php echo app('translator')->get('app.total'); ?> <?php echo app('translator')->get('app.menu.products'); ?></span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('app.addNew'); ?> <?php echo app('translator')->get('app.menu.products'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>

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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('filter-section'); ?>
    <form action="" id="filter-form">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label"><?php echo app('translator')->get('modules.productCategory.category'); ?></label>
                    <select class="select2 form-control" name="category_id" id="category_id"
                            data-style="form-control">
                        <option selected value="all"><?php echo app('translator')->get('app.all'); ?></option>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->category_name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <option value=""><?php echo app('translator')->get('messages.noProductCategory'); ?></option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label"><?php echo app('translator')->get('modules.productCategory.subCategory'); ?></label>
                    <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.productCategory.subCategory'); ?>" id="sub_category_id">
                        <option selected value="all"><?php echo app('translator')->get('app.all'); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group p-t-10">
                    <button type="button" class="btn btn-success" id="filter-results"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?>
                    </button>
                    <button type="button" id="reset-filters"
                            class="btn btn-inverse"><i
                                class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                </div>
            </div>

        </div>
    </form>
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
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>

    <?php echo $dataTable->scripts(); ?>

    <script>
        $(function() {

            $(".select2").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            var subCategories = <?php echo json_encode($subCategories, 15, 512) ?>;

            $('#category_id').change(function (e) {
                // get projects of selected users
                var opts = '';

                var subCategory = subCategories.filter(function (item) {
                    return item.category_id == e.target.value
                });
                subCategory.forEach(project => {
                    opts += `<option value='${project.id}'>${project.category_name}</option>`
                })

                $('#sub_category_id').html('<option value="all">All</option>'+opts)
                $("#sub_category_id").select2({
                    formatNoMatches: function () {
                        return "<?php echo e(__('messages.noRecordFound')); ?>";
                    }
                });
            });

            $('body').on('click', '.sa-params', function(){
                var id = $(this).data('user-id');
                swal({
                    title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                    text: "<?php echo app('translator')->get('messages.confirmation.removeProduct'); ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                    cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm){
                    if (isConfirm) {

                        var url = "<?php echo e(route('admin.products.destroy',':id')); ?>";
                        url = url.replace(':id', id);
                        var token = "<?php echo e(csrf_token()); ?>";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    LaravelDataTables["products-table"].draw();
                                }
                            }
                        });
                    }
                });
            });
        });

        $('#products-table').on('preXhr.dt', function (e, settings, data) {
            var categoryID = $('#category_id').val();
            var subCategoryID = $('#sub_category_id').val();


            data['category_id'] = categoryID;
            data['sub_category_id'] = subCategoryID;
        });


        function showData() {
            $('#products-table').on('preXhr.dt', function (e, settings, data) {
                var categoryID = $('#category_id').val();
                var subCategoryID = $('#sub_category_id').val();


                data['category_id'] = categoryID;
                data['sub_category_id'] = subCategoryID;
            });

            window.LaravelDataTables["products-table"].draw();
        }

        $('#filter-results').on('click', function (event) {
            event.preventDefault();
            showData();
        });

        $('#reset-filters').click(function () {
            $("#category_id").val('all').trigger('change');
            $("#sub_category_id").val('all').trigger('change');
            showData();
        })


        function exportData(){
            var url = '<?php echo e(route('admin.products.export')); ?>';
            window.location.href = url;
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/products/index.blade.php ENDPATH**/ ?>