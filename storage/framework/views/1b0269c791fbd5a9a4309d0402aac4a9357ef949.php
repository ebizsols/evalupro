<li class="top-notifications">
    <div class="message-center">
        <a href="<?php echo e(route('front.task-share',[md5($notification->data['id'])])); ?>" target="_blank">
            <div class="user-img">
                <span class="btn btn-circle btn-info"><i class="fa fa-tasks"></i></span>
            </div>
            <div class="mail-contnet">
                <span class="mail-desc m-0"><?php echo app('translator')->get('email.subTaskCreated'); ?></span> 
                <small><?php echo e(ucfirst($notification->data['heading'])); ?></small>
                <span class="time"><?php if($notification->created_at): ?><?php echo e(\Carbon\Carbon::parse( $notification->created_at)->diffForHumans()); ?><?php endif; ?></span>
            </div>
        </a>
    </div>
</li>
<?php /**PATH /home/evalupro/public_html/resources/views/notifications/admin/sub_task_created.blade.php ENDPATH**/ ?>