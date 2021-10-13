@foreach($subTasks as $subtask)
    <li class="list-group-item row">
        <div class="col-xs-9">
            <div class="checkbox checkbox-success checkbox-circle task-checkbox">
                <input class="task-check" data-sub-task-id="{{ $subtask->id }}" id="checkbox{{ $subtask->id }}" type="checkbox"
                       @if($subtask->status == 'complete') checked @endif>
                <label for="checkbox{{ $subtask->id }}">&nbsp;</label>
                <span>{{ ucfirst($subtask->title) }}</span>
            </div>
            @if($subtask->due_date)<span class="text-muted m-l-5"> - @lang('modules.invoices.due'): {{ $subtask->due_date->format($global->date_format) }}</span>@endif
        </div>
        <div class="col-xs-9">
            <div class="form-group">
                <label class="required">Field Type</label>
                <select name="fieldType" id="fieldType" onchange="checkFieldType(this.value)" class="form-control">
                    <option value="">--Select Type--</option>
                    <option value="text" @if(isset($field_type) && $field_type == 'text') selected="selected" @endif >Text</option>
                    <option value="select" @if(isset($field_type) && $field_type == 'select') selected="selected" @endif>Select Box</option>
                    <option value="textarea" @if(isset($field_type) && $field_type == 'textarea') selected="selected" @endif>Textarea</option>
                    <!--                     <option value="checkbox">CheckBox</option>
                                         <option value="radiobox">RadioBox</option>-->
                </select>
            </div>
        </div>
        <div class="row" id="subFieldDiv" @if(isset($field_type) && $field_type != 'select') style="display: none" @endif >
            <div class="pb-10">
                <button type="button" class="btn btn-primary" id="addMoreField">Add Field</button>
            </div>
            <table id="subFieldTable" class="table table-striped table-row-bordered gy-5 gs-7">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>Field Name</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($sub_fields) && !empty($sub_fields))
                    @foreach($sub_fields as $key=>$subField)
                        <tr>
                            <td><input type="text" name="subField[]" id="subField-{{$key}}" class="form-control" value="{{isset($subField)?$subField->name:''}}"></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-xs-3 text-right">
            <a href="javascript:;" data-sub-task-id="{{ $subtask->id }}" title="@lang('app.edit')" class="edit-sub-task"><i class="fa fa-pencil"></i></a>&nbsp;
            <a href="javascript:;" data-sub-task-id="{{ $subtask->id }}"  title="@lang('app.delete')"  class="delete-sub-task"><i class="fa fa-trash"></i></a>
        </div>
    </li>
@endforeach
