<li class="top-notifications">
    <div class="message-center">
        <a href="<?php echo e(route('front.task-share',[md5($notification->data['id'])])); ?>" target="_blank">
            <div class="user-img">
                <span class="btn btn-circle btn-info"><i class="icon-list"></i></span>
            </div>
            <div class="mail-contnet">
                <span class="mail-desc m-0"><?php echo e(__('email.newTask.subject')); ?></span>
                <small><?php echo e(ucfirst($notification->data['heading'])); ?></small>
                <span class="time"><?php if($notification->created_at): ?><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans()); ?><?php endif; ?></span>
            </div>
        </a>
    </div>
</li>
<?php /**PATH /home/evalupro/public_html/resources/views/notifications/admin/new_task.blade.php ENDPATH**/ ?>