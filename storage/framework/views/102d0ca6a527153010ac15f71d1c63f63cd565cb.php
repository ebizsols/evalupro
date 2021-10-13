<?php $__currentLoopData = $boardColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="panel col-xs-3 board-column p-0" data-column-id="<?php echo e($column->id); ?>" >
        <div class="panel-heading p-t-5 p-b-5" >
            <div class="panel-title">
                <h6 style="color: <?php echo e($column->label_color); ?>"><?php echo e(ucwords($column->column_name)); ?>


                    <div style="position: relative;" class="dropdown pull-right">
                        <a href="javascript:;"  data-toggle="dropdown"  class="dropdown-toggle "><i class="ti-settings font-normal"></i></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:;" data-column-id="<?php echo e($column->id); ?>" class="add-task"><?php echo app('translator')->get('modules.tasks.newTask'); ?></a></li>
                            <li><a href="javascript:;" data-column-id="<?php echo e($column->id); ?>" class="edit-type" ><?php echo app('translator')->get('app.edit'); ?></a>
                            </li>
                            <?php if($column->slug != 'completed' && $column->slug != 'incomplete'): ?>
                                <li><a href="javascript:;" data-column-id="<?php echo e($column->id); ?>" class="delete-column"  ><?php echo app('translator')->get('app.delete'); ?></a></li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </h6>
            </div>
        </div>
        <div class="panel-body" id="taskBox_<?php echo e($column->id); ?>" style="height: 70vh; overflow-y: auto">
            <div class="row">
                <div class="col-xs-12" style="height: 400px !important;">
                    <?php $__currentLoopData = $column->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="panel panel-default lobipanel view-task" data-task-id="<?php echo e($task->id); ?>" data-sortable="true">
                            <div class="panel-body">
                                <div class="p-10 p-b-0 font-12 font-semi-bold"><?php echo e(ucfirst($task->heading)); ?>


                                    <?php if($task->is_private): ?>
                                        <label class="label pull-right" style="background: #ea4c89"><?php echo app('translator')->get('app.private'); ?></label>
                                    <?php endif; ?>
                                </div>

                                <?php if(!is_null($task->project_id)): ?>
                                    <div class="p-10 p-t-5 text-muted"><small><i class="icon-layers"></i> <?php echo e(ucfirst($task->project->project_name)); ?></small></div>
                                <?php endif; ?>

                                <?php if(!is_null($task->label)): ?>
                                    <div class="p-10">
                                        <?php $__currentLoopData = $task->label; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="badge text-capitalize font-semi-bold" style="background:<?php echo e($label->label->label_color); ?>"><?php echo e(ucwords($label->label->label_name)); ?> </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="p-t-10 p-b-10 p-10">
                                    <?php $__currentLoopData = $task->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="<?php echo e($item->image_url); ?>" data-toggle="tooltip" data-original-title="<?php echo e(ucwords($item->name)); ?> " data-placement="right"
                                         alt="user" class="img-circle" width="25" height="25">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="bg-grey p-10">
                                    <?php if($task->due_date->endOfDay()->isPast()): ?>
                                        <span class="text-danger"><i class="icon-calender"></i> <?php echo e($task->due_date->format($global->date_format)); ?></span>
                                    <?php elseif($task->due_date->setTimezone($global->timezone)->isToday()): ?>
                                        <span class="text-success"><i class="icon-calender"></i> <?php echo app('translator')->get('app.today'); ?></span>
                                    <?php else: ?>
                                        <span><i class="icon-calender"></i> <?php echo e($task->due_date->format($global->date_format)); ?></span>
                                    <?php endif; ?>

                                    <span class="pull-right" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('modules.tasks.comment'); ?>" data-placement="left" >
                                        <i class="ti-comment"></i> <?php echo e(count($task->comments)); ?>

                                    </span>

                                    <?php if(count($task->subtasks) > 0): ?>
                                        <span class="pull-right m-r-5" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('modules.tasks.subTask'); ?>" data-placement="left" >
                                            <i class="ti-check-box"></i> <?php echo e(count($task->completedSubtasks)); ?> / <?php echo e(count($task->subtasks)); ?>

                                        </span>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel panel-default lobipanel"  data-sortable="true"></div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
    $(function () {
        // <?php $__currentLoopData = $boardColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // $('#taskBox_<?php echo e($column->id); ?>').slimScroll({
        //     height: '70vh'
        // });
        // <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $('.lobipanel').on('dragged.lobiPanel', function () {
            var $parent = $(this).parent(),
                $children = $parent.children();

            var boardColumnIds = [];
            var taskIds = [];
            var prioritys = [];

            $children.each(function (ind, el) {
//                console.log(el, $(el).index());
                boardColumnIds.push($(el).closest('.board-column').data('column-id'));
                taskIds.push($(el).data('task-id'));
                prioritys.push($(el).index());
            });

            // update values for all tasks
            $.easyAjax({
                url: '<?php echo e(route("admin.taskboard.updateIndex")); ?>',
                type: 'POST',
                data:{boardColumnIds: boardColumnIds, taskIds: taskIds, prioritys: prioritys,'_token':'<?php echo e(csrf_token()); ?>'},
                success: function (response) {
                }
            });

            $("body").tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            $('.board-column').each(function () {
                let lobipanelItems = $(this).find('.view-task').length;
                // console.log(lobipanelItems);
                if (lobipanelItems == 1) {
                    $(this).find('.lobipanel:first').addClass('m-b-0');
                }
            })

        }).lobiPanel({
            sortable: true,
            reload: false,
            editTitle: false,
            close: false,
            minimize: false,
            unpin: false,
            expand: false

        });

        var isDragging = 0;
        $('.lobipanel-parent-sortable').on('sortactivate', function(){
            // console.log("activate event handle");
            $('.board-column > .panel-body').css('overflow-y', 'unset');
            isDragging = 1;
        });
        $('.lobipanel-parent-sortable').on('sortstop', function(e){
            // console.log("stop event handle");
            $('.board-column > .panel-body').css('overflow-y', 'auto');
            isDragging = 0;
        });



        $('.view-task').click(function () {
            if (isDragging == 0) {
                $(".right-sidebar").slideDown(50).addClass("shw-rside");

                var id = $(this).data('task-id');
                var url = "<?php echo e(route('admin.all-tasks.show',':id')); ?>";
                url = url.replace(':id', id);

                $.easyAjax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                        if (response.status == "success") {
                            $('#right-sidebar-content').html(response.view);
                        }
                    }
                });

            }
        })



        $('.add-task').click(function () {
            var id = $(this).data('column-id');
            var url = '<?php echo e(route('admin.all-tasks.ajaxCreate', ':id')); ?>';
            url = url.replace(':id', id);

            $('#modelHeading').html('Add Task');
            $.ajaxModal('#eventDetailModal', url);
        })

        $('.delete-column').click(function () {
            var id = $(this).data('column-id');
            var url = '<?php echo e(route('admin.taskboard.destroy', ':id')); ?>';
            url = url.replace(':id', id);

            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.confirmation.recoveColumn'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {
                    $.easyAjax({
                        url: url,
                        type: 'POST',
                        data: { '_token': '<?php echo e(csrf_token()); ?>', '_method': 'DELETE'},
                        success: function (response) {
                            if(response.status == 'success'){
                                window.location.reload();
                            }
                        }
                    });

                }
            });

        })


        
            
            
            

            
                
                
                
                    
                    
                    
                
            
        

    });
</script>
<?php /**PATH /home/evalupro/public_html/resources/views/admin/taskboard/board_data.blade.php ENDPATH**/ ?>