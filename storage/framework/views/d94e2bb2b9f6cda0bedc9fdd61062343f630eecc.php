<?php echo Form::open(['id'=>'saveUpdateBlock','class'=>'ajax-form','method'=>'POST']); ?>

<div class="form-body">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="required">Name</label>
                <input type="text" name="name" id="blockName" value="<?php echo e(isset($name)?$name:''); ?>"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="required"><?php echo app('translator')->get('valuation::valuation.block.selectCountry'); ?></label>
                <select name="countryId" id="blockCountryId" class="form-control countryId" required>
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
                <label class=""><?php echo app('translator')->get('valuation::valuation.block.selectGovernorate'); ?></label>
                <select name="governorateId" id="blockGovernorateId" class="form-control governorateId" >
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
                <label class=""><?php echo app('translator')->get('valuation::valuation.block.selectCity'); ?></label>
                <select name="cityId" id="blockCityId" class="form-control cityId" >
                    <option value="">--</option>
                    <?php if(isset($cities) && !empty($cities)): ?>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($city->id); ?>"
                                    <?php if(isset($cityId) && $city->id == $cityId): ?> selected="selected" <?php endif; ?>>
                                <?php echo e($city->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

    </div>
    <!--/row-->

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="required">Status</label>
                <select name="status" id="blockStatus" class="form-control">
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
    <button type="submit" id="saveBlockForm" class="btn btn-success"><i
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
            $("#blockCountryId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $("#blockGovernorateId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
            $("#blockCityId").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });
        })()
    </script>

    <script>

        $('#saveBlockForm').click(function () {

            let name = $("#blockName");
            let countryId = $("#blockCountryId")

            if (name.val() == '') {
                alert('Please enter name');
                return false;
            } else if (countryId.val() == '') {
                alert('Please select Country');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, isset($id)?$id:0)); ?>',
                container: '#saveUpdateBlock',
                type: "POST",
                redirect: '<?php echo e(isset($isRedirectTrue)?$isRedirectTrue:true); ?>',
                data: $('#saveUpdateBlock').serialize(),
                success: (typeof afterSaveBlock === "function") ? afterSaveBlock : ''
            })
        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Settings/Block/Form.blade.php ENDPATH**/ ?>