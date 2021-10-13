{!! Form::open(['id'=>'saveUpdateWeightage','class'=>'ajax-form','method'=>'POST']) !!}
<div class="form-body">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="title" id="weightageTitle" value="{{isset($title)?$title:''}}"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="required">Value</label>
                <input type="text" name="value" id="weightageValue" value="{{isset($value)?$value:''}}"
                       class="form-control"
                       autocomplete="nope">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="required">Weightage Category</label>
                <select name="category" id="weightageCategory" class="form-control">
                    <option value="">--</option>
                    @if(isset($categories) && !empty($categories))
                        @foreach($categories as $catObj)
                            <option value="{{ $catObj->id }}"
                                    @if(isset($categoryId) && $catObj->id == $categoryId) selected="selected" @endif>
                                {{ $catObj->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="required">Status</label>
                <select name="status" id="weightageStatus" class="form-control">
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

    <div class="row">

    </div>
    <!--/row-->


</div>
<div class="form-actions">
    <button type="submit" id="saveWeightageForm" class="btn btn-success"><i
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

        })()
    </script>

    <script>

        $('#saveWeightageForm').click(function () {

            let title = $("#weightageTitle");
            let value = $("#weightageValue");
            let weightageCategory = $("#weightageCategory");

            if (title.val() == '') {
                alert('Please enter Title');
                return false;
            }
            else if (value.val() == '') {
                alert('Please enter Value');
                return false;
            }
            else if (weightageCategory.val() == '') {
                alert('Please select Category');
                return false;
            }

            $.easyAjax({
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
                container: '#saveUpdateWeightage',
                type: "POST",
                redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                data: $('#saveUpdateWeightage').serialize(),
                success: (typeof afterSaveWeightage === "function") ? afterSaveWeightage : ''
            })
        });

    </script>
@endpush