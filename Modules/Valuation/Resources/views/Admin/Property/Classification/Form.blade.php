{!! Form::open(['id'=>'saveUpdatePropertyClassification','class'=>'ajax-form','method'=>'POST']) !!}
<div class="form-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="title" id="propertyClassificationTitle" value="{{isset($title)?$title:''}}"
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
                <select name="status" id="propertyClassificationStatus" class="form-control">
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
    <button type="submit" id="savePropertyClassification" class="btn btn-success"><i
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

        $('#savePropertyClassification').click(function () {

            let title = $("#propertyClassificationTitle");

            if (title.val() == '') {
                alert('Please enter title');
                return false;
            }

            $.easyAjax({
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
                container: '#saveUpdatePropertyClassification',
                type: "POST",
                redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                data: $('#saveUpdatePropertyClassification').serialize(),
                success: (typeof afterSavePropertyClassification === "function") ? afterSavePropertyClassification : ''
            })
        });

    </script>
@endpush