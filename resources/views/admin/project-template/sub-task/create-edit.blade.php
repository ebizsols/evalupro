<link rel="stylesheet"
    href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

{{-- New Sub Task --}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.tasks.subTask')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        {!! Form::open(['id' => 'createSubTask', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.name')</label>
                        <input type="text" name="name[0]" id="name1" class="form-control">
                        <input type="hidden" name="taskID" id="taskID" value="{{ $taskID }}">
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.dueDate')</label>
                        <input type="text" name="due_date" autocomplete="off" id="due_date3"
                            class="form-control datepicker">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="required">Field Linked With</label>
                        <select name="formFieldKey" id="fieldLink" class="form-control">
                            <option value="">--Select Type--</option>
                            @foreach ($subTaskFormElements as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick="saveSubTask()" class="btn btn-success"> <i class="fa fa-check"></i>
                @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
{{-- Wnd New Sub Task --}}
{{-- Old Sub Task --}}
{{-- <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.tasks.subTask')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        {!! Form::open(['id'=>'createSubTask','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="row">
                    <div id="addMoreBox1" class="clearfix">
                        <div class="col-md-9">
                            <div class="form-group"  id="nameBox" >
                                <input type="text" name="name[0]" id="name1" placeholder="Sub Task Name" class="form-control ">
                                <div id="errorName"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button"  onclick="removeBox(1)"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div id="insertBefore"></div>
                    <div class="clearfix">

                    </div>
                    <div class="col-md-5">
                        <button type="button" id="plusButton" class="btn btn-sm btn-info" style="margin-bottom: 20px">
                            Add More <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="taskID" id="taskID" value="{{ $taskID }}">
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick="saveSubTask()" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div> --}}
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script>
    var $insertBefore = $('#insertBefore');
    var $i = 0;
    // Date Picker
     jQuery('#due_date3').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart: '{{ $global->week_start }}',
        format: '{{ $global->date_picker_format }}',
    });
    // Add More Inputs
    $('#plusButton').click(function() {

        $i = $i + 1;
        var indexs = $i + 1;
        $(' <div id="addMoreBox' + indexs + '" class="clearfix"> ' +
            '<div class="col-md-9 "><div class="form-group"><input class="form-control " name="name[' + $i +
            ']" type="text" value="" placeholder="Sub Task Name"/></div></div>' +
            '<div class="col-md-1"><button type="button" onclick="removeBox(' + indexs +
            ')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></div>' +
            '</div>').insertBefore($insertBefore);

        // Recently Added date picker assign
        jQuery('#dueDate' + indexs).datepicker({
            autoclose: true,
            todayHighlight: true,
            weekStart: '{{ $global->week_start }}',
            format: '{{ $global->date_picker_format }}',
        });
    });
    // Remove fields
    function removeBox(index) {
        $('#addMoreBox' + index).remove();
    }

    // Store Holidays
    function saveSubTask() {
        $('#nameBox').removeClass("has-error");
        $('#errorName').html('');
        $('.help-block').remove();

        var url = "{{ route('admin.project-template-sub-task.store') }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            container: '#createSubTask',
            data: $('#createSubTask').serialize(),
            success: function(response) {
                $('#taskCategoryModal').modal('hide');
            },
            error: function(response) {
                if (response.status == '422') {
                    if (typeof response.responseJSON.errors['name.0'] != "undefined" && response
                        .responseJSON.errors['name.0'][0] != 'undefined') {
                        $('#nameBox').addClass("has-error");
                        $('#errorName').html('<span class="help-block" id="errorName">' + response
                            .responseJSON.errors['name.0'][0] + '</span>');
                    }

                }
            }
        });
    }
</script>
