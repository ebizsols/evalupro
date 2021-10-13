{!! Form::open(['id'=>'saveUpdateCity','class'=>'ajax-form','method'=>'POST']) !!}
<div class="form-body">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="required">Name</label>
                <input type="text" name="name" id="cityName" value="{{isset($name)?$name:''}}"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="required">@lang('valuation::valuation.city.selectCountry')</label>
                <select name="countryId" id="cityCountryId" class="form-control countryId" required>
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
                <label class="">@lang('valuation::valuation.city.selectGovernorate')</label>
                <select name="governorateId" id="cityGovernorateId" class="form-control governorateId">
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
                <label class="">Status</label>
                <select name="status" id="citytatus" class="form-control">
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
    <button type="submit" id="saveCityForm" class="btn btn-success"><i
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
            $("#cityCountryId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
            $(".governorateId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
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
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
                container: '#saveUpdateCity',
                type: "POST",
                redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                data: $('#saveUpdateCity').serialize(),
                success: (typeof afterSaveCity === "function") ? afterSaveCity : ''
            })

        });

    </script>

@endpush