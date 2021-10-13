<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-7 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo app('translator')->get('app.project'); ?> #<?php echo e($project->id); ?>

                - <?php echo e(ucwords($project->project_name)); ?></h4>

        </div>

        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-5 col-sm-8 col-md-8 col-xs-12 text-right">
            <?php $projectPin = $project->pinned(); ?>
            <a href="javascript:;" class="btn btn-sm btn-info <?php if(!$projectPin): ?> btn-outline <?php endif; ?>"
               data-placement="bottom" data-toggle="tooltip"
               data-original-title="<?php if($projectPin): ?> <?php echo app('translator')->get('app.unpin'); ?> <?php else: ?> <?php echo app('translator')->get('app.pin'); ?> <?php endif; ?>"
               data-pinned="<?php if($projectPin): ?> pinned <?php else: ?> unpinned <?php endif; ?>" id="pinnedItem">
                <i class="icon-pin icon-2 pin-icon  <?php if($projectPin): ?> pinned <?php else: ?> unpinned <?php endif; ?>"></i>
            </a>

            <a href="<?php echo e(route('admin.payments.create', ['project' => $project->id])); ?>"
               class="btn btn-sm btn-primary btn-outline"><i
                        class="fa fa-plus"></i> <?php echo app('translator')->get('modules.payments.addPayment'); ?></a>

            <?php
                if ($project->status == 'in progress') {
                    $statusText = __('app.inProgress');
                    $statusTextColor = 'text-info';
                    $btnTextColor = 'btn-info';
                } else if ($project->status == 'on hold') {
                    $statusText = __('app.onHold');
                    $statusTextColor = 'text-warning';
                    $btnTextColor = 'btn-warning';
                } else if ($project->status == 'not started') {
                    $statusText = __('app.notStarted');
                    $statusTextColor = 'text-warning';
                    $btnTextColor = 'btn-warning';
                } else if ($project->status == 'canceled') {
                    $statusText = __('app.canceled');
                    $statusTextColor = 'text-danger';
                    $btnTextColor = 'btn-danger';
                } else if ($project->status == 'finished') {
                    $statusText = __('app.finished');
                    $statusTextColor = 'text-success';
                    $btnTextColor = 'btn-success';
                }
            ?>

            <div class="btn-group dropdown">
                <button aria-expanded="true" data-toggle="dropdown"
                        class="btn b-all dropdown-toggle waves-effect waves-light visible-lg visible-md"
                        type="button"><?php echo e($statusText); ?> <span style="width: 15px; height: 15px;"
                                                              class="btn <?php echo e($btnTextColor); ?> btn-small btn-circle">&nbsp;</span>
                </button>
                <ul role="menu" class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;" class="submit-ticket" data-status="in progress"><?php echo app('translator')->get('app.inProgress'); ?>
                            <span style="width: 15px; height: 15px;"
                                  class="btn btn-info btn-small btn-circle">&nbsp;</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="submit-ticket" data-status="on hold"><?php echo app('translator')->get('app.onHold'); ?>
                            <span style="width: 15px; height: 15px;"
                                  class="btn btn-warning btn-small btn-circle">&nbsp;</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="submit-ticket" data-status="not started"><?php echo app('translator')->get('app.notStarted'); ?>
                            <span style="width: 15px; height: 15px;"
                                  class="btn btn-warning btn-small btn-circle">&nbsp;</span>
                        </a>
                    </li>
                    <i class="icon-pushpin "></i>
                    <li>
                        <a href="javascript:;" class="submit-ticket" data-status="canceled"><?php echo app('translator')->get('app.canceled'); ?>
                            <span style="width: 15px; height: 15px;"
                                  class="btn btn-danger btn-small btn-circle">&nbsp;</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="submit-ticket" data-status="finished"><?php echo app('translator')->get('app.finished'); ?>
                            <span style="width: 15px; height: 15px;"
                                  class="btn btn-success btn-small btn-circle">&nbsp;</span>
                        </a>
                    </li>
                </ul>
            </div>

            <a href="<?php echo e(route('admin.projects.edit', $project->id)); ?>" class="btn btn-sm btn-success btn-outline"><i
                        class="icon-note"></i> <?php echo app('translator')->get('app.edit'); ?></a>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('app.details'); ?></li>
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
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">

    <style>
        #section-line-1 .col-in {
            padding: 0 10px;
        }

        #section-line-1 .col-in h3 {
            font-size: 15px;
        }

        #project-timeline .panel-body {
            max-height: 389px !important;
        }

        #milestones .panel-body {
            max-height: 189px;
            overflow: auto;
        }

        .panel-body {
            overflow-wrap: break-word;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    <?php echo $__env->make('admin.projects.show_project_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row project-top-stats">
                                    <div class="col-md-3 m-b-20 m-t-10 text-center">
                                        <span class="text-primary">
                                            <?php echo e($dayPassed); ?>

                                        </span>
                                        <span
                                                class="font-12 text-muted m-l-5"> Day Passed </span>
                                    </div>

                                    <div class="col-md-3 m-b-20 m-t-10 text-center b-l">

                                        <span class="text-success">
                                            #
                                        </span>
                                        <span
                                                class="font-12 text-muted m-l-5"> Balance Days </span>
                                    </div>

                                    <div class="col-md-3 m-b-20 m-t-10 text-center b-l">
                                        <span class="text-info">
                                            <?php echo e($hoursLogged); ?>

                                        </span>
                                        <span
                                                class="font-12 text-muted m-l-5"> Hours Logged </span>
                                    </div>
                                    <div class="col-md-3 m-b-20 m-t-10 text-center b-l">

                                        <span class="text-warning">
                                            <?php echo e($projectPendingTask); ?>

                                        </span>
                                        <span
                                                class="font-12 text-muted m-l-5"> Pending Tasks  </span>

                                    </div>
                                </div>

                                <div class="row m-t-20">
                                    <div class="col-xs-12">
                                        <div class="panel ">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body b-all border-radius">
                                                    <div class="row">
                                                        <div class="row project-top-stats">
                                                            <div class="col-md-3 m-b-20 m-t-10 text-center">
                                                                <span class="font-12 text-muted m-l-5"> Purpose of valuation </span>
                                                                <div><?php echo e($productSubCategory); ?></div>
                                                            </div>

                                                            <div class="col-md-3 m-b-20 m-t-10 text-center b-l">
                                                                <span class="font-12 text-muted m-l-5"> Basis of Valuation </span>
                                                                <div> <?php echo e($productCategory); ?></div>
                                                            </div>

                                                            <div class="col-md-3 m-b-20 m-t-10 text-center b-l">
                                                                <span class="font-12 text-muted m-l-5"> Approach </span>
                                                                <div><?php echo e($approaches_value); ?></div>
                                                            </div>
                                                            <div class="col-md-3 m-b-20 m-t-10 text-center b-l">
                                                                <span class="font-12 text-muted m-l-5"> Method  </span>
                                                                <div><?php echo e($methods_value); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-10">
                                    <div class="col-md-6">

                                        <div class="panel b-all border-radius" id="">
                                            <div class="panel-heading b-b"> Valuation Summary  </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="col-xs-12"
                                                         style="max-height: 100px; overflow-y: hidden;">

                                                        <?php echo $project->project_summary; ?>


                                                    </div>
                                                    <div class="col-xs-12 text-center">
                                                        <a href="javascript:;" class="btn p-t-15 text-info"
                                                           data-toggle="modal" data-target="#project-summary-modal"><i
                                                                    class="ti-arrows-vertical"></i> <?php echo app('translator')->get('app.expand'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel b-all border-radius" id="">
                                            <div class="panel-heading b-b"> Product Detail  </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Title</label><br>
                                                            <p>
                                                                <?php echo e($productName); ?>

                                                            </p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Property Type</label><br>
                                                            <p>
                                                                <?php echo e($selectedPropertyType); ?>

                                                            </p>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Category</label><br>
                                                            <p>
                                                                <?php echo e($productCategory); ?>

                                                            </p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Sub Category</label><br>
                                                            <p>
                                                               <?php echo e($productSubCategory); ?>

                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-10">

                                    <div class="col-md-6">
                                        <div class="panel b-all border-radius">
                                            <div class="panel-heading b-b">Client Detail</div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <?php if(!is_null($project->client)): ?>
                                                        <div class="row m-t-20">
                                                            <div class="col-xs-12">
                                                                <label class="font-bold"><?php echo app('translator')->get('modules.client.clientDetails'); ?></label>
                                                            </div>
                                                            <?php if(!is_null($project->client->client_details)): ?>
                                                                <div class="col-xs-6 m-b-10">
                                                                    <label class="font-semi-bold"><?php echo app('translator')->get('modules.client.companyName'); ?></label><br>
                                                                    <?php echo e($project->client->client_details->company_name); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="col-xs-6 m-b-10">
                                                                <label class="font-semi-bold"><?php echo app('translator')->get('modules.client.clientName'); ?></label><br>
                                                                <?php echo e(ucwords($project->client->name)); ?>

                                                            </div>
                                                            <div class="col-xs-6 m-b-10">
                                                                <label class="font-semi-bold"><?php echo app('translator')->get('modules.client.clientEmail'); ?></label><br>
                                                                <?php echo e($project->client->email); ?>

                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="row m-t-20">
                                                            Clinet Not Seleted
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel b-all border-radius">
                                            <div class="panel-heading b-b">Property Detail</div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Type</label><br>
                                                            <p>
                                                                Type Value
                                                            </p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">City </label><br>
                                                            <p>
                                                                City Value
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Contact Person</label><br>
                                                            <p>
                                                                Contact Person Value
                                                            </p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold">Contact No. </label><br>
                                                            <p>
                                                                Contact No. Value
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row m-t-10">

                                    <?php if(in_array('tasks',$modules)): ?>
                                        <div class="col-md-6">
                                            <div class="panel b-all border-radius">
                                                <div class="panel-heading b-b"><?php echo app('translator')->get('app.menu.tasks'); ?></div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <?php if(!empty($taskStatus)): ?>
                                                            <canvas id="chart3" height="150"></canvas>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <div class="col-md-6">
                                        <div class="panel b-all border-radius" id="milestones">
                                            <div class="panel-heading b-b"><?php echo app('translator')->get('modules.projects.milestones'); ?></div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <?php $__empty_1 = true; $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <div class="row m-b-10">
                                                            <div class="col-xs-12 m-b-5">
                                                                <a href="javascript:;" class="milestone-detail"
                                                                   data-milestone-id="<?php echo e($item->id); ?>">
                                                                    <h6><?php echo e(ucfirst($item->milestone_title )); ?></h6>
                                                                </a>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <?php if($item->status == 'complete'): ?>
                                                                    <label class="label label-success"><?php echo app('translator')->get('app.complete'); ?></label>
                                                                <?php else: ?>
                                                                    <label class="label label-danger"><?php echo app('translator')->get('app.incomplete'); ?></label>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php if($item->cost > 0): ?>
                                                                    <?php echo e($item->currency->currency_symbol.$item->cost); ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-xs-12" id="project-timeline">
                                        <div class="panel b-all border-radius">
                                            <div class="panel-heading b-b">Valuation Dates</div>

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold"><?php echo app('translator')->get('app.startDate'); ?></label><br>
                                                            <p>
                                                                <?php echo e($project->start_date->format($global->date_format)); ?>

                                                            </p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="font-semi-bold"><?php echo app('translator')->get('app.endDate'); ?></label><br>
                                                            <p>
                                                                <?php echo e((!is_null($project->deadline) ? $project->deadline->format($global->date_format) : '-')); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12" id="project-timeline">
                                        <div class="panel b-all border-radius">
                                            <div class="panel-heading b-b"><?php echo app('translator')->get('modules.projects.activityTimeline'); ?></div>

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="steamline">
                                                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="sl-item">
                                                                <div class="sl-left"><i
                                                                            class="fa fa-circle text-primary"></i>
                                                                </div>
                                                                <div class="sl-right">
                                                                    <div>
                                                                        <h6><?php echo e($activ->activity); ?></h6> <span
                                                                                class="sl-date"><?php echo e($activ->created_at->diffForHumans()); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12" id="project-timeline">
                                        <div class="panel b-all border-radius">
                                            <div class="panel-heading b-b"><?php echo app('translator')->get('app.menu.timeLogs'); ?></div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <?php if($timechartData != '[]'): ?>
                                                        <div id="morris-bar-timelogbarChart" style="height: 191px;"></div>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-md-9">
                                <div class="panel ">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body b-all border-radius">
                                            <div class="row">
                                                <div class="col-xs-12" style="max-height: 100px; overflow-y: hidden;">
                                                    <label class="font-semi-bold"><?php echo app('translator')->get('app.project'); ?> <?php echo app('translator')->get('app.note'); ?></label><br>


                                                    <?php if($project->notes): ?>
                                                        <?php echo $project->notes; ?>

                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                                    <?php endif; ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-md-4">
                                    <div class="panel b-all border-radius">
                                        <div class="panel-heading b-b"><?php echo e(ucfirst($field->label)); ?></div>
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <?php if( $field->type == 'text'): ?>
                                                    <?php echo e($project->custom_fields_data['field_'.$field->id] ?? '-'); ?>

                                                <?php elseif($field->type == 'password'): ?>
                                                    <?php echo e($project->custom_fields_data['field_'.$field->id] ?? '-'); ?>

                                                <?php elseif($field->type == 'number'): ?>
                                                    <?php echo e($project->custom_fields_data['field_'.$field->id] ?? '-'); ?>


                                                <?php elseif($field->type == 'textarea'): ?>
                                                    <?php echo e($project->custom_fields_data['field_'.$field->id] ?? '-'); ?>


                                                <?php elseif($field->type == 'radio'): ?>
                                                    <?php echo e(!is_null($project->custom_fields_data['field_'.$field->id]) ? $project->custom_fields_data['field_'.$field->id] : '-'); ?>

                                                <?php elseif($field->type == 'select'): ?>
                                                    <?php echo e((!is_null($project->custom_fields_data['field_'.$field->id]) && $project->custom_fields_data['field_'.$field->id] != '') ? $field->values[$project->custom_fields_data['field_'.$field->id]] : '-'); ?>

                                                <?php elseif($field->type == 'checkbox'): ?>
                                                    <?php echo e(!is_null($project->custom_fields_data['field_'.$field->id]) ? $field->values[$project->custom_fields_data['field_'.$field->id]] : '-'); ?>

                                                <?php elseif($field->type == 'date'): ?>
                                                    <?php echo e(!is_null($project->custom_fields_data['field_'.$field->id]) ? \Carbon\Carbon::parse($project->custom_fields_data['field_'.$field->id])->format($global->date_format) : '--'); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                        </div>

                    </div>
                    <!-- /content -->
                </div>
                <!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

    
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    

    
    <div class="modal fade bs-modal-lg in" id="project-summary-modal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="icon-layers"></i> <?php echo app('translator')->get('modules.projects.projectSummary'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $project->project_summary; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/Chart.js/Chart.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

    <script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script type="text/javascript">

        $("body").tooltip({
            selector: '[data-toggle="tooltip"]', trigger: "hover"
        });
        $(document).ready(function () {
            $('[rel=tooltip]').tooltip({trigger: "hover"});
        });

        function pieChart(taskStatus) {
            var ctx3 = document.getElementById("chart3").getContext("2d");
            var data3 = new Array();
            $.each(taskStatus, function (key, val) {
                // console.log("key : "+key+" ; value : "+val);
                data3.push(
                    {
                        value: parseInt(val.count),
                        color: val.color,
                        highlight: "#57ecc8",
                        label: val.label
                    }
                );
            });
            $('body').on('click', '#pinnedItem', function () {
                var type = $('#pinnedItem').attr('data-pinned');
                var id = <?php echo e($project->id); ?>;
                console.log(['type', type]);
                var dataPin = type.trim(type);
                if (dataPin == 'pinned') {
                    swal({
                        title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                        text: "<?php echo app('translator')->get('messages.confirmation.pinnedProject'); ?>",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "<?php echo app('translator')->get('messages.unpinIt'); ?>",
                        cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {

                            var url = "<?php echo e(route('admin.pinned.destroy',':id')); ?>";
                            url = url.replace(':id', id);

                            var token = "<?php echo e(csrf_token()); ?>";
                            var txt = "<?php echo e(__('app.pin')); ?>";
                            $.easyAjax({
                                type: 'POST',
                                url: url,
                                data: {'_token': token, '_method': 'DELETE'},
                                success: function (response) {
                                    if (response.status == "success") {
//                                    $.unblockUI();
                                        $('.pin-icon').removeClass('pinned');
                                        $('.pin-icon').addClass('unpinned');
                                        $('#pinnedText').html(txt);
                                        $('#pinnedItem').attr('data-pinned', 'unpinned');
                                        $('#pinnedItem').attr('data-original-title', 'Pin');
                                        $("#pinnedItem").tooltip("hide");

                                    }
                                }
                            });
                        }
                    });
                } else {

                    swal({
                        title: "Are you sure?",
                        text: "You want to pin this project!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, pin it!",
                        cancelButtonText: "No, cancel please!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {

                            var url = "<?php echo e(route('admin.pinned.store')); ?>";

                            var token = "<?php echo e(csrf_token()); ?>";
                            var txt = "<?php echo e(__('app.removePinned')); ?>";
                            $.easyAjax({
                                type: 'POST',
                                url: url,
                                data: {'_token': token, 'project_id': id},
                                success: function (response) {
                                    if (response.status == "success") {
                                        $.unblockUI();
                                        $('.pin-icon').removeClass('unpinned');
                                        $('.pin-icon').addClass('pinned');
                                        $('#pinnedText').html(txt);
                                        $('#pinnedItem').attr('data-pinned', 'pinned');
                                        $('#pinnedItem').attr('data-original-title', 'Unpin');
                                        $("#pinnedItem").tooltip("hide");
                                    }
                                }
                            });
                        }
                    });

                }
            });
            // console.log(data3);

            var myPieChart = new Chart(ctx3).Pie(data3, {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 0,
                animationSteps: 100,
                tooltipCornerRadius: 0,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
        }

        <?php if(!empty($taskStatus)): ?>
        pieChart(jQuery.parseJSON('<?php echo $taskStatus; ?>'));
                <?php endif; ?>

        var chartData = <?php echo $chartData; ?>;

        function barChart() {

            Morris.Bar({
                element: 'morris-bar-chart',
                data: chartData,
                xkey: 'date',
                ykeys: ['total'],
                labels: ['Earning'],
                barColors: ['#00c292'],
                hideHover: 'auto',
                gridLineColor: '#eef0f2',
                resize: true
            });

        }

        <?php if($chartData != '[]'): ?>
        barChart();
                <?php endif; ?>

        var chartData = <?php echo $timechartData; ?>;

        function timelogbarChart() {

            Morris.Bar({
                element: 'morris-bar-timelogbarChart',
                data: chartData,
                xkey: 'date',
                ykeys: ['total_hours'],
                labels: ['Hours Logged'],
                barColors: ['#3594fa'],
                hideHover: 'auto',
                gridLineColor: '#ccccccc',
                resize: true
            });

        }

        <?php if($timechartData != '[]'): ?>
        timelogbarChart();
        <?php endif; ?>
    </script>

    <script type="text/javascript">

        $('#timer-list').on('click', '.stop-timer', function () {
            var id = $(this).data('time-id');
            var url = '<?php echo e(route('admin.time-logs.stopTimer', ':id')); ?>';
            url = url.replace(':id', id);
            var token = '<?php echo e(csrf_token()); ?>'
            $.easyAjax({
                url: url,
                type: "POST",
                data: {timeId: id, _token: token},
                success: function (data) {
                    $('#timer-list').html(data.html);
                }
            })

        });

        $('.milestone-detail').click(function () {
            var id = $(this).data('milestone-id');
            var url = '<?php echo e(route('admin.milestones.detail', ":id")); ?>';
            url = url.replace(':id', id);
            $('#modelHeading').html('<?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('modules.projects.milestones'); ?>');
            $.ajaxModal('#projectCategoryModal', url);
        })

        $('.submit-ticket').click(function () {

            const status = $(this).data('status');
            const url = '<?php echo e(route('admin.projects.updateStatus', $project->id)); ?>';
            const token = '<?php echo e(csrf_token()); ?>'

            $.easyAjax({
                url: url,
                type: "POST",
                data: {status: status, _token: token},
                success: function (data) {
                    window.location.reload();
                }
            })
        });
        $('ul.showProjectTabs .projects').addClass('tab-current');
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/show.blade.php ENDPATH**/ ?>