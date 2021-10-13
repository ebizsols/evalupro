<?php $__currentLoopData = $subTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subtask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="list-group-item row">
        <div class="col-xs-9">
            <div class="checkbox checkbox-success checkbox-circle task-checkbox">
                <input class="task-check" data-sub-task-id="<?php echo e($subtask->id); ?>" id="checkbox<?php echo e($subtask->id); ?>" type="checkbox"
                       <?php if($subtask->status == 'complete'): ?> checked <?php endif; ?>>
                <label for="checkbox<?php echo e($subtask->id); ?>">&nbsp;</label>
                <span><?php echo e(ucfirst($subtask->title)); ?></span>
            </div>
            <?php if($subtask->due_date): ?><span class="text-muted m-l-5"> - <?php echo app('translator')->get('modules.invoices.due'); ?>: <?php echo e($subtask->due_date->format($global->date_format)); ?></span><?php endif; ?>
        </div>
        <div class="col-xs-9">
            <div class="form-group">
                <label class="required">Field Type</label>
                <select name="fieldType" id="fieldType" onchange="checkFieldType(this.value)" class="form-control">
                    <option value="">--Select Type--</option>
                    <option value="text" <?php if(isset($field_type) && $field_type == 'text'): ?> selected="selected" <?php endif; ?> >Text</option>
                    <option value="select" <?php if(isset($field_type) && $field_type == 'select'): ?> selected="selected" <?php endif; ?>>Select Box</option>
                    <option value="textarea" <?php if(isset($field_type) && $field_type == 'textarea'): ?> selected="selected" <?php endif; ?>>Textarea</option>
                    <!--                     <option value="checkbox">CheckBox</option>
                                         <option value="radiobox">RadioBox</option>-->
                </select>
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
        <div class="col-xs-3 text-right">
            <a href="javascript:;" data-sub-task-id="<?php echo e($subtask->id); ?>" title="<?php echo app('translator')->get('app.edit'); ?>" class="edit-sub-task"><i class="fa fa-pencil"></i></a>&nbsp;
            <a href="javascript:;" data-sub-task-id="<?php echo e($subtask->id); ?>"  title="<?php echo app('translator')->get('app.delete'); ?>"  class="delete-sub-task"><i class="fa fa-trash"></i></a>
        </div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/evalupro/public_html/resources/views/admin/sub_task/show.blade.php ENDPATH**/ ?>