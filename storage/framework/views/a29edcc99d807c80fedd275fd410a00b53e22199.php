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
                <li class="active"><?php echo app('translator')->get('app.addNew'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.css')); ?>">

    <style>
        .panel-black .panel-heading a, .panel-inverse .panel-heading a {
            color: unset !important;
        }

        .bootstrap-select.btn-group .dropdown-menu li a span.text {
            color: #000;
        }

        .panel-black .panel-heading a:hover, .panel-inverse .panel-heading a:hover {
            color: #000 !important;
        }

        .panel-black .panel-heading a, .panel-inverse .panel-heading a {
            color: #000 !important;
        }

        .btn-info.active, .btn-info:active, .open > .dropdown-toggle.btn-info {
            background-color: unset !important;;
            border-color: #269abc;
        }

        .note-editor {
            border: 1px solid #e4e7ea !important;
        }

        .btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover, .btn-info.focus, .btn-info.focus:active, .btn-info:active:focus, .btn-info:active:hover, .btn-info:focus, .open > .dropdown-toggle.btn-info.focus, .open > .dropdown-toggle.btn-info:focus, .open > .dropdown-toggle.btn-info:hover {
            background-color: #03a9f3;
            border: 1px solid #03a9f3;
            color: #000;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> <?php echo app('translator')->get('modules.projects.createTitle'); ?>
                    
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php echo Form::open(['id'=>'createProject','class'=>'ajax-form','method'=>'POST']); ?>

                        <div class="form-body">
                            <h3 class="box-title m-b-10"><?php echo app('translator')->get('modules.projects.projectInfo'); ?></h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="form-group">
                                        <label class="required"><?php echo app('translator')->get('modules.projects.projectName'); ?></label>
                                        <input type="text" name="project_name" id="project_name" class="form-control">
                                        <input type="hidden" name="template_id" id="template_id">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('app.menu.template'); ?></label>
                                        <select class="selectpicker form-control" name="template_id" id="template_id"
                                                data-style="form-control" onchange="setTemplate(this.value)">
                                            <option value=""></option>
                                            <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($template->id); ?>"> <?php echo e(ucwords($template->project_name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value=""><a href="javascript:void(0)"
                                                                    role="menuitem"><?php echo app('translator')->get('messages.noRecordFound'); ?></a>
                                                </option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.projectCategory'); ?> <a
                                                    href="javascript:;" id="addProjectCategory" class="text-info"><i
                                                        class="ti-settings text-info"></i></a>
                                        </label>
                                        <select class="selectpicker form-control" name="category_id" id="category_id"
                                                data-style="form-control">
                                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->category_name)); ?></option>
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
                                                <option value="<?php echo e($key); ?>"> <?php echo e(ucwords($value)); ?></option>
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
                                                <option value="<?php echo e($key); ?>"> <?php echo e(ucwords($value)); ?></option>
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
                                        <label class="required"><?php echo app('translator')->get('modules.projects.startDate'); ?></label>
                                        <input type="text" name="start_date" id="start_date" autocomplete="off"
                                               class="form-control">
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4" id="deadlineBox">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('modules.projects.deadline'); ?></label>
                                        <input type="text" name="deadline" id="deadline" autocomplete="off"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding-top: 25px;">
                                        <div class="checkbox checkbox-info">
                                            <input id="without_deadline" name="without_deadline" value="true"
                                                   type="checkbox">
                                            <label for="without_deadline"><?php echo app('translator')->get('modules.projects.withoutDeadline'); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-xs-6">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info ">
                                            <input id="manual_timelog" name="manual_timelog" value="true"
                                                   type="checkbox">
                                            <label for="manual_timelog"><?php echo app('translator')->get('modules.projects.manualTimelog'); ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group" id="user_id">
                                        <label class="required"><?php echo app('translator')->get('modules.projects.addMemberTitle'); ?></label>
                                        <a href="javascript:;" id="add-employee"
                                           class="btn btn-xs btn-success btn-outline"><i class="fa fa-plus"></i></a>
                                        <select class="select2 m-b-10 select2-multiple " id="selectEmployee"
                                                multiple="multiple"
                                                data-placeholder="Choose Members" name="user_id[]">
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->id); ?>"><?php echo e(ucwords($emp->name)); ?> <?php if($emp->id == $user->id): ?>
                                                        (YOU) <?php endif; ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.projectSummary'); ?></label>
                                        <textarea name="project_summary" id="project_summary"
                                                  class="summernote"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/span-->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.projects.note'); ?></label>
                                        <textarea name="notes" id="notes" rows="3"
                                                  class="form-control summernote"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/span-->
                            <h3 class="box-title m-b-10">Contact person</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 ">
                                    <div class="form-group">
                                        <label class="required">Contact name</label>
                                        <input type="text" name="contact_name" id="contact_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 ">
                                    <div class="form-group">
                                        <label class="required">Contact Phone</label>
                                        <input type="tel" name="contact_phone" id="contact_phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h3 class="box-title m-b-10"><?php echo app('translator')->get('modules.projects.clientInfo'); ?></h3>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label><?php echo app('translator')->get('modules.projects.selectClient'); ?></label>
                                    <a href="javascript:;" id="add-client" class="btn btn-xs btn-success btn-outline"><i
                                                class="fa fa-plus"></i></a>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <select class="select2 form-control" name="client_id" id="client_id"
                                                data-style="form-control">
                                            <option value=""><?php echo app('translator')->get('modules.projects.selectClient'); ?></option>
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info  col-md-10">
                                            <input id="client_view_task" onchange="checkTask()" name="client_view_task"
                                                   value="true"
                                                   type="checkbox">
                                            <label for="client_view_task"><?php echo app('translator')->get('modules.projects.clientViewTask'); ?></label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4" id="clientNotification">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info  col-md-10">
                                            <input id="client_task_notification" name="client_task_notification"
                                                   value="true"
                                                   type="checkbox">
                                            <label for="client_task_notification"><?php echo app('translator')->get('modules.projects.clientTaskNotification'); ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            
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
                                                    <option value="<?php echo e(isset($property->id)?$property->id:''); ?>">
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
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                        <?php if(company_setting()->currency_id == $item->id): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->currency_name); ?>

                                                    (<?php echo e($item->currency_code); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                


                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="form-group">
                                        <label class="">Valuation Date</label>
                                        <input type="datetime-local" name="appointment_day" id="appointment_day" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('app.project'); ?> <?php echo app('translator')->get('app.status'); ?></label>
                                        <select name="status" id="" class="form-control">
                                            <option
                                                    value="not started"><?php echo app('translator')->get('app.notStarted'); ?>
                                            </option>
                                            <option
                                                    value="in progress"><?php echo app('translator')->get('app.inProgress'); ?>
                                            </option>
                                            <option
                                                    value="on hold"><?php echo app('translator')->get('app.onHold'); ?>
                                            </option>
                                            <option
                                                    value="canceled"><?php echo app('translator')->get('app.canceled'); ?>
                                            </option>
                                            <option
                                                    value="finished"><?php echo app('translator')->get('app.finished'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-b-20">
                                <div class="col-xs-12">
                                    <?php if($upload): ?>
                                        <button type="button"
                                                class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                                style="margin-bottom: 10px;display: none "><i class="fa fa-upload"></i>
                                            File Select Or Upload
                                        </button>
                                        <div id="file-upload-box">
                                            <div class="row" id="file-dropzone">
                                                <div class="col-xs-12">
                                                    <div class="dropzone"
                                                         id="file-upload-dropzone">
                                                        <?php echo e(csrf_field()); ?>

                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple/>
                                                        </div>
                                                        <input name="image_url" id="image_url" type="hidden"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="taskIDField" id="taskIDField">
                                    <?php else: ?>
                                        <div class="alert alert-danger"><?php echo app('translator')->get('messages.storageLimitExceed', ['here' => '<a href='.route('admin.billing.packages'). '>Here</a>']); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--/span-->

                            <div class="row">
                                <?php if(isset($fields)): ?>
                                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label <?php if($field->required == 'yes'): ?> class="required" <?php endif; ?>><?php echo e(ucfirst($field->label)); ?></label>
                                                <?php if( $field->type == 'text'): ?>
                                                    <input type="text"
                                                           name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                           class="form-control" placeholder="<?php echo e($field->label); ?>"
                                                           value="<?php echo e($editUser->custom_fields_data['field_'.$field->id] ?? ''); ?>">
                                                <?php elseif($field->type == 'password'): ?>
                                                    <input type="password"
                                                           name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                           class="form-control" placeholder="<?php echo e($field->label); ?>"
                                                           value="<?php echo e($editUser->custom_fields_data['field_'.$field->id] ?? ''); ?>">
                                                <?php elseif($field->type == 'number'): ?>
                                                    <input type="number"
                                                           name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                           class="form-control" placeholder="<?php echo e($field->label); ?>"
                                                           value="<?php echo e($editUser->custom_fields_data['field_'.$field->id] ?? ''); ?>">

                                                <?php elseif($field->type == 'textarea'): ?>
                                                    <textarea name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                              class="form-control" id="<?php echo e($field->name); ?>"
                                                              cols="3"><?php echo e($editUser->custom_fields_data['field_'.$field->id] ?? ''); ?></textarea>

                                                <?php elseif($field->type == 'radio'): ?>
                                                    <div class="radio-list">
                                                        <?php $__currentLoopData = $field->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <label class="radio-inline <?php if($key == 0): ?> p-0 <?php endif; ?>">
                                                                <div class="radio radio-info">
                                                                    <input type="radio"
                                                                           name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                                           id="optionsRadios<?php echo e($key.$field->id); ?>"
                                                                           value="<?php echo e($value); ?>"
                                                                           <?php if(isset($editUser) && $editUser->custom_fields_data['field_'.$field->id] == $value): ?> checked
                                                                           <?php elseif($key==0): ?> checked <?php endif; ?>>>
                                                                    <label for="optionsRadios<?php echo e($key.$field->id); ?>"><?php echo e($value); ?></label>
                                                                </div>
                                                            </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php elseif($field->type == 'select'): ?>
                                                    <?php echo Form::select('custom_fields_data['.$field->name.'_'.$field->id.']',
                                                            $field->values,
                                                             isset($editUser)?$editUser->custom_fields_data['field_'.$field->id]:'',['class' => 'form-control gender']); ?>


                                                <?php elseif($field->type == 'checkbox'): ?>
                                                    <div class="mt-checkbox-inline">
                                                        <?php $__currentLoopData = $field->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <label class="mt-checkbox mt-checkbox-outline">
                                                                <input name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>][]"
                                                                       type="checkbox" value="<?php echo e($key); ?>"> <?php echo e($value); ?>

                                                                <span></span>
                                                            </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php elseif($field->type == 'date'): ?>
                                                    <input type="text" class="form-control date-picker" size="16"
                                                           name="custom_fields_data[<?php echo e($field->name.'_'.$field->id); ?>]"
                                                           value="<?php echo e(isset($editUser->dob)?Carbon\Carbon::parse($editUser->dob)->format('Y-m-d'):Carbon\Carbon::now()->format($global->date_format)); ?>">
                                                <?php endif; ?>
                                                <div class="form-control-focus"></div>
                                                <span class="help-block"></span>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>

                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"><i class="fa fa-check"></i>
                                <?php echo app('translator')->get('app.save'); ?>
                            </button>

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
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.js')); ?>"></script>

    <script>

        $(".date-picker").datepicker({
            todayHighlight: true,
            autoclose: true,
            weekStart: '<?php echo e($global->week_start); ?>',
            format: '<?php echo e($global->date_picker_format); ?>'
        });

        projectID = '';
        Dropzone.autoDiscover = false;
        //Dropzone class
        myDropzone = new Dropzone("div#file-upload-dropzone", {
            url: "<?php echo e(route('admin.files.multiple-upload')); ?>",
            headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
            paramName: "file",
            maxFilesize: 10,
            maxFiles: 10,
            acceptedFiles: "image/*,application/pdf",
            autoProcessQueue: false,
            uploadMultiple: true,
            addRemoveLinks: true,
            parallelUploads: 10,
            init: function () {
                myDropzone = this;
            }
        });
        myDropzone.on('sending', function (file, xhr, formData) {
            console.log([formData, 'formData']);
            var ids = $('#projectID').val();
            formData.append('project_id', ids);
        });
        myDropzone.on('completemultiple', function () {
            var msgs = "<?php echo app('translator')->get('modules.projects.projectUpdated'); ?>";
            $.showToastr(msgs, 'success');
            window.location.href = '<?php echo e(route('admin.projects.index')); ?>'
        });
        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });
        $('#clientNotification').hide();
        $("#start_date").datepicker({
            todayHighlight: true,
            autoclose: true,
            weekStart: '<?php echo e($global->week_start); ?>',
            format: '<?php echo e($global->date_picker_format); ?>',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#deadline').datepicker('setStartDate', minDate);
        });

        // check client view task checked
        function checkTask() {
            var chVal = $('#client_view_task').is(":checked") ? true : false;
            if (chVal == true) {
                $('#clientNotification').show();
            } else {
                $('#clientNotification').hide();
            }
        }

        $('#without_deadline').click(function () {
            var check = $('#without_deadline').is(":checked") ? true : false;
            if (check == true) {
                $('#deadlineBox').hide();
            } else {
                $('#deadlineBox').show();
            }
        });

        // Set selected Template
        function setTemplate(id) {
            var url = "<?php echo e(route('admin.projects.template-data',':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                url: url,
                container: '#createProject',
                type: "GET",
                success: function (response) {
                    var selectedTemplate = [];
                    if (id != null && id != undefined && id != "") {
                        selectedTemplate = response.templateData;

                        if (response.member) {
                            $('#selectEmployee').val(response.member);
                            $('#selectEmployee').trigger('change');
                        }

                        $('#project_name').val(selectedTemplate['project_name']);
                        $('#category_id').selectpicker('val', selectedTemplate['category_id']);
                        $('#project_summary').summernote('code', selectedTemplate['project_summary']);
                        $('#notes').summernote('code', selectedTemplate['notes']);
                        $('#template_id').val(selectedTemplate['id']);

                        if (selectedTemplate['client_view_task'] == 'enable') {
                            $("#client_view_task").prop('checked', true);
                            $('#clientNotification').show();
                            if (selectedTemplate['allow_client_notification'] == 'enable') {
                                $("#client_task_notification").prop('checked', 'checked');
                            } else {
                                $("#client_task_notification").prop('checked', false);
                            }
                        } else {
                            $("#client_view_task").prop('checked', false);
                            $("#client_task_notification").prop('checked', false);
                            $('#clientNotification').hide();
                        }
                        if (selectedTemplate['manual_timelog'] == 'enable') {
                            $("#manual_timelog").prop('checked', true);
                        } else {
                            $("#manual_timelog").prop('checked', false);
                        }
                    }
                }
            })

        }


        $("#deadline").datepicker({
            autoclose: true,
            weekStart: '<?php echo e($global->week_start); ?>',
            format: '<?php echo e($global->date_picker_format); ?>',
        });

        $('#save-form').click(function () {
            let projectPropertyId = $('#projectPropertyId').val();
            let template_id = $('#template_id').val();
            if (template_id == '') {
                alert('Please Select Template');
                return false;
            }
            if (projectPropertyId == '') {
                alert('Please Select Property');
                return false;
            }

            $.easyAjax({
                url: '<?php echo e(route('admin.projects.store')); ?>',
                container: '#createProject',
                type: "POST",
                redirect: true,
                data: $('#createProject').serialize(),
                success: function (response) {
                    var dropzone = 0;
                    <?php if($upload): ?>
                        dropzone = myDropzone.getQueuedFiles().length;
                    <?php endif; ?>

                    if (dropzone > 0) {
                        projectID = response.projectID;
                        $('#projectID').val(response.projectID);
                        myDropzone.processQueue();
                    } else {
                        var msgs = "<?php echo app('translator')->get('modules.projects.projectUpdated'); ?>";
                        $.showToastr(msgs, 'success');
                        window.location.href = '<?php echo e(route('admin.projects.index')); ?>'
                    }
                }
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

        $(':reset').on('click', function (evt) {
            evt.preventDefault()
            $form = $(evt.target).closest('form')
            $form[0].reset()
            $form.find('select').selectpicker('render')
        });
    </script>

    <script>
        $('#createProject').on('click', '#addProjectCategory', function () {
            var url = '<?php echo e(route('admin.projectCategory.create-cat')); ?>';
            $('#modelHeading').html('Manage Project Category');
            $.ajaxModal('#projectCategoryModal', url);
        })

        $('#createProject').on('click', '#addProperty', function () {
            var url = '<?php echo e(route('valuation.admin.property.createPropertyModalView')); ?>';
            $('#modelHeading').html('Add New Property');
            $.ajaxModal('#addPropertyModal', url);
        })

        $('#add-employee').click(function () {
            var url = '<?php echo e(route('admin.employees.create')); ?>';
            $('#modelHeading').html("<?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.employee'); ?>");
            $.ajaxModal('#projectTimerModal', url);
        });

        $('#add-client').click(function () {
            var url = '<?php echo e(route('admin.clients.create')); ?>';
            $('#modelHeading').html("<?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.client'); ?>");
            $.ajaxModal('#projectTimerModal', url);
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/create.blade.php ENDPATH**/ ?>