<?php echo Form::open(['id'=>'saveUpdatePropertyClass','class'=>'ajax-form','method'=>'POST']); ?>

<div class="form-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="title" id="propertyClassTitle" value="<?php echo e(isset($title)?$title:''); ?>"
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
                <select name="status" id="propertyClassStatus" class="form-control">
                    <option value="Active" <?php if(isset($status) &&$status == 'Active'): ?> selected="selected" <?php endif; ?> >
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
    <button type="submit" id="savePropertyClass" class="btn btn-success"><i
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

        $('#savePropertyClass').click(function () {

            let title = $("#propertyClassTitle");

            if (title.val() == '') {
                alert('Please enter title');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, isset($id)?$id:0)); ?>',
                container: '#saveUpdatePropertyClass',
                type: "POST",
                redirect: '<?php echo e(isset($isRedirectTrue)?$isRedirectTrue:true); ?>',
                data: $('#saveUpdatePropertyClass').serialize(),
                success: (typeof afterPropertyClass === "function") ? afterPropertyClass : ''
            })
        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/Class/Form.blade.php ENDPATH**/ ?>