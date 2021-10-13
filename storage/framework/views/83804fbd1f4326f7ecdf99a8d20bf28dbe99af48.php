<?php echo Form::open(['id'=>'saveUpdatePropertyType','class'=>'ajax-form','method'=>'POST']); ?>

<div class="form-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="title" id="propertyTypeTitle" value="<?php echo e(isset($title)?$title:''); ?>"
                       class="form-control"
                       autocomplete="nope" required>
            </div>
        </div>

    </div>
    <!--/row-->

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="">Status</label>
                <select name="status" id="propertyTypeStatus" class="form-control">
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
    <!--/row-->


</div>
<div class="form-actions">
    <button type="submit" id="savePropertyType" class="btn btn-success"><i
                class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>

</div>
<?php echo Form::close(); ?>


<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script data-name="basic">
        (function () {
        })()
    </script>

    <script>

        $('#savePropertyType').click(function () {

            let title = $("#propertyTypeTitle");

            if (title.val() == '') {
                alert('Please enter title');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, isset($id)?$id:0)); ?>',
                container: '#saveUpdatePropertyType',
                type: "POST",
                redirect: '<?php echo e(isset($isRedirectTrue)?$isRedirectTrue:true); ?>',
                data: $('#saveUpdatePropertyType').serialize(),
                success: (typeof afterSavePropertyType === "function") ? afterSavePropertyType : ''
            })
        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/Type/Form.blade.php ENDPATH**/ ?>