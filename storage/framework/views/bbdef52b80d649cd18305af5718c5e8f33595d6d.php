<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.projects.index')); ?>"><?php echo e(__($pageTitle)); ?></a></li>
                <li class="active"><?php echo app('translator')->get('app.edit'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.css')); ?>">
<link rel="stylesheet"
      href="<?php echo e(asset('plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.skinModern.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<style>
    .panel-black .panel-heading a, .panel-inverse .panel-heading a {
        color: unset!important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> <?php echo app('translator')->get('modules.projects.updateTitle'); ?></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php echo Form::open(['id'=>'updateProject','class'=>'ajax-form','method'=>'PUT']); ?>

                        <div class="form-body ">
                            <h3 class="box-title m-b-10"><?php echo app('translator')->get('modules.projects.projectInfo'); ?></h3>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('modules.projects.projectName'); ?></label>
                                        <input type="text" name="project_name" id="project_name" class="form-control"
                                               value="<?php echo e($project->project_name); ?>">
                                    </div>
                                </div>
                      
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.projectCategory'); ?> <a
                                            href="javascript:;" id="addProjectCategory"><i class="ti-settings text-info"></i></a>
                                        </label>
                                        <select class="select2 form-control" name="category_id" id="category_id"
                                                data-style="form-control">
                                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($category->id); ?>"
                                                        <?php if($project->category_id == $category->id): ?>
                                                        selected
                                                        <?php endif; ?>
                                                ><?php echo e(ucwords($category->category_name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value=""><?php echo app('translator')->get('messages.noProjectCategoryAdded'); ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label">Select Approaches</label>
                                        <select class="selectpicker form-control" name="approaches" id="approaches"
                                                data-style="form-control">

                                            <?php $__empty_1 = true; $__currentLoopData = $approaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((isset($approaches_value) && ($key==$approaches_value))?'selected':''); ?>> <?php echo e(ucwords($value)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value=""><a href="javascript:void(0)"
                                                                    role="menuitem"><?php echo app('translator')->get('messages.noRecordFound'); ?></a>
                                                </option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Methods</label>
                                        <select class="selectpicker form-control" name="methods" id="methods"
                                                data-style="form-control">
                                            <?php $__empty_1 = true; $__currentLoopData = $selectMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((isset($methods_value) && ($key==$methods_value))?'selected':''); ?><?php if($key==$methods_value): ?>'selected':'' <?php endif; ?>> <?php echo e(ucwords($value)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value=""><a href="javascript:void(0)"
                                                                    role="menuitem"><?php echo app('translator')->get('messages.noRecordFound'); ?></a>
                                                </option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('modules.projects.startDate'); ?></label>
                                        <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control"
                                               value="<?php echo e($project->start_date->format($global->date_format)); ?>">
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4" id="deadlineBox">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('modules.projects.deadline'); ?></label>
                                        <input type="text" name="deadline" id="deadline" autocomplete="off" class="form-control"
                                               value="<?php if($project->deadline): ?><?php echo e($project->deadline->format($global->date_format)); ?><?php else: ?> <?php echo e(\Carbon\Carbon::now()->format($global->date_format)); ?> <?php endif; ?>">
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4">
                                    <div class="form-group" style="padding-top: 25px;">
                                        <div class="checkbox checkbox-info">
                                            <input id="without_deadline" <?php if($project->deadline == null): ?> checked <?php endif; ?> name="without_deadline" value="true"
                                                   type="checkbox">
                                            <label for="without_deadline"><?php echo app('translator')->get('modules.projects.withoutDeadline'); ?></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info">
                                            <input id="manual_timelog" name="manual_timelog" value="true"
                                                <?php if($project->manual_timelog == "enable"): ?> checked <?php endif; ?>
                                                type="checkbox">
                                            <label for="manual_timelog"><?php echo app('translator')->get('modules.projects.manualTimelog'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.projectSummary'); ?></label>
                                        <textarea name="project_summary" id="project_summary"
                                                  class="summernote"><?php echo e($project->project_summary); ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/span-->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.note'); ?></label>
                                        <textarea name="notes" id="notes" rows="3"
                                                  class="form-control summernote"><?php echo e($project->notes); ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.projectCompletionStatus'); ?></label>

                                        <div id="range_01"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group last">
                                        <div class="checkbox checkbox-info">
                                            <input id="calculate-task-progress" name="calculate_task_progress" value="true"
                                                   <?php if($project->calculate_task_progress == "true"): ?> checked <?php endif; ?>
                                                   type="checkbox">
                                            <label for="calculate-task-progress"><?php echo app('translator')->get('modules.projects.calculateTasksProgress'); ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <input type="hidden" name="completion_percent" id="completion_percent"
                                   value="<?php echo e($project->completion_percent); ?>">


                            <h3 class="box-title m-b-10">Contact person</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 ">
                                    <div class="form-group">
                                        <label class="required">Contact name</label>
                                        <input type="text" name="contact_name" id="contact_name" value=" <?php echo e(isset($contact_name)?$contact_name: ''); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 ">
                                    <div class="form-group">
                                        <label class="required">Contact Phone</label>
                                        <input type="tel" name="contact_phone" id="contact_phone" value=" <?php echo e(isset($contact_phone)?$contact_phone: ''); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h3 class="box-title m-b-10"><?php echo app('translator')->get('modules.projects.clientInfo'); ?></h3>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <select class="select2 form-control" name="client_id" id="client_id"
                                                data-style="form-control">
                                            <option value="null">--</option>
                                            <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($client->id); ?>"
                                                        <?php if($project->client_id == $client->id): ?>
                                                        selected
                                                        <?php endif; ?>
                                                ><?php echo e(ucwords($client->name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value=""><?php echo app('translator')->get('modules.projects.selectClient'); ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info">
                                            <input id="client_view_task" name="client_view_task" value="true" onchange="checkTask()"
                                                   <?php if($project->client_view_task == "enable"): ?> checked <?php endif; ?>
                                                   type="checkbox">
                                            <label for="client_view_task"><?php echo app('translator')->get('modules.projects.clientViewTask'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4" id="clientNotification">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info  col-md-10">
                                            <input id="client_task_notification" name="client_task_notification" value="true"  <?php if($project->allow_client_notification == "enable"): ?> checked <?php endif; ?>
                                                   type="checkbox">
                                            <label for="client_task_notification"><?php echo app('translator')->get('modules.projects.clientTaskNotification'); ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.clientFeedback'); ?></label>
                                        <textarea name="feedback" id="feedback" rows="5"
                                                  class="form-control"><?php echo e($project->feedback); ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/span-->

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required">Select Property <a
                                                    href="javascript:;" id="addProperty"  class="btn btn-xs btn-success btn-outline"><i
                                                        class="fa fa-plus"></i></a>
                                        </label>
                                        <select name="projectPropertyId"
                                                id="projectPropertyId"
                                                class="form-control projectPropertyId select2"
                                                required>
                                            <option value="">--</option>
                                            <?php if(isset($properties)): ?>
                                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                            <?php if($project->property_id == $property->id): ?>
                                                            selected
                                                            <?php endif; ?>
                                                            value="<?php echo e(isset($property->id)?$property->id:''); ?>">
                                                        <?php echo e(isset($property->title)?$property->title: ''); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.invoices.currency'); ?></label>
                                        <select name="currency_id" id="" class="form-control select2">
                                            <option value="">--</option>
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                <?php if($item->id == $project->currency_id): ?> selected <?php endif; ?>
                                                value="<?php echo e($item->id); ?>"><?php echo e($item->currency_name); ?> (<?php echo e($item->currency_code); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                


                            </div>
                            <!--/span-->

                        
                            <div class="row">
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="form-group">
                                        <label class="">Valuation Date</label>
                                        <input type="datetime-local" value=" <?php echo e(isset($appointment_day)?$appointment_day: ''); ?>" name="appointment_day" id="appointment_day" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('app.project'); ?> <?php echo app('translator')->get('app.status'); ?></label>
                                        <select name="status" id="" class="form-control">
                                            <option
                                                    <?php if($project->status == 'not started'): ?> selected <?php endif; ?>
                                            value="not started"><?php echo app('translator')->get('app.notStarted'); ?>
                                            </option>
                                            <option
                                                    <?php if($project->status == 'in progress'): ?> selected <?php endif; ?>
                                            value="in progress"><?php echo app('translator')->get('app.inProgress'); ?>
                                            </option>
                                            <option
                                                    <?php if($project->status == 'on hold'): ?> selected <?php endif; ?>
                                            value="on hold"><?php echo app('translator')->get('app.onHold'); ?>
                                            </option>
                                            <option
                                                    <?php if($project->status == 'canceled'): ?> selected <?php endif; ?>
                                            value="canceled"><?php echo app('translator')->get('app.canceled'); ?>
                                            </option>
                                            <option
                                                    <?php if($project->status == 'finished'): ?> selected <?php endif; ?>
                                            value="finished"><?php echo app('translator')->get('app.finished'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->

                            <div class="row">
                                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label><?php echo e(ucfirst($field->label)); ?></label>
                                        <div class="form-group">
                                            <?php if( $field->type == 'text'): ?>
                                                <input type="text" name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]" class="form-control" placeholder="<?php echo e($field->label); ?>" value="<?php echo e($project->custom_fields_data['field_'.$field->id] ?? ''); ?>">
                                            <?php elseif($field->type == 'password'): ?>
                                                <input type="password" name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]" class="form-control" placeholder="<?php echo e($field->label); ?>" value="<?php echo e($project->custom_fields_data['field_'.$field->id] ?? ''); ?>">
                                            <?php elseif($field->type == 'number'): ?>
                                                <input type="number" name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]" class="form-control" placeholder="<?php echo e($field->label); ?>" value="<?php echo e($project->custom_fields_data['field_'.$field->id] ?? ''); ?>">

                                            <?php elseif($field->type == 'textarea'): ?>
                                                <textarea name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]" class="form-control" id="<?php echo e($field->name); ?>" cols="3"><?php echo e($project->custom_fields_data['field_'.$field->id] ?? ''); ?></textarea>

                                            <?php elseif($field->type == 'radio'): ?>
                                                <div class="radio-list">
                                                    <?php $__currentLoopData = $field->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="radio-inline <?php if($key == 0): ?> p-0 <?php endif; ?>">
                                                            <div class="radio radio-info">
                                                                <input type="radio" name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]" id="optionsRadios<?php echo e($key.$field->id); ?>" value="<?php echo e($value); ?>" <?php if(isset($project) && $project->custom_fields_data['field_'.$field->id] == $value): ?> checked <?php elseif($key==0): ?> checked <?php endif; ?>>>
                                                                <label for="optionsRadios<?php echo e($key.$field->id); ?>"><?php echo e($value); ?></label>
                                                            </div>
                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php elseif($field->type == 'select'): ?>
                                                <?php echo Form::select('custom_fields_data['.$field->name.'_'.$field->id.']',
                                                        $field->values,
                                                         isset($project)?$project->custom_fields_data['field_'.$field->id]:'',['class' => 'form-control gender']); ?>


                                            <?php elseif($field->type == 'checkbox'): ?>
                                                <div class="mt-checkbox-inline">
                                                    <?php $__currentLoopData = $field->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                            <input name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>][]" type="checkbox" value="<?php echo e($key); ?>"> <?php echo e($value); ?>

                                                            <span></span>
                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php elseif($field->type == 'date'): ?>
                                            <input type="text" class="form-control date-picker" size="16" name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                            value="<?php echo e(($project->custom_fields_data['field_'.$field->id] != '') ? \Carbon\Carbon::parse($project->custom_fields_data['field_'.$field->id])->format($global->date_format) : \Carbon\Carbon::now()->format($global->date_format)); ?>">
                                            <?php endif; ?>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                        </div>
                        <div class="form-actions m-t-15">
                            <button type="submit" id="save-form" class="btn btn-success"><i
                                        class="fa fa-check"></i> <?php echo app('translator')->get('app.update'); ?></button>

                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

    
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
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
        <!-- /.modal-dialog -->
    </div>
    

    
    <div class="modal fade bs-modal-md in" id="addPropertyModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
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
        <!-- /.modal-dialog -->
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js')); ?>"></script>

<script>

    $(".date-picker").datepicker({
        todayHighlight: true,
        autoclose: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>'
    });


    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });
    checkTask();
    function checkTask()
    {
        var chVal = $('#client_view_task').is(":checked") ? true : false;
        if(chVal == true){
            $('#clientNotification').show();
        }
        else{
            $('#clientNotification').hide();
        }

    }
    <?php if($project->deadline == null): ?>
        $('#deadlineBox').hide();
    <?php endif; ?>
    $('#without_deadline').click(function () {
        var check = $('#without_deadline').is(":checked") ? true : false;
        if(check == true){
            $('#deadlineBox').hide();
        }
        else{
            $('#deadlineBox').show();
        }
    });

    $("#deadline").datepicker({
        autoclose: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    });

    $("#start_date").datepicker({
        todayHighlight: true,
        autoclose: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#deadline').datepicker('setStartDate', minDate);
    });



    $('#save-form').click(function () {
        let projectPropertyId = $('#projectPropertyId').val();
        if( projectPropertyId == ''){
            alert('Please Select Property');
            return false;
        }
        $.easyAjax({
            url: '<?php echo e(route('admin.projects.update', [$project->id])); ?>',
            container: '#updateProject',
            type: "POST",
            redirect: true,
            data: $('#updateProject').serialize()
        })
    });

    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ["view", ["fullscreen"]]
        ]
    });

    var completion = $('#completion_percent').val();

    $("#range_01").ionRangeSlider({
        grid: true,
        min: 0,
        max: 100,
        from: parseInt(completion),
        postfix: "%",
        onFinish: saveRangeData
    });

    var slider = $("#range_01").data("ionRangeSlider");

    $('#calculate-task-progress').change(function () {
        if($(this).is(':checked')){
            slider.update({"disable": true});
        }
        else{
            slider.update({"disable": false});
        }
    })

    function saveRangeData(data) {
        var percent = data.from;
        $('#completion_percent').val(percent);
    }

    $(':reset').on('click', function(evt) {
        evt.preventDefault()
        $form = $(evt.target).closest('form')
        $form[0].reset()
        $form.find('select').select2()
    });

    <?php if($project->calculate_task_progress == "true"): ?>
        slider.update({"disable": true});
    <?php endif; ?>
</script>

<script>
    $('#updateProject').on('click', '#addProjectCategory', function () {
        var url = '<?php echo e(route('admin.projectCategory.create-cat')); ?>';
        $('#modelHeading').html('Manage Project Category');
        $.ajaxModal('#projectCategoryModal', url);
    })
    $('#updateProject').on('click', '#addProperty', function () {
        var url = '<?php echo e(route('valuation.admin.property.createPropertyModalView')); ?>';
        $('#modelHeading').html('Add New Property');
        $.ajaxModal('#addPropertyModal', url);
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/edit.blade.php ENDPATH**/ ?>