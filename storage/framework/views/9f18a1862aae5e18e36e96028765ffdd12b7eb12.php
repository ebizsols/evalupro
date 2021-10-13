<li class="top-notifications">
    <div class="message-center">
        <a href="<?php echo e(route('admin.projects.discussion', $notification->data['project_id'])); ?>">
            <div class="user-img">
                <span class="btn btn-circle btn-success"><i class="ti-comments"></i></span>
            </div>
            <div class="mail-contnet">
                <span class="mail-desc m-0"><?php echo e(__('email.discussion.subject')); ?></span> 
                <small><?php echo e($notification->data['title']); ?></small>
                <span class="time"><?php if($notification->created_at): ?><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans()); ?><?php endif; ?></span>
            </div>
        </a>
    </div>
</li>
<?php /**PATH /home/evalupro/public_html/resources/views/notifications/admin/new_discussion.blade.php ENDPATH**/ ?>