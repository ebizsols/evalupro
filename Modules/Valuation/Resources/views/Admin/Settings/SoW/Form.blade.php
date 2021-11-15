{!! Form::open(['id'=>'saveUpdateFeature','class'=>'ajax-form','method'=>'POST']) !!}
<div class="form-body">
    <div class="row">
        <fieldset>
            <legend>SOW Report Title</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="valuationInfoTitle">Valuation info title</label>
                        <input type="text" class="form-control inputDisabled" id="valuationInfoTitle"
                               value="{{isset($formData['valuationInfoTitle'])?$formData['valuationInfoTitle']:''}}"
                               autocomplete="nope" name="valuationInfoTitle" disabled="disabled" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="serviceInfoTitle">Service info  title</label>
                        <input type="text" class="form-control inputDisabled" id="serviceInfoTitle"
                               value="{{isset($formData['serviceInfoTitle'])?$formData['serviceInfoTitle']:''}}" autocomplete="nope" name="serviceInfoTitle" disabled="disabled"/>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="propertyInfoTitle">Property info  title</label>
                        <input type="text" class="form-control inputDisabled" id="propertyInfoTitle"
                               value="{{isset($formData['propertyInfoTitle'])?$formData['propertyInfoTitle']:''}}" autocomplete="nope" name="propertyInfoTitle" disabled="disabled"/>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="scopeOfWorkValuerValidTill">Scope of work valid till days</label>
                        <input type="number" class="form-control inputDisabled" id="scopeOfWorkValuerValidTill"
                               value="{{isset($formData['scopeOfWorkValuerValidTill'])?$formData['scopeOfWorkValuerValidTill']:''}}" autocomplete="nope" name="scopeOfWorkValuerValidTill" disabled="disabled"/>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="form-actions">

    <button type="button" id="edit" class="btn btn-success"><i
                class="fa fa-check"></i> @lang('app.edit')</button>
 <button type="submit" id="saveFeatureForm"   class="hidden btn btn-success"><i
                class="fa fa-check"></i> @lang('app.save')</button>

</div>


{!! Form::close() !!}

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/metronic_plugin/js/datatables-bundle.js') }}"></script>
    <script src="{{ asset('plugins/metronic_plugin/js/prismjs-bundle.js') }}"></script>
    <script data-name="basic">
        (function () {
            $("#blockCountryId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
            $("#blockGovernorateId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
            $("#blockCityId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
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
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
                container: '#saveUpdateFeature',
                type: "POST",
                redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                data: $('#saveUpdateFeature').serialize(),
                success: (typeof afterSaveBlock === "function") ? afterSaveBlock : ''
            })
        });

    </script>
@endpush