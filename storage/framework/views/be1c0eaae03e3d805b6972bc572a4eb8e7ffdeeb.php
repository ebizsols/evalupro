<li class="top-notifications">
    <div class="message-center">
        <a href="<?php echo e(route('front.task-share',[md5($notification->data['id'])])); ?>" target="_blank">
            <div class="user-img">
                <span class="btn btn-circle btn-success"><i class="fa fa-tasks"></i></span>
            </div>
            <div class="mail-contnet">
                <span class="mail-desc m-0"><?php echo app('translator')->get('email.subTaskComplete.subject'); ?></span>
                <small><?php echo e(ucfirst($notification->data['heading'])); ?></small>
                <span class="time"><?php if($notification->data['completed_on']): ?><?php echo e(\Carbon\Carbon::parse( $notification->data['completed_on'])->diffForHumans()); ?><?php endif; ?></span>
            </div>
        </a>
    </div>
</li>
<?php /**PATH /home/evalupro/public_html/resources/views/notifications/admin/sub_task_completed.blade.php ENDPATH**/ ?>