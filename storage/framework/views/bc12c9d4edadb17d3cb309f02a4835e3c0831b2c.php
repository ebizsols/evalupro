<li class="top-notifications">
    <div class="message-center">
        <?php
            if (!isset($notification->data['project'])) {
                $project = \App\ProjectMember::with('project')->find($notification->data['id']);
                $projectId = $project->project_id;
                $project = $project->project ? $project->project->project_name : '';
            } else {
                $projectId = $notification->data['project_id'];
                $project = $notification->data['project'];
            }
            $route = route('admin.projects.show', $projectId);
        ?>
        <a href="<?php echo e($route); ?>" >
            <div class="user-img">
                <span class="btn btn-circle btn-success"><i class="icon-layers"></i></span>
            </div>
            <div class="mail-contnet">
                <span class="mail-desc m-0"><?php echo app('translator')->get('email.newProjectMember.subject'); ?></span>
                <small><?php echo e(ucwords($project)); ?></small>
                <span class="time"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans()); ?></span>
            </div>
        </a>
    </div>
</li>
<?php /**PATH /home/evalupro/public_html/resources/views/notifications/admin/new_project_member.blade.php ENDPATH**/ ?>