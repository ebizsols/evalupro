{!! Form::open(['id'=>'saveUpdateBlock','class'=>'ajax-form','method'=>'POST']) !!}
<div class="form-body">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="required">Name</label>
                <input type="text" name="name" id="blockName" value="{{isset($name)?$name:''}}"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="required">@lang('valuation::valuation.block.selectCountry')</label>
                <select name="countryId" id="blockCountryId" class="form-control countryId" required>
                    <option value="">--</option>
                    @if(isset($countries) && !empty($countries))
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                    @if(isset($countryId) && $country->id == $countryId) selected="selected" @endif>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="">@lang('valuation::valuation.block.selectGovernorate')</label>
                <select name="governorateId" id="blockGovernorateId" class="form-control governorateId" >
                    <option value="">--</option>
                    @if(isset($governorates) && !empty($governorates))
                        @foreach($governorates as $governorate)
                            <option value="{{ $governorate->id }}"
                                    @if(isset($governorateId) && $governorate->id == $governorateId) selected="selected" @endif>
                                {{ $governorate->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="">@lang('valuation::valuation.block.selectCity')</label>
                <select name="cityId" id="blockCityId" class="form-control cityId" >
                    <option value="">--</option>
                    @if(isset($cities) && !empty($cities))
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}"
                                    @if(isset($cityId) && $city->id == $cityId) selected="selected" @endif>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    @endif
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
                    <option value="Active" @if(isset($status) && $status == 'Active') selected="selected" @endif >
                        Active
                    </option>
                    <option value="Inactive"
                            @if(isset($status) && $status == 'Inactive') selected="selected" @endif >
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
                class="fa fa-check"></i> @lang('app.save')</button>

</div>
{!! Form::close() !!}

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
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
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
                container: '#saveUpdateBlock',
                type: "POST",
                redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                data: $('#saveUpdateBlock').serialize(),
                success: (typeof afterSaveBlock === "function") ? afterSaveBlock : ''
            })
        });

    </script>
@endpush