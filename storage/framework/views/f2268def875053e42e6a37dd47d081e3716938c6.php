<?php echo Form::open(['id'=>'saveUpdateFeature','class'=>'ajax-form','method'=>'POST']); ?>

<div class="form-body">
<!--    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="scopeOfWorkValuerInformation">The nature and sources of information upon which the Valuer relies</label>
                <textarea  class="form-control" id="scopeOfWorkValuerInformation"
                            autocomplete="nope" name="scopeOfWorkValuerInformation"><?php echo e(isset($formData['scopeOfWorkValuerInformation'])?$formData['scopeOfWorkValuerInformation']:''); ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="ScopeOfWorkRestrictionsOnUse">Scope of work restrictions on use</label>
                <textarea  class="form-control" id="ScopeOfWorkRestrictionsOnUse"
                            autocomplete="nope" name="ScopeOfWorkRestrictionsOnUse"><?php echo e(isset($formData['ScopeOfWorkRestrictionsOnUse'])?$formData['ScopeOfWorkRestrictionsOnUse']:''); ?></textarea>
            </div>
        </div>
    </div>-->
       

    <div class="row">
        <fieldset>
            <legend>SOW Report Title</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="valuationInfoTitle">Valuation info title</label>
                        <input type="text" class="form-control inputDisabled" id="valuationInfoTitle"
                               value="<?php echo e(isset($formData['valuationInfoTitle'])?$formData['valuationInfoTitle']:''); ?>"
                               autocomplete="nope" name="valuationInfoTitle" disabled="disabled" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="serviceInfoTitle">Service info  title</label>
                        <input type="text" class="form-control inputDisabled" id="serviceInfoTitle"
                               value="<?php echo e(isset($formData['serviceInfoTitle'])?$formData['serviceInfoTitle']:''); ?>" autocomplete="nope" name="serviceInfoTitle" disabled="disabled"/>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="propertyInfoTitle">Property info  title</label>
                        <input type="text" class="form-control inputDisabled" id="propertyInfoTitle"
                               value="<?php echo e(isset($formData['propertyInfoTitle'])?$formData['propertyInfoTitle']:''); ?>" autocomplete="nope" name="propertyInfoTitle" disabled="disabled"/>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="scopeOfWorkValuerValidTill">Scope of work valid till days</label>
                        <input type="number" class="form-control inputDisabled" id="scopeOfWorkValuerValidTill"
                               value="<?php echo e(isset($formData['scopeOfWorkValuerValidTill'])?$formData['scopeOfWorkValuerValidTill']:''); ?>" autocomplete="nope" name="scopeOfWorkValuerValidTill" disabled="disabled"/>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <fieldset>
            <legend>Google Api Values</legend>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="googleApi">Google Api</label>
                        <input type="text" class="form-control inputDisabled" id="googleApi"
                               value="<?php echo e(isset($formData['googleApi'])?$formData['googleApi']:''); ?>" autocomplete="nope" name="googleApi" disabled="disabled"/>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <fieldset>
            <legend>Weight Max Values</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="maxNumberOfBedrooms">Max number of bedrooms</label>
                        <input type="number" class="form-control inputDisabled" id="maxNumberOfBedrooms"
                               value="<?php echo e(isset($formData['maxNumberOfBedrooms'])?$formData['maxNumberOfBedrooms']:''); ?>" autocomplete="nope" name="maxNumberOfBedrooms" disabled="disabled"/>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="maxNumberOfBathrooms">Max number of bathrooms</label>
                        <input type="number" class="form-control inputDisabled" id="maxNumberOfBathrooms"
                               value="<?php echo e(isset($formData['maxNumberOfBathrooms'])?$formData['maxNumberOfBathrooms']:''); ?>" autocomplete="nope" name="maxNumberOfBathrooms" disabled="disabled"/>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="maxNumberOfAmenities">Max number of Amenities and facilities</label>
                        <input type="number" class="form-control inputDisabled" id="maxNumberOfAmenities"
                               value="<?php echo e(isset($formData['maxNumberOfAmenities'])?$formData['maxNumberOfAmenities']:''); ?>" autocomplete="nope" name="maxNumberOfAmenities" disabled="disabled"/>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="maxRecencyOfTransaction">Max recency of transaction</label>
                        <input type="number" class="form-control inputDisabled" id="maxRecencyOfTransaction"
                               value="<?php echo e(isset($formData['maxRecencyOfTransaction'])?$formData['maxRecencyOfTransaction']:''); ?>" autocomplete="nope" name="maxRecencyOfTransaction" disabled="disabled"/>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="maxLocationOfLand">Max location of land</label>
                        <input type="number" class="form-control inputDisabled" id="maxLocationOfLand"
                               value="<?php echo e(isset($formData['maxLocationOfLand'])?$formData['maxLocationOfLand']:''); ?>" autocomplete="nope" name="maxLocationOfLand" disabled="disabled"/>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>

</div>


</div>
<div class="form-actions">

    <button type="button" id="edit" class="btn btn-success"><i
                class="fa fa-check"></i> <?php echo app('translator')->get('app.edit'); ?></button>
 <button type="submit" id="saveFeatureForm"   class="hidden btn btn-success"><i
                class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>

</div>

</div>

<?php echo Form::close(); ?>


<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/metronic_plugin/js/datatables-bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/metronic_plugin/js/prismjs-bundle.js')); ?>"></script>
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

        })
        $("#edit").click(function(event){
            event.preventDefault();
            $('.inputDisabled').removeAttr("disabled")
            $("#edit").addClass("hidden")
            $("#saveFeatureForm").removeClass("hidden")
        });
        $('#saveFeatureForm').click(function () {

            let name = $("#scopeOfWorkValuerInformation");
            var catName = $('#ScopeOfWorkRestrictionsOnUse').val();
            var fieldType = $('#scopeOfWorkValuerValidTill').val();
            if (name.val() == '') {
                alert('Please enter Value');
                return false;
            }
            if (catName == '') {
                alert('Please enter Value');
                return false;
            }
            if (fieldType == '') {
                alert('Please enter Value');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route($saveUpdateDataRoute, isset($id)?$id:0)); ?>',
                container: '#saveUpdateFeature',
                type: "POST",
                redirect: '<?php echo e(isset($isRedirectTrue)?$isRedirectTrue:true); ?>',
                data: $('#saveUpdateFeature').serialize(),
                success: (typeof afterSaveBlock === "function") ? afterSaveBlock : ''
            })
        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Settings/General/Form.blade.php ENDPATH**/ ?>