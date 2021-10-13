<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><?php echo app('translator')->get('modules.tasks.subTask'); ?></h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <?php echo Form::open(['id'=>'createSubTask','class'=>'ajax-form','method'=>'POST']); ?>

        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('app.name'); ?></label>
                        <input type="text" name="name" id="name" class="form-control">
                        <input type="hidden" name="taskID" id="taskID" value="<?php echo e($taskID); ?>">
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('app.dueDate'); ?></label>
                        <input type="text" name="due_date" autocomplete="off" id="due_date3" class="form-control datepicker">
                    </div>
                </div>
              
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="required">Field Linked With</label>
                        <select name="formFieldKey" id="fieldLink"  class="form-control">
                            <option value="">--Select Type--</option>
                            <?php $__currentLoopData = $subTaskFormElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="subFieldDiv" <?php if(isset($field_type) && $field_type != 'select'): ?> style="display: none" <?php endif; ?> >
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
                    <?php if(isset($sub_fields) && !empty($sub_fields)): ?>
                        <?php $__currentLoopData = $sub_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$subField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="text" name="subField[]" id="subField-<?php echo e($key); ?>" class="form-control" value="<?php echo e(isset($subField)?$subField->name:''); ?>"></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick="saveSubTask()" class="btn btn-success"> <i class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<script>
    jQuery('#due_date3').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    });
    $('#subFieldDiv').hide();
    function checkFieldType(typeVal)
    {
        if(typeVal=='select' || typeVal=='checkbox' )
        {
            $('#subFieldDiv').show();
        }
        else
        {
            $('#subFieldDiv').hide();
        }
    }

    var subFieldTable = $("#subFieldTable").DataTable();
    var counterSubField = '<?php echo e((isset($sub_fields) && !empty($sub_fields))?count($sub_fields)+1:1); ?>';
    var isEdit='<?php echo e((isset($sub_fields) && isset($id))? "true":"false"); ?>';
    $("#addMoreField").on("click", function() {
        subFieldTable.row.add([
            '<input type="text" name="subField[]" id="subField-'+counterSubField+'"  class="form-control">',
        ]).draw(false);
        counterSubField++;
    });
    if(isEdit===true)
    {

    }
    else
    {
        $("#addMoreField").click();
    }

    function loadFields(fieldType,countField)
    {
        if(fieldType=='select')
        {
            $('#optionSelect-'+countField).modal('show');
        }
        else if(fieldType=='checkbox')
        {
            $('#checkBox-'+countField).modal('show');
        }
        else if(fieldType=='radiobox')
        {
            $('#radioBox-'+countField).modal('show');
        }
    }
    var featureTable = $("#featureTable").DataTable();
    var counter = 1;

    $("#addMoreFeature").on("click", function() {

        featureTable.row.add([
            '<input type="text" name="fieldType[]" id="fieldType-'+counter+'"  class="form-control">',
            '<select name="featureType[]" class="form-control" onchange="loadFields(this.value,'+counter+')" id="featureType-'+counter+'" autocomplete="nope"><option value="">--Select Type--</option><option value="text">Text</option><option value="select">Select Box</option><option value="textarea">Textarea</option><option value="checkbox">CheckBox</option><option value="radiobox">RadioBox</option></select>',
        ]).draw(false);
        modelGenerate(counter);
        counter++;
    });
    $("#addMoreFeature").click();
    var OptionCouter=1;
    var checkBoxCounter=1;
    function loadMoreOption(point)
    {
        var tableOption=$("#optionsTable-"+point).DataTable();
        tableOption.row.add([
            '<input type="text" name="selectOptions[]" id="selectOptions-'+OptionCouter+'"  class="form-control">',
        ]).draw(false);
        OptionCouter++;
    }
    function loadMoreCheck(index)
    {
        var tableOption=$("#checksTable-"+index).DataTable();
        tableOption.row.add([
            '<input type="text" name="checkOptionSub[]" id="checkOptionSub-'+checkBoxCounter+'"  class="form-control">',
        ]).draw(false);
        checkBoxCounter++;
    }
</script>

<script>


    $('#saveFeatureForm').click(function () {

        let name = $("#featureName");
        var catName=$('#feactureCategory option:selected').val();
        var fieldType=$('#fieldType option:selected').val();
        if (name.val() == '') {
            alert('Please enter name');
            return false;
        }
        if(catName=='')
        {
            alert('Please Select Category');
            return false;
        }
        if(fieldType=='')
        {
            alert('Please Select Field Type');
            return false;
        }

        
        
        
        
        
        
        
        
    });


</script>
<?php /**PATH /home/evalupro/public_html/resources/views/admin/sub_task/create.blade.php ENDPATH**/ ?>