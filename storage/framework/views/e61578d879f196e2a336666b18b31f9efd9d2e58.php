<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">

<div class="rpanel-title"> <?php echo app('translator')->get('app.task'); ?> <span><i class="ti-close right-side-toggle"></i></span> </div>
<div class="r-panel-body p-t-0">

    <div class="row">
        <div class="col-xs-12 col-md-9 p-t-20 b-r h-scroll">
            <div class="col-xs-12">
                <?php $pin = $task->pinned() ?>
                <a href="javascript:;" class="btn btn-sm btn-info <?php if(!$pin): ?> btn-outline <?php endif; ?> pull-right m-l-5" data-placement="bottom"  data-toggle="tooltip" data-original-title="<?php if($pin): ?> <?php echo app('translator')->get('app.unpin'); ?> <?php else: ?> <?php echo app('translator')->get('app.pin'); ?> <?php endif; ?>"    data-pinned="<?php if($pin): ?> pinned <?php else: ?> unpinned <?php endif; ?>" id="pinnedItem" >
                    <i class="icon-pin icon-2 pin-icon  <?php if($pin): ?> pinned <?php else: ?> unpinned <?php endif; ?>" ></i>
                </a>
                <a href="<?php echo e(route('admin.all-tasks.edit',$task->id)); ?>" class="btn btn-default btn-sm m-b-10 btn-rounded btn-outline pull-right m-l-5"> <i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>

                <a href="javascript:;" id="completedButton" class="btn btn-success btn-sm m-b-10 btn-rounded <?php if($task->board_column->slug == 'completed'): ?> hidden <?php endif; ?> "  onclick="markComplete('completed')" ><i class="fa fa-check"></i> <?php echo app('translator')->get('modules.tasks.markComplete'); ?></a>

                <a href="javascript:;" id="inCompletedButton" class="btn btn-default btn-outline btn-sm m-b-10 btn-rounded <?php if($task->board_column->slug != 'completed'): ?> hidden <?php endif; ?>"  onclick="markComplete('incomplete')"><i class="fa fa-times"></i> <?php echo app('translator')->get('modules.tasks.markIncomplete'); ?></a>

                <a href="javascript:;" id="reminderButton" class="btn btn-default btn-sm m-b-10 btn-rounded btn-outline pull-right <?php if($task->board_column->slug == 'completed'): ?> hidden <?php endif; ?>" title="<?php echo app('translator')->get('messages.remindToAssignedEmployee'); ?>"><i class="fa fa-bell"></i> <?php echo app('translator')->get('modules.tasks.reminder'); ?></a>

            </div>
            <div class="col-xs-12">
                <h4>
                    <?php echo e(ucwords($task->heading)); ?>

                </h4>
                <?php if(!is_null($task->project_id)): ?>
                    <p><i class="icon-layers"></i> <?php echo e(ucfirst($task->project->project_name)); ?></p>
                <?php endif; ?>

                <h5>
                    <?php if($task->task_category_id): ?>
                        <label class="label label-default text-dark font-light"><?php echo e(ucwords($task->category->category_name)); ?></label>
                    <?php endif; ?>

                    <label class="font-light label
                    <?php if($task->priority == 'high'): ?>
                            label-danger
                    <?php elseif($task->priority == 'medium'): ?> label-warning <?php else: ?> label-success <?php endif; ?>
                            ">
                        <span class="text-dark"><?php echo app('translator')->get('modules.tasks.priority'); ?> ></span>  <?php echo e(ucfirst($task->priority)); ?>

                    </label>
                </h5>

            </div>

            <ul class="nav customtab nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><?php echo app('translator')->get('app.task'); ?></a></li>
                <li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('modules.tasks.subTask'); ?>(<?php echo e(count($task->subtasks)); ?>)</a></li>
                <li role="presentation" class=""><a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('app.file'); ?> (<?php echo e(sizeof($task->files)); ?>)</a></li>

                <li role="presentation" class=""><a href="#timelogs1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('app.menu.timeLogs'); ?></a></li>

                <li role="presentation" class=""><a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('modules.tasks.comment'); ?> (<?php echo e(count($task->comments)); ?>)</a></li>
                <li role="presentation" class=""><a href="#notes1" aria-controls="note" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('app.notes'); ?> (<?php echo e(count($task->notes)); ?>)</a></li>

                <li role="presentation" >  <a href="#history1" id="view-task-history" role="tab" data-toggle="tab" aria-expanded="false" data-task-id="<?php echo e($task->id); ?>" > <span class="hidden-xs"><?php echo app('translator')->get('modules.tasks.history'); ?></span></a></li>

            </ul>

            <div class="tab-content" id="task-detail-section">
                <div role="tabpanel" class="tab-pane fade active in" id="home1">

                    <div class="col-xs-12" >

                        <div class="row visible-xs visible-sm">
                            <div class="col-xs-6 col-md-3 font-12">
                                <label class="font-12" for=""><?php echo app('translator')->get('modules.tasks.assignTo'); ?></label><br>
                                <?php $__currentLoopData = $task->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e($item->image_url); ?>" data-toggle="tooltip"
                                         data-original-title="<?php echo e(ucwords($item->name)); ?>" data-placement="right"
                                         class="img-circle" width="25" height="25" alt="">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php if($task->create_by): ?>
                                <div class="col-xs-6 col-md-3 font-12">
                                    <label class="font-12" for=""><?php echo app('translator')->get('modules.tasks.assignBy'); ?></label><br>
                                    <img src="<?php echo e($task->create_by->image_url); ?>" class="img-circle" width="25" height="25" alt="">

                                    <?php echo e(ucwords($task->create_by->name)); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($task->start_date): ?>
                                <div class="col-xs-6 col-md-3 font-12">
                                    <label class="font-12" for=""><?php echo app('translator')->get('app.startDate'); ?></label><br>
                                    <span class="text-success" ><?php echo e($task->start_date->format($global->date_format)); ?></span><br>
                                </div>
                            <?php endif; ?>
                            <div class="col-xs-6 col-md-3 font-12">
                                <label class="font-12" for=""><?php echo app('translator')->get('app.dueDate'); ?></label><br>
                                <span <?php if($task->due_date->isPast()): ?> class="text-danger" <?php endif; ?>>
                                    <?php echo e($task->due_date->format($global->date_format)); ?>

                                </span>
                                <span style="color: <?php echo e($task->board_column->label_color); ?>" id="columnStatus"> <?php echo e($task->board_column->column_name); ?></span>

                            </div>
                        </div>

                        
                        <?php if(isset($fields) && count($fields) > 0): ?>
                        <div class="row m-t-10">
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <label class="font-12" for=""><?php echo e(ucfirst($field->label)); ?></label><br>
                                    <p class="text-muted">
                                        <?php if( $field->type == 'text'): ?>
                                            <?php echo e($task->custom_fields_data['field_'.$field->id] ?? '-'); ?>

                                        <?php elseif($field->type == 'password'): ?>
                                            <?php echo e($task->custom_fields_data['field_'.$field->id] ?? '-'); ?>

                                        <?php elseif($field->type == 'number'): ?>
                                            <?php echo e($task->custom_fields_data['field_'.$field->id] ?? '-'); ?>

        
                                        <?php elseif($field->type == 'textarea'): ?>
                                            <?php echo e($task->custom_fields_data['field_'.$field->id] ?? '-'); ?>

        
                                        <?php elseif($field->type == 'radio'): ?>
                                            <?php echo e(!is_null($task->custom_fields_data['field_'.$field->id]) ? $task->custom_fields_data['field_'.$field->id] : '-'); ?>

                                        <?php elseif($field->type == 'select'): ?>
                                            <?php echo e((!is_null($task->custom_fields_data['field_'.$field->id]) && $task->custom_fields_data['field_'.$field->id] != '') ? $field->values[$task->custom_fields_data['field_'.$field->id]] : '-'); ?>

                                        <?php elseif($field->type == 'checkbox'): ?>
                                            <?php echo e(!is_null($task->custom_fields_data['field_'.$field->id]) ? $field->values[$task->custom_fields_data['field_'.$field->id]] : '-'); ?>

                                        <?php elseif($field->type == 'date'): ?>
                                            <?php echo e(!is_null($task->custom_fields_data['field_'.$field->id]) ? \Carbon\Carbon::parse($task->custom_fields_data['field_'.$field->id])->format($global->date_format) : '--'); ?>

                                        <?php endif; ?>
                                    </p>
        
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        

                        <div class="row">

                            <div class="col-xs-12 col-md-12 m-t-10">
                                <label class="font-bold" for=""><?php echo app('translator')->get('app.description'); ?></label><br>
                                <div class="task-description m-t-10">
                                    <?php echo ucfirst($task->description); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile1">
                    <div class="col-xs-12 m-b-10">
                        <a href="javascript:;"  data-task-id="<?php echo e($task->id); ?>" class="add-sub-task"><i class="icon-plus"></i> <?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('modules.tasks.subTask'); ?></a>
                    </div>

                    <div class="col-xs-12 m-t-5">
                        <h5><i class="ti-check-box"></i> <?php echo app('translator')->get('modules.tasks.subTask'); ?>
                            <?php if(count($task->subtasks) > 0): ?>
                                <span class="pull-right"><span class="donut" data-peity='{ "fill": ["#00c292", "#eeeeee"],    "innerRadius": 5, "radius": 8 }'><?php echo e(count($task->completedSubtasks)); ?>/<?php echo e(count($task->subtasks)); ?></span> <span class="text-muted font-12"><?php echo e(floor((count($task->completedSubtasks)/count($task->subtasks))*100)); ?>%</span></span>
                            <?php endif; ?>
                        </h5>
                        <ul class="list-group b-t" id="sub-task-list">
                            <?php $__currentLoopData = $task->subtasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subtask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                    <div class="col-xs-3 text-right">
                                        <a href="javascript:;" data-sub-task-id="<?php echo e($subtask->id); ?>" title="<?php echo app('translator')->get('app.edit'); ?>" class="edit-sub-task"><i class="fa fa-pencil"></i></a>&nbsp;
                                        <a href="javascript:;" data-sub-task-id="<?php echo e($subtask->id); ?>" title="<?php echo app('translator')->get('app.delete'); ?>" class="delete-sub-task"><i class="fa fa-trash"></i></a>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages1">
                    <div class="col-xs-12">
                        <ul class="list-group" id="files-list">
                            <?php $__empty_1 = true; $__currentLoopData = $task->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item" id="task-file-<?php echo e($file->id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo e($file->filename); ?>

                                    </div>
                                    <div class="col-md-3">
                                        <span class=""><?php echo e($file->created_at->diffForHumans()); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                            <a target="_blank" href="<?php echo e($file->file_url); ?>"
                                               data-toggle="tooltip" data-original-title="View"
                                               class="btn btn-info btn-circle"><i
                                                        class="fa fa-search"></i></a>
                                        <?php if(is_null($file->external_link)): ?>
                                        <a href="<?php echo e(route('admin.task-files.download', $file->id)); ?>"
                                           data-toggle="tooltip" data-original-title="Download"
                                           class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                        <?php endif; ?>

                                        <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="<?php echo e($file->id); ?>"
                                           data-pk="list" class="btn btn-danger btn-circle file-delete"><i class="fa fa-times"></i></a>

                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <?php echo app('translator')->get('messages.noFileUploaded'); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="timelogs1">

                    <div class="col-xs-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('app.employee'); ?></th>
                                    <th><?php echo app('translator')->get('modules.employees.hoursLogged'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo e($item->image_url); ?>" width="25" height="25" class="img-circle">
                                        <span class="font-semi-bold"><?php echo e(ucwords($item->name)); ?></span><br>
                                    </td>
                                    <td>
                                        <?php
                                            $timeLog = intdiv($item->total_minutes, 60) . ' ' . __('app.hrs') . ' ';

                                            if (($item->total_minutes % 60) > 0) {
                                                $timeLog .= ($item->total_minutes % 60) . ' ' . __('app.mins');
                                            }
                                        ?>
                                        <?php echo e($timeLog); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="2">
                                        <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                    </td>

                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                </div>

                <div role="tabpanel" class="tab-pane" id="settings1">
                    <div class="col-xs-12">
                        <h4><?php echo app('translator')->get('modules.tasks.comment'); ?></h4>
                    </div>

                    <div class="col-xs-12" id="comment-container">
                        <div id="comment-list">
                            <?php $__empty_1 = true; $__currentLoopData = $task->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="row b-b m-b-5 font-12">
                                    <div class="col-xs-12 m-b-5">
                                        <span class="font-semi-bold"><?php echo e(ucwords($comment->user->name)); ?></span> <span class="text-muted font-12"><?php echo e(ucfirst($comment->created_at->diffForHumans())); ?></span>
                                    </div>
                                    <div class="col-xs-10">
                                        <?php echo ucfirst($comment->comment); ?>

                                    </div>
                                    <div class="col-xs-2 text-right">
                                        <a href="javascript:;" data-comment-id="<?php echo e($comment->id); ?>" class="btn btn-xs  btn-outline btn-default" onclick="deleteComment('<?php echo e($comment->id); ?>');return false;"><i class="fa fa-trash"></i> <?php echo app('translator')->get('app.delete'); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-xs-12">
                                    <?php echo app('translator')->get('messages.noCommentFound'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group" id="comment-box">
                        <div class="col-xs-12">
                            <textarea name="comment" id="task-comment" class="summernote" placeholder="<?php echo app('translator')->get('modules.tasks.comment'); ?>"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <a href="javascript:;" id="submit-comment" class="btn btn-info btn-sm"><i class="fa fa-send"></i> <?php echo app('translator')->get('app.submit'); ?></a>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="notes1">
                    <div class="col-xs-12">
                        <h4><?php echo app('translator')->get('app.notes'); ?></h4>
                    </div>

                    <div class="col-xs-12" id="note-container">
                        <div id="note-list">
                            <?php $__empty_1 = true; $__currentLoopData = $task->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="row b-b m-b-5 font-12">
                                    <div class="col-xs-12">
                                        <h5><?php echo e(ucwords($note->user->name)); ?> <span class="text-muted font-12"><?php echo e(ucfirst($note->created_at->diffForHumans())); ?></span></h5>
                                    </div>
                                    <div class="col-xs-10">
                                        <?php echo ucfirst($note->note); ?>

                                    </div>
                                    <div class="col-xs-2 text-right">
                                        <a href="javascript:;" data-comment-id="<?php echo e($note->id); ?>" class="btn btn-xs  btn-outline btn-default" onclick="deleteNote('<?php echo e($note->id); ?>');return false;"><i class="fa fa-trash"></i> <?php echo app('translator')->get('app.delete'); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-xs-12">
                                    <?php echo app('translator')->get('messages.noNoteFound'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group" id="note-box">
                        <div class="col-xs-12">
                            <textarea name="note" id="task-note" class="summernote" placeholder="<?php echo app('translator')->get('app.notes'); ?>"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <a href="javascript:;" id="submit-note" class="btn btn-info btn-sm"><i class="fa fa-send"></i> <?php echo app('translator')->get('app.submit'); ?></a>
                        </div>
                    </div>


                </div>

                <div role="tabpanel" class="tab-pane" id="history1">
                    <div class="col-xs-12">
                        <label class="font-bold"><?php echo app('translator')->get('modules.tasks.history'); ?></label>
                    </div>
                    <div class="col-xs-12" id="task-history-section">
                    </div>
                </div>
            </div>



        </div>

        <div class="col-xs-6 col-md-3 hidden-xs hidden-sm">

            <div class="row">
                <div class="col-xs-12 p-10 p-t-20 ">
                    <label class="font-12" for=""><?php echo app('translator')->get('app.status'); ?></label><br>
                    <span id="columnStatusColor" style="width: 15px; height: 15px; background-color: <?php echo e($task->board_column->label_color); ?>" class="btn btn-small btn-circle">&nbsp;</span> <span id="columnStatus"><?php echo e($task->board_column->column_name); ?></span>
                </div>

                <div class="col-xs-12">
                    <hr>

                    <label class="font-12" for=""><?php echo app('translator')->get('modules.tasks.assignTo'); ?></label><br>
                    <?php $__currentLoopData = $task->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($item->image_url); ?>" data-toggle="tooltip"
                             data-original-title="<?php echo e(ucwords($item->name)); ?>" data-placement="right"
                             class="img-circle" width="35" height="35" alt="">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr>
                </div>
                <?php if($task->create_by): ?>
                    <div class="col-xs-12">
                        <label class="font-12" for=""><?php echo app('translator')->get('modules.tasks.assignBy'); ?></label><br>
                        <img src="<?php echo e($task->create_by->image_url); ?>" class="img-circle" width="35" height="35" alt="">

                        <?php echo e(ucwords($task->create_by->name)); ?>

                        <hr>
                    </div>
                <?php endif; ?>

                <?php if($task->start_date): ?>
                    <div class="col-xs-12  ">
                        <label class="font-12" for=""><?php echo app('translator')->get('app.startDate'); ?></label><br>
                        <span class="text-success" ><?php echo e($task->start_date->format($global->date_format)); ?></span><br>
                        <hr>
                    </div>
                <?php endif; ?>

                <div class="col-xs-12 ">
                    <label class="font-12" for=""><?php echo app('translator')->get('app.dueDate'); ?></label><br>
                    <span <?php if($task->due_date->isPast()): ?> class="text-danger" <?php endif; ?>>
                        <?php echo e($task->due_date->format($global->date_format)); ?>

                    </span>
                    <hr>
                </div>

                <?php if($task->estimate_hours > 0 || $task->estimate_minutes > 0): ?>
                    <div class="col-xs-12 ">
                        <label class="font-12" for=""><?php echo app('translator')->get('app.estimate'); ?></label><br>

                        <span>
                            <?php echo e($task->estimate_hours); ?> <?php echo app('translator')->get('app.hrs'); ?>
                            <?php echo e($task->estimate_minutes); ?> <?php echo app('translator')->get('app.mins'); ?>
                        </span>
                        <hr>
                    </div>

                    <div class="col-xs-12 ">
                        <label class="font-12" for=""><?php echo app('translator')->get('modules.employees.hoursLogged'); ?></label><br>
                        <span>
                            <?php
                                $timeLog = intdiv($task->timeLogged->sum('total_minutes'), 60) . ' ' . __('app.hrs') . ' ';

                                if (($task->timeLogged->sum('total_minutes') % 60) > 0) {
                                    $timeLog .= ($task->timeLogged->sum('total_minutes') % 60) . ' ' . __('app.mins');
                                }
                            ?>
                            <span <?php if($task->total_estimated_minutes < $task->timeLogged->sum('total_minutes')): ?> class="text-danger font-semi-bold" <?php endif; ?>>
                                <?php echo e($timeLog); ?>

                            </span>
                        </span>
                        <hr>
                    </div>
                <?php else: ?>
                    <div class="col-xs-12 ">
                        <label class="font-12" for=""><?php echo app('translator')->get('modules.employees.hoursLogged'); ?></label><br>
                        <span>
                            <?php
                                $timeLog = intdiv($task->timeLogged->sum('total_minutes'), 60) . ' ' . __('app.hrs') . ' ';

                                if (($task->timeLogged->sum('total_minutes') % 60) > 0) {
                                    $timeLog .= ($task->timeLogged->sum('total_minutes') % 60) . ' ' . __('app.mins');
                                }
                            ?>
                            <span>
                                <?php echo e($timeLog); ?>

                            </span>
                        </span>
                        <hr>
                    </div>
                <?php endif; ?>

                <?php if(sizeof($task->label)): ?>
                    <div class="col-xs-12">
                        <label class="font-12" for=""><?php echo app('translator')->get('app.label'); ?></label><br>
                        <span>
                            <?php $__currentLoopData = $task->label; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="badge text-capitalize font-semi-bold" style="background:<?php echo e($label->label->label_color); ?>"><?php echo e(ucwords($label->label->label_name)); ?> </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                        <hr>
                    </div>
                <?php endif; ?>

            </div>


        </div>



    </div>

</div>

<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('#uploadedFiles').click(function () {

        var url = '<?php echo e(route("admin.all-tasks.show-files", ':id')); ?>';

        var id = <?php echo e($task->id); ?>;
        url = url.replace(':id', id);

        $('#subTaskModelHeading').html('Sub Task');
        $.ajaxModal('#subTaskModal', url);
    });
    $('body').on('click', '.edit-sub-task', function () {
        var id = $(this).data('sub-task-id');
        var url = '<?php echo e(route('admin.sub-task.edit', ':id')); ?>';
        url = url.replace(':id', id);

        $('#subTaskModelHeading').html('Sub Task');
        $.ajaxModal('#subTaskModal', url);
    })

    $('.add-sub-task').click(function () {
        var id = $(this).data('task-id');
        var url = '<?php echo e(route('admin.sub-task.create')); ?>?task_id='+id;

        $('#subTaskModelHeading').html('Sub Task');
        $.ajaxModal('#subTaskModal', url);
    })

    $('#reminderButton').click(function () {
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.reminderEmployee'); ?>",
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                confirm: {
                    text: "<?php echo app('translator')->get('messages.sendConfirmation'); ?>",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            }
        }).then( function (isConfirm) {
            if (isConfirm) {

                var url = '<?php echo e(route('admin.all-tasks.reminder', $task->id)); ?>';

                $.easyAjax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                       //
                    }
                });
            }
        });
    })

    $('body').on('click', '.delete-sub-task', function () {
        var id = $(this).data('sub-task-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteSubtask'); ?>!",
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                confirm: {
                    text: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            }
        }).then(function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('admin.sub-task.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $('#sub-task-list').html(response.view);
                        }
                    }
                });
            }
        });
    });

    $('#view-task-history').click(function () {
        var id = $(this).data('task-id');

        var url = '<?php echo e(route('admin.all-tasks.history', ':id')); ?>';
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            type: "GET",
            success: function (response) {
                $('#task-history-section').html(response.view)
            }
        })

    })

    $('.close-task-history').click(function () {
        $(this).hide();
        $('#task-detail-section').show();
        $('#view-task-history').show();
        $('#task-history-section').html('');
    })

    function saveSubTask() {
        $.easyAjax({
            url: '<?php echo e(route('admin.sub-task.store')); ?>',
            container: '#createSubTask',
            type: "POST",
            data: $('#createSubTask').serialize(),
            success: function (response) {
                $('#subTaskModal').modal('hide');
                $('#sub-task-list').html(response.view)
            }
        })
    }

    function updateSubTask(id) {
        var url = '<?php echo e(route('admin.sub-task.update', ':id')); ?>';
            url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#createSubTask',
            type: "POST",
            data: $('#createSubTask').serialize(),
            success: function (response) {
                $('#subTaskModal').modal('hide');
                $('#sub-task-list').html(response.view)
            }
        })
    }

    $('.summernote').summernote({
        height: 100,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,                 // set focus to editable area after initializing summernote,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ["view", ["fullscreen", "codeview"]]
        ]
    });

    //    change sub task status
    $('#sub-task-list').on('click', '.task-check', function () {
        if ($(this).is(':checked')) {
            var status = 'complete';
        }else{
            var status = 'incomplete';
        }

        var id = $(this).data('sub-task-id');
        var url = "<?php echo e(route('admin.sub-task.changeStatus')); ?>";
        var token = "<?php echo e(csrf_token()); ?>";

        $.easyAjax({
            url: url,
            type: "POST",
            data: {'_token': token, subTaskId: id, status: status},
            success: function (response) {
                if (response.status == "success") {
                    $('#sub-task-list').html(response.view);
                }
            }
        })
    });

    $('#submit-comment').click(function () {
        var comment = $('#task-comment').val();
        var token = '<?php echo e(csrf_token()); ?>';
        $.easyAjax({
            url: '<?php echo e(route("admin.task-comment.store")); ?>',
            type: "POST",
            data: {'_token': token, comment: comment, taskId: '<?php echo e($task->id); ?>'},
            success: function (response) {
                if (response.status == "success") {
                    $('#comment-list').html(response.view);
                    $('.summernote').summernote("reset");
                    $('.note-editable').html('');
                    $('#task-comment').val('');
                }
            }
        })
    })
    $('#submit-note').click(function () {
        var note = $('#task-note').val();
        var token = '<?php echo e(csrf_token()); ?>';
        $.easyAjax({
            url: '<?php echo e(route("admin.task-note.store")); ?>',
            type: "POST",
            data: {'_token': token, note: note, taskId: '<?php echo e($task->id); ?>'},
            success: function (response) {
                if (response.status == "success") {
                    $('#note-list').html(response.view);
                    $('.summernote').summernote("reset");
                    $('.note-editable').html('');
                    $('#task-note').val('');
                }
            }
        })
    })
    function deleteNote (id) {

        var url = '<?php echo e(route("admin.task-note.destroy", ':id')); ?>';
        url = url.replace(':id', id);

        $.easyAjax({
            url: url,
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $('#note-list').html(response.view);
                }
            }
        })
    }
    function deleteComment(id) {
        var commentId = id;
        var token = '<?php echo e(csrf_token()); ?>';

        var url = '<?php echo e(route("admin.task-comment.destroy", ':id')); ?>';
        url = url.replace(':id', commentId);

        $.easyAjax({
            url: url,
            type: "POST",
            container: '#comment-list',
            data: {'_token': token, '_method': 'DELETE', commentId: commentId},
            success: function (response) {
                if (response.status == "success") {
                    $('#comment-list').html(response.view);
                    $('.note-editable').html('');
                }
            }
        })
    }
    //    change task status
   function markComplete(status) {

        var id = '<?php echo e($task->id); ?>';

        if(status == 'completed'){
            var checkUrl = '<?php echo e(route('admin.tasks.checkTask', ':id')); ?>';
            checkUrl = checkUrl.replace(':id', id);
            $.easyAjax({
                url: checkUrl,
                type: "GET",
                container: '#task-list-panel',
                data: {},
                success: function (data) {
                    if(data.taskCount > 0){
                        swal({
                            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                            text: "<?php echo app('translator')->get('messages.confirmation.markTaskComplete'); ?>",
                            dangerMode: true,
                            icon: 'warning',
                            buttons: {
                                cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                                confirm: {
                                    text: "<?php echo app('translator')->get('messages.completeIt'); ?>",
                                    value: true,
                                    visible: true,
                                    className: "danger",
                                }
                            }
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                updateTask(id,status)
                            }
                        });
                    }
                    else{
                        updateTask(id,status)
                    }

                }
            });
        }
        else{
            updateTask(id,status)
        }


    }

    // Update Task
    function updateTask(id,status){
        var url = "<?php echo e(route('admin.tasks.changeStatus')); ?>";
        var token = "<?php echo e(csrf_token()); ?>";
        $.easyAjax({
            url: url,
            type: "POST",
            container: '.r-panel-body',
            data: {'_token': token, taskId: id, status: status, sortBy: 'id'},
            success: function (data) {
                $('#columnStatus').css('color', data.textColor);
                $('#columnStatus').html(data.column);
                if(status == 'completed'){

                    $('#inCompletedButton').removeClass('hidden');
                    $('#completedButton').addClass('hidden');
                    $('#reminderButton').addClass('hidden');
                }
                else{
                    $('#completedButton').removeClass('hidden');
                    $('#inCompletedButton').addClass('hidden');
                    $('#reminderButton').removeClass('hidden');
                }

                if( typeof table !== 'undefined'){
                    window.LaravelDataTables["allTasks-table"].draw();
                }
                else if(typeof loadData !== 'undefined' && $.isFunction(loadData)){
                    loadData();
                }
            }
        })
    }



</script>

<script>
    $('body').on('click', '.file-delete', function () {
        var id = $(this).data('file-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.deleteFile'); ?>",
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                confirm: {
                    text: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>!",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            }
        }).then(function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('admin.task-files.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $('#task-file-'+id).remove();
                            $('#totalUploadedFiles').html(response.totalFiles);
                            $('#list ul.list-group').html(response.html);
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '#pinnedItem', function(){
        var type = $('#pinnedItem').attr('data-pinned');
        var id = <?php echo e($task->id); ?>;
        var pinType = 'task';

        var dataPin = type.trim(type);
        if(dataPin == 'pinned'){
            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.removeFileText'); ?>",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                    confirm: {
                        text: "<?php echo app('translator')->get('messages.unpinIt'); ?>",
                        value: true,
                        visible: true,
                        className: "danger",
                    }
                }
            }).then(function (isConfirm) {
                if (isConfirm) {
                    var url = "<?php echo e(route('admin.pinned.destroy',':id')); ?>";
                    url = url.replace(':id', id);

                    var token = "<?php echo e(csrf_token()); ?>";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE','type':pinType},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                $('.pin-icon').removeClass('pinned');
                                $('.pin-icon').addClass('unpinned');
                                $('#pinnedItem').attr('data-pinned','unpinned');
                                $('#pinnedItem').attr('data-original-title','Pin');
                                $("#pinnedItem").tooltip("hide");
                                window.LaravelDataTables["allTasks-table"].draw();
                            }
                        }
                    })
                }
            });
        }
        else {
            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.pinTask'); ?>",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    cancel: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                    confirm: {
                        text: "<?php echo app('translator')->get('messages.pinIt'); ?>",
                        value: true,
                        visible: true,
                        className: "danger",
                    }
                }
            }).then(function (isConfirm) {
                if (isConfirm) {
                    var url = "<?php echo e(route('admin.pinned.store')); ?>?type="+pinType;

                    var token = "<?php echo e(csrf_token()); ?>";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token,'task_id':id},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                $('.pin-icon').removeClass('unpinned');
                                $('.pin-icon').addClass('pinned');
                                $('#pinnedItem').attr('data-pinned','pinned');
                                $('#pinnedItem').attr('data-original-title','Unpin');
                                $("#pinnedItem").tooltip("hide");
                                window.LaravelDataTables["allTasks-table"].draw();
                            }
                        }
                    });
                }
            });
        }
    });

</script><?php /**PATH /home/evalupro/public_html/resources/views/admin/tasks/show.blade.php ENDPATH**/ ?>