<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?> #<?php echo e($project->id); ?> - <span
                        class="font-bold"><?php echo e(ucwords($project->project_name)); ?></span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('modules.projects.files'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.css')); ?>">
    <style>
        .file-bg {
            height: 150px;
            overflow: hidden;
            position: relative;
        }
        .file-bg .overlay-file-box {
            opacity: .9;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            text-align: center;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <?php echo $__env->make('admin.projects.show_project_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="content-wrap">
                        <section id="section-line-3" class="show">
                            <div class="row">
                                <div class="col-xs-12" id="files-list-panel">
                                    <div class="white-box">
                                        <h2><?php echo app('translator')->get('modules.projects.files'); ?></h2>

                                        <div class="row m-b-10">

                                                <div class="col-md-2">
                                                    <a href="javascript:;" id="show-dropzone"
                                                       class="btn btn-success btn-outline"><i class="ti-upload"></i> <?php echo app('translator')->get('modules.projects.uploadFile'); ?></a>
                                                </div>

                                            <div class="col-md-2">
                                                <a href="javascript:;" id="show-link-form"
                                                   class="btn btn-success btn-outline"><i class="ti-link"></i> <?php echo app('translator')->get('modules.projects.addFileLink'); ?></a>
                                            </div>
                                        </div>

                                        <div class="row m-b-20 hide" id="file-dropzone">
                                            <div class="col-xs-12">
                                                <?php if($upload): ?>
                                                    <form action="<?php echo e(route('admin.files.store')); ?>" class="dropzone"
                                                          id="file-upload-dropzone">
                                                        <?php echo e(csrf_field()); ?>


                                                        <?php echo Form::hidden('project_id', $project->id); ?>


                                                        <input name="view" type="hidden" id="view" value="list">

                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple/>
                                                        </div>
                                                    </form>

                                                <?php else: ?>
                                                    <div class="alert alert-danger"><?php echo app('translator')->get('messages.storageLimitExceed', ['here' => '<a href='.route('admin.billing.packages'). '>Here</a>']); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row m-b-20 hide" id="file-link">
                                            <?php echo Form::open(['id'=>'file-external-link','class'=>'ajax-form','method'=>'POST']); ?>



                                                <?php echo Form::hidden('project_id', $project->id); ?>


                                                <input name="view" type="hidden" id="view" value="list">
                                                <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for=""><?php echo app('translator')->get('app.name'); ?></label>
                                                            <input type="text" name="filename" class="form-control">
                                                        </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for=""><?php echo app('translator')->get('modules.projects.addFileLink'); ?></label>
                                                        <input type="text" name="external_link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="save-link"><?php echo app('translator')->get('app.submit'); ?></button>
                                                </div>
                                                </div>

                                            <?php echo Form::close(); ?>

                                        </div>

                                        <ul class="nav nav-tabs" role="tablist" id="list-tabs">
                                            <li role="presentation" class="active nav-item" data-pk="list"><a href="#list" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">  <?php echo app('translator')->get('app.list'); ?></span></a></li>
                                            <li role="presentation" class="nav-item" data-pk="thumbnail"><a href="#thumbnail" class="nav-link thumbnail" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"><?php echo app('translator')->get('app.thumbnail'); ?></span></a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="list">
                                                <ul class="list-group" id="files-list">
                                                    <?php $__empty_1 = true; $__currentLoopData = $project->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <?php echo e($file->filename); ?>

                                                                </div>
                                                                <div class="col-md-3">
                                                                        <a target="_blank" href="<?php echo e($file->file_url); ?>"
                                                                           data-toggle="tooltip" data-original-title="View"
                                                                           class="btn btn-info btn-circle"><i
                                                                                    class="fa fa-search"></i></a>

                                                                    <?php if(is_null($file->external_link)): ?>
                                                                    &nbsp;&nbsp
                                                                    <a href="<?php echo e(route('admin.files.download', $file->id)); ?>"
                                                                       data-toggle="tooltip" data-original-title="Download"
                                                                       class="btn btn-default btn-circle"><i
                                                                                class="fa fa-download"></i></a>
                                                                    <?php endif; ?>
                                                                    &nbsp;&nbsp;
                                                                    <a href="javascript:;" data-toggle="tooltip"
                                                                       data-original-title="Delete"
                                                                       data-file-id="<?php echo e($file->id); ?>"
                                                                       class="btn btn-danger btn-circle sa-params" data-pk="list"><i
                                                                                class="fa fa-times"></i></a>
                                                                    <span class="m-l-10"><?php echo e($file->created_at->diffForHumans()); ?></span>
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
                                            <div role="tabpanel" class="tab-pane" id="thumbnail">

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
<script src="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.js')); ?>"></script>
<script>
    $('#show-dropzone').click(function () {
        $('#file-dropzone').toggleClass('hide show');
    });

    $('#show-link-form').click(function () {
        $('#file-link').toggleClass('hide show');
    });

    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    <?php if($upload): ?>
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.fileUploadDropzone = {
        paramName: "file", // The name that will be used to transfer the file
//        maxFilesize: 2, // MB,
        dictDefaultMessage: "<?php echo app('translator')->get('modules.projects.dropFile'); ?>",
        accept: function (file, done) {
            done();
        },
        init: function () {
            this.on("success", function (file, response) {

                if(response.status == 'fail') {
                    $.showToastr(response.message, 'error');
                    return;
                }

                var viewName = $('#view').val();
                if(viewName == 'list') {
                    $('#files-list-panel ul.list-group').html(response.html);
                } else {
                    $('#thumbnail').empty();
                    $(response.html).hide().appendTo("#thumbnail").fadeIn(500);
                }
            })
        }
    };
    <?php endif; ?>

    $('body').on('click', '.sa-params', function () {
        var id = $(this).data('file-id');
        var deleteView = $(this).data('pk');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteFile'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('admin.files.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE', 'view': deleteView},
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            $.unblockUI();
                            if(deleteView == 'list') {
                                $('#files-list-panel ul.list-group').html(response.html);
                            } else {
                                $('#thumbnail').empty();
                                $(response.html).hide().appendTo("#thumbnail").fadeIn(500);
                            }
                        }
                    }
                });
            }
        });
    });

    $('.thumbnail').on('click', function(event) {
        event.preventDefault();
        $('#thumbnail').empty();
        var projectID = "<?php echo e($project->id); ?>";
        $.easyAjax({
            type: 'GET',
            url: "<?php echo e(route('admin.files.thumbnail')); ?>",
            data: {
              id: projectID
            },
            success: function (response) {
                $(response.view).hide().appendTo("#thumbnail").fadeIn(500);
            }
        });
    });

    $('#save-link').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.files.storeLink')); ?>',
            container: '#file-external-link',
            type: "POST",
            redirect: true,
            data: $('#file-external-link').serialize(),
            success: function () {
                window.location.reload();
            }
        })
    });

    $('#list-tabs').on("shown.bs.tab",function(event){
        var tabSwitch = $('#list').hasClass('active');
        if(tabSwitch == true) {
            $('#view').val('list');
        } else {
            $('#view').val('thumbnail');
        }
    });
    $('ul.showProjectTabs .projectFiles').addClass('tab-current');
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/project-files/show.blade.php ENDPATH**/ ?>