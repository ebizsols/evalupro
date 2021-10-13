<?php echo Form::open(['id'=>'saveUpdateCity','class'=>'ajax-form','method'=>'POST']); ?>

<div class="form-body">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="required">Name</label>
                <input type="text" name="name" id="cityName" value="<?php echo e(isset($name)?$name:''); ?>"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="required"><?php echo app('translator')->get('valuation::valuation.city.selectCountry'); ?></label>
                <select name="countryId" id="cityCountryId" class="form-control countryId" required>
                    <option value="">--</option>
                    <?php if(isset($countries) && !empty($countries)): ?>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>"
                                    <?php if(isset($countryId) && $country->id == $countryId): ?> selected="selected" <?php endif; ?>>
                                <?php echo e($country->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class=""><?php echo app('translator')->get('valuation::valuation.city.selectGovernorate'); ?></label>
                <select name="governorateId" id="cityGovernorateId" class="form-control governorateId">
                    <option value="">--</option>
                    <?php if(isset($governorates) && !empty($governorates)): ?>
                        <?php $__currentLoopData = $governorates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $governorate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($governorate->id); ?>"
                                    <?php if(isset($governorateId) && $governorate->id == $governorateId): ?> selected="selected" <?php endif; ?>>
                                <?php echo e($governorate->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="">Status</label>
                <select name="status" id="citytatus" class="form-control">
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
    <button type="submit" id="saveCityForm" class="btn btn-success"><i
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
            $("#cityCountryId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $(".governorateId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
        })()
    </script>

    <script>

        $('#saveCityForm').click(function () {

            let name = $("#cityName");
            let countryId = $("#cityCountryId")

            if (name.val() == '') {
                alert('Please enter name');
                return false;
            } else if (countryId.val() == '') {
                alert('Please select Country');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, isset($id)?$id:0)); ?>',
                container: '#saveUpdateCity',
                type: "POST",
                redirect: '<?php echo e(isset($isRedirectTrue)?$isRedirectTrue:true); ?>',
                data: $('#saveUpdateCity').serialize(),
                success: (typeof afterSaveCity === "function") ? afterSaveCity : ''
            })

        });

    </script>

<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Settings/City/Form.blade.php ENDPATH**/ ?>