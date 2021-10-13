<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?> #<?php echo e($project->id); ?> - <span class="font-bold"><?php echo e(ucwords($project->project_name)); ?></span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.projects.edit', $project->id)); ?>" class="btn btn-sm btn-success btn-outline" ><i class="icon-note"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('modules.projects.members'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/icheck/skins/all.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/multiselect/css/multi-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    <?php echo $__env->make('admin.projects.show_project_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="content-wrap">
                        <section id="section-line-2" class="show">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-inverse">
                                            <div class="panel-heading"><?php echo app('translator')->get('modules.projects.addMemberTitle'); ?></div>

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                <?php echo Form::open(['id'=>'createMembers','class'=>'ajax-form','method'=>'POST']); ?>


                                                <div class="form-body">

                                                    <?php echo Form::hidden('project_id', $project->id); ?>


                                                    <div class="form-group" id="user_id">
                                                        <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                                                data-placeholder="<?php echo app('translator')->get('modules.messages.chooseMember'); ?>" name="user_id[]">
                                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($emp->id); ?>"><?php echo e(ucwords($emp->name)); ?> <?php if($emp->id == $user->id): ?>
                                                                        (YOU) <?php endif; ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-actions">
                                                        <button type="submit" id="save-members" class="btn btn-success"><i
                                                                    class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?>
                                                        </button>
                                                    </div>
                                                </div>

                                                <?php echo Form::close(); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                 
                                    <div class="col-md-6">
                                        <div class="panel panel-inverse">
                                            <div class="panel-heading"><?php echo app('translator')->get('modules.projects.addIntendedUser'); ?></div>

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <?php echo Form::open(['id'=>'createIntendedUsers','class'=>'ajax-form','method'=>'POST']); ?>


                                                    <div class="form-body">

                                                        <?php echo Form::hidden('project_id', $project->id); ?>


                                                        <div class="form-group" id="iuser_id">
                                                            <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                                                    data-placeholder="<?php echo app('translator')->get('modules.messages.chooseMember'); ?>" name="user_id[]">
                                                                <?php $__currentLoopData = $intendedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($emp->id); ?>"><?php echo e(ucwords($emp->title)); ?> </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-actions">
                                                            <button type="submit" id="save-iuser" class="btn btn-success"><i
                                                                        class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h3><?php echo app('translator')->get('modules.projects.memberTitle'); ?></h3>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo app('translator')->get('app.name'); ?></th>
                                                                <th><?php echo app('translator')->get('modules.employees.hourlyRate'); ?></th>
                                                                <th><?php echo app('translator')->get('app.role'); ?></th>
                                                                <th><?php echo app('translator')->get('app.action'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $project->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">

                                                                        <div class="col-sm-3 col-xs-4">
                                                                            <img src="<?php echo e($member->user->image_url); ?>" alt="user" class="img-circle" width="40" height="40">

                                                                        </div>
                                                                        <div class="col-sm-9 col-xs-8">
                                                                                <?php echo e(ucwords($member->user->name)); ?><br>

                                                                                <span class="text-muted font-12"><?php echo e((!is_null($member->user->employeeDetail) && !is_null($member->user->employeeDetail->designation)) ? ucwords($member->user->employeeDetail->designation->name) : ' '); ?></span>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo e($member->hourly_rate); ?>

                                                                </td>
                                                                <td>
                                                                    <div class="radio radio-info">
                                                                        <input type="radio" name="project_admin" class="assign_role" id="project_admin_<?php echo e($member->user->id); ?>" value="<?php echo e($member->user->id); ?>"
                                                                        <?php if($member->user->id == $project->project_admin): ?> checked <?php endif; ?>
                                                                        >
                                                                        <label for="project_admin_<?php echo e($member->user->id); ?>"> <?php echo app('translator')->get('app.projectAdmin'); ?> </label>
                                                                        <?php if($member->user->id == $project->project_admin): ?> 
                                                                            <br><a href="javascript:;" class="text-danger remove-admin"><i class="fa fa-times"></i> <?php echo app('translator')->get('app.remove'); ?></a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" data-member-id="<?php echo e($member->id); ?>" class="btn btn-sm btn-info btn-outline edit-members"><i class="fa fa-pencil"></i></a>

                                                                    <a href="javascript:;" data-member-id="<?php echo e($member->id); ?>" class="btn btn-sm btn-danger btn-outline delete-members"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo app('translator')->get('messages.noMemberAddedToProject'); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <h3><?php echo app('translator')->get('modules.projects.intendedUser'); ?></h3>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo app('translator')->get('app.name'); ?></th>
                                                                <th class="text-right"><?php echo app('translator')->get('app.action'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $projectIntendedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td>
                                                                      <?php echo e(ucwords($member->title)); ?>

                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="javascript:;" data-project-id="<?php echo e($project->id); ?>" data-intended-id="<?php echo e($member->id); ?>" class="btn btn-sm btn-danger btn-outline delete-intended-members"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo app('translator')->get('messages.noMemberAddedToProject'); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </section>

                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript">

    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });

    //    save project members
    $('#save-members').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.project-members.store')); ?>',
            container: '#createMembers',
            type: "POST",
            data: $('#createMembers').serialize(),
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                    window.location.reload();
                }
            }
        })
    });
/*
//    add group members
$('#save-group').click(function () {
    $.easyAjax({
        url: '<?php echo e(route('admin.project-members.storeGroup')); ?>',
        container: '#saveGroup',
        type: "POST",
        data: $('#saveGroup').serialize(),
        success: function (response) {
            if (response.status == "success") {
                $.unblockUI();
                window.location.reload();
            }
        }
    })
});*/
//    add group members
$('#save-iuser').click(function () {
    $.easyAjax({
        url: '<?php echo e(route('admin.project-members.intendedUser')); ?>',
        container: '#createIntendedUsers',
        type: "POST",
        data: $('#createIntendedUsers').serialize(),
        success: function (response) {
            if (response.status == "success") {
                $.unblockUI();
                window.location.reload();
            }
        }
    })
});



$('body').on('click', '.edit-members', function(){
    var id = $(this).data('member-id');
    var url = '<?php echo e(route('admin.project-members.edit', ":id")); ?>';
    url = url.replace(':id', id);
    $('#modelHeading').html('<?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('modules.projects.milestones'); ?>');
    $.ajaxModal('#projectTimerModal',url);
    
});


$('body').on('click', '.delete-members', function(){
    var id = $(this).data('member-id');
    swal({
        title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
        text: "<?php echo app('translator')->get('messages.confirmation.projectTemplate'); ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
        cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm){
        if (isConfirm) {

            var url = "<?php echo e(route('admin.project-members.destroy',':id')); ?>";
            url = url.replace(':id', id);

            var token = "<?php echo e(csrf_token()); ?>";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token, '_method': 'DELETE'},
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                        window.location.reload();
                    }
                }
            });
        }
    });
});

$('body').on('click', '.delete-intended-members', function(){
    var id = $(this).data('intended-id');
    var projectId = $(this).data('project-id');
    swal({
        title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
        text: "<?php echo app('translator')->get('messages.confirmation.projectTemplate'); ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
        cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm){
        if (isConfirm) {

            var url = "<?php echo e(route('admin.project-members.destroyIntendedUser',':id')); ?>";
            url = url.replace(':id', id);

            var token = "<?php echo e(csrf_token()); ?>";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token, '_method': 'POST','id':id,'project':projectId},
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                        window.location.reload();
                    }
                }
            });
        }
    });
});

$('body').on('click', '.assign_role', function(){
    var userId = $(this).val();
    var projectId = '<?php echo e($project->id); ?>';
    var token = "<?php echo e(csrf_token()); ?>";

    $.easyAjax({
        url: '<?php echo e(route('admin.employees.assignProjectAdmin')); ?>',
        type: "POST",
        data: {userId: userId, projectId: projectId, _token : token},
        success: function (response) {
            if(response.status == "success"){
                $.unblockUI();
                window.location.reload();
            }
        }
    })

});

$('body').on('click', '.remove-admin', function(){
    var userId = null;
    var projectId = '<?php echo e($project->id); ?>';
    var token = "<?php echo e(csrf_token()); ?>";

    $.easyAjax({
        url: '<?php echo e(route('admin.employees.assignProjectAdmin')); ?>',
        type: "POST",
        data: {userId: userId, projectId: projectId, _token : token},
        success: function (response) {
            if(response.status == "success"){
                $.unblockUI();
                window.location.reload();
            }
        }
    })

});

$('ul.showProjectTabs .projectMembers').addClass('tab-current');

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/project-member/create.blade.php ENDPATH**/ ?>