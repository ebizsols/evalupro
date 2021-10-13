<?php if(isset($project)): ?>
    <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item <?php if($task->board_column->slug == 'completed'): ?> task-completed <?php endif; ?>">
            <div class="row">
                <div class="checkbox checkbox-success checkbox-circle task-checkbox col-md-10">
                    <input class="task-check" data-task-id="<?php echo e($task->id); ?>" id="checkbox<?php echo e($task->id); ?>" type="checkbox"
                           <?php if($task->board_column->slug == 'completed'): ?> checked <?php endif; ?>>
                    <label for="checkbox<?php echo e($task->id); ?>">&nbsp;</label>
                    <a href="javascript:;" class="text-muted edit-task"
                       data-task-id="<?php echo e($task->id); ?>"><?php echo e(ucfirst($task->heading)); ?></a>
                </div>
                <div class="col-md-2 text-right">
                    <span class="<?php if($task->due_date->isPast()): ?> text-danger <?php else: ?> text-success <?php endif; ?> m-r-10"><?php echo e($task->due_date->format('d M')); ?></span>
                     <?php $__currentLoopData = $task->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($item->image_url); ?>" data-toggle="tooltip" data-original-title="<?php echo e(ucwords($item->name)); ?>" data-placement="right" class="img-circle" width="35" height="35" alt="">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <li class="list-group-item <?php if($task->board_column->slug == 'completed'): ?> task-completed <?php endif; ?>">
        <div class="row">
            <div class="checkbox checkbox-success checkbox-circle task-checkbox col-md-10">
                <input class="task-check" data-task-id="<?php echo e($task->id); ?>" id="checkbox<?php echo e($task->id); ?>" type="checkbox"
                       <?php if($task->board_column->slug == 'completed'): ?> checked <?php endif; ?>>
                <label for="checkbox<?php echo e($task->id); ?>">&nbsp;</label>
                <a href="javascript:;" class="text-muted edit-task"
                   data-task-id="<?php echo e($task->id); ?>"><?php echo e(ucfirst($task->heading)); ?></a>
            </div>
            <div class="col-md-2 text-right">
                <span class="<?php if($task->due_date->isPast()): ?> text-danger <?php else: ?> text-success <?php endif; ?> m-r-10"><?php echo e($task->due_date->format('d M')); ?></span>
                <?php $__currentLoopData = $task->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e($item->image_url); ?>" data-toggle="tooltip" data-original-title="<?php echo e(ucwords($item->name)); ?>" data-placement="right" class="img-circle" width="35" height="35" alt="">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </li>
<?php endif; ?>
<?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/tasks/task-list-ajax.blade.php ENDPATH**/ ?>