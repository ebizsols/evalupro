{!! Form::open(['id' => 'saveUpdateTemplate', 'class' => 'ajax-form', 'method' => 'POST']) !!}
<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Property Type</label>
                <select name="property_type" data-placeholder="@lang('modules.messages.chooseMember')" id="PropertyType"
                    class="form-control">
                    <option value="">Select Property Type</option>
                    @if (isset($propertyType) && !empty($propertyType))
                        @foreach ($propertyType as $typeObj)
                            <option @if (isset($property_type) && !empty($property_type) && $property_type == $typeObj->id) selected="selected" @endif value="{{ $typeObj->id }}">
                                {{ $typeObj->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Template Name</label>
                <input type="text" name="template_name" id="templateTitle"
                    value="{{ isset($template_name) ? $template_name : '' }}" class="form-control"
                    placeholder="Enter Name" autocomplete="nope">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Template Fields</label>
                <select name="template_category[]" data-placeholder="@lang('modules.messages.chooseMember')"
                    id="templateCategory" class="form-control" multiple="multiple">
                    @if (isset($tempData) && !empty($tempData))
                        @foreach ($tempData as $index => $tempField)
                            <option value="{{ $index }}" @if (isset($templateFields) && in_array($index, $templateFields) == true) selected="selected" @endif>
                                {{ $tempField }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <!--/row-->
</div>
<div class="form-actions">
    <button type="submit" id="saveTemplateForm" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('app.save')</button>

</div>
{!! Form::close() !!}

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>

    <?php if(empty($id)) { ?>
    <script>
        $(document).ready(function() {
            $('select').selectpicker('selectAll');
        });
    </script>
    <?php } else{ ?>
    <script>
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script>
    <?php } ?>

    {{-- <script>
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script> --}}

    <script>
        $('#saveTemplateForm').click(function() {

            let title = $("#templateTitle");
            let templateCategory = $("#templateCategory");
            let PropertyType = $("#PropertyType")

            if (PropertyType.val() == '') {
                alert("Please select Property Type");
                return false;
            } else if (title.val() == '') {
                alert('Please enter Template Name');
                return false;
            } else if (templateCategory.val() == '') {
                alert('Please select Template Category');
                return false;
            }
        });

        // New
        $(document).ready(function() {
            $('#saveUpdateTemplate').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.easyAjax({
                    url: '{{ route($saveUpdateDataRoute, isset($id) ? $id : 0) }}',
                    container: '#saveUpdateTemplate',
                    type: "POST",
                    redirect: '{{ isset($isRedirectTrue) ? $isRedirectTrue : true }}',
                    data: form_data,
                    success: (typeof afterSaveTemplate === "function") ? afterSaveTemplate : ''
                })
            });
        });
    </script>
@endpush
