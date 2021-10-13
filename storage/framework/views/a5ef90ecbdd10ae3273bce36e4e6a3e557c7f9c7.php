<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
        <a href="javascript:;" id="toggle-filter" class="btn btn-sm btn-inverse btn-outline toggle-filter"><i class="fa fa-sliders"></i></a>
            <a href="#" data-toggle="modal" data-target="#my-event" class="btn btn-sm btn-success btn-outline waves-effect waves-light">
                <i class="ti-plus"></i> <?php echo app('translator')->get('modules.events.addEvent'); ?>
            </a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/full-calendar/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/multiselect/css/multi-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
            <div class="row" style="display: none; " id="ticket-filters">
                <div class="col-xs-12">
                    <h4><?php echo app('translator')->get('app.filterBy'); ?> <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
                </div>
                <form action="" id="filter-form">
                <div class="col-md-3">
                        <h5><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.employees'); ?></h5>

                        <div class="form-group">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.client'); ?>" id="employeeID">
                            <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                            value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <h5><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.client'); ?></h5>

                        <div class="form-group">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.client'); ?>" id="clientID">
                                <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                        value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 ><?php echo app('translator')->get('app.category'); ?></h5>
                
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.clients.category'); ?>"  id="category_id" name="category_id">
                                        <option value="all"><?php echo app('translator')->get('app.all'); ?></option>   
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->category_name)); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
                                          </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 ><?php echo app('translator')->get('modules.events.eventType'); ?></h5>
                
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.events.eventType'); ?>"  id="event_type" name="event_type">
                                        <option value="all"><?php echo app('translator')->get('app.all'); ?></option>   
                                        <?php $__currentLoopData = $eventTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($types->id); ?>"><?php echo e(ucwords($types->name)); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
                                          </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group m-t-10">
                            <label class="control-label col-xs-12">&nbsp;</label>
                            <button type="button" id="apply-filters" class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                            <button type="button" id="reset-filters" class="btn btn-inverse btn-sm"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                        </div>
                    </div>
                </form>
            </div>


                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- .row -->

    <!-- BEGIN MODAL -->
    <div class="modal fade bs-modal-md in" id="my-event" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-plus"></i> <?php echo app('translator')->get('modules.events.addEvent'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['id'=>'createEvent','class'=>'ajax-form','method'=>'POST']); ?>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.eventName'); ?></label>
                                    <input type="text" name="event_name" id="event_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.sticky.colors'); ?></label>
                                    <select id="colorselector" name="label_color">
                                        <option value="bg-info" data-color="#5475ed" selected>Blue</option>
                                        <option value="bg-warning" data-color="#f1c411">Yellow</option>
                                        <option value="bg-purple" data-color="#ab8ce4">Purple</option>
                                        <option value="bg-danger" data-color="#ed4040">Red</option>
                                        <option value="bg-success" data-color="#00c292">Green</option>
                                        <option value="bg-inverse" data-color="#4c5667">Grey</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.where'); ?></label>
                                    <input type="text" name="where" id="where" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><?php echo app('translator')->get('modules.tasks.category'); ?>
                                        <a href="javascript:;" id="add_category" class="btn btn-xs btn-success btn-outline"><i class="fa fa-plus"></i></a>
                                    </label>
                                    <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.clients.category'); ?>"  id="category" name="category_id">
                                    <option value=""><?php echo app('translator')->get('messages.pleaseSelectCategory'); ?></option>    
                                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->category_name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option value=""><?php echo app('translator')->get('messages.noCategoryAdded'); ?></option>
                                         <?php endif; ?>              
                                      </select>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  class="control-label"><?php echo app('translator')->get('modules.events.eventType'); ?>
                                            <a href="javascript:;"
                                            id="createEventType"
                                            class="btn btn-xs btn-outline btn-success">
                                                <i class="fa fa-plus"></i> 
                                            </a>
                                        </label>
                                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('modules.clients.clientSubCategory'); ?>"  id="event_type_id" name="event_type_id">
                                        <option value=""><?php echo app('translator')->get('messages.selectEventType'); ?></option>
                                        <?php $__empty_1 = true; $__currentLoopData = $eventTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($eventType->id); ?>"><?php echo e(ucwords($eventType->name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option value=""><?php echo app('translator')->get('messages.noCategoryAdded'); ?></option>
                                         <?php endif; ?>              
                                      </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('app.description'); ?></label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-md-3 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.startOn'); ?></label>
                                    <input type="text" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <div class="form-group input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="start_time" id="start_time"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.endOn'); ?></label>
                                    <input type="text" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <div class="form-group input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="end_time" id="end_time"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"  id="attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10"><?php echo app('translator')->get('modules.events.addAttendees'); ?></label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-employees" name="all_employees" value="true"
                                                   type="checkbox">
                                            <label for="all-employees"><?php echo app('translator')->get('modules.events.allEmployees'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                            data-placeholder="<?php echo app('translator')->get('modules.messages.chooseMember'); ?>, <?php echo app('translator')->get('modules.projects.selectClient'); ?>" name="user_id[]">
                                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($emp->id); ?>"><?php echo e(ucwords($emp->name)); ?> <?php if($emp->id == $user->id): ?>
                                                    (YOU) <?php endif; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12"  id="attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10"><?php echo app('translator')->get('modules.events.addClients'); ?></label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-employees" name="all_clients" value="true"
                                                   type="checkbox">
                                            <label for="all-employees"><?php echo app('translator')->get('modules.events.allClients'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                            data-placeholder="<?php echo app('translator')->get('modules.messages.chooseMember'); ?>, <?php echo app('translator')->get('modules.projects.selectClient'); ?>" name="user_id[]">
                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->name)); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                            </div>

                        </div>  
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <div class="checkbox checkbox-info">
                                        <input id="repeat-event" name="repeat" value="yes"
                                               type="checkbox">
                                        <label for="repeat-event"><?php echo app('translator')->get('modules.events.repeat'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="repeat-fields" style="display: none">
                            <div class="col-xs-6 col-md-3 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.repeatEvery'); ?></label>
                                    <input type="number" min="1" value="1" name="repeat_count" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="repeat_type" id="" class="form-control">
                                        <option value="day">Day(s)</option>
                                        <option value="week">Week(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.events.cycles'); ?> <a class="mytooltip" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.events.cyclesToolTip'); ?></span></span></span></a></label>
                                    <input type="text" name="repeat_cycles" id="repeat_cycles" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php echo Form::close(); ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light"><?php echo app('translator')->get('app.submit'); ?></button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade bs-modal-md in" id="eventDetailModal" role="dialog" aria-labelledby="myModalLabel"
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
        <!-- /.modal-dialog -->
    </div>
    
    
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
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>

<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>

<script src='<?php echo e(asset('js/full-calendar/rrule.min.js')); ?>'></script>
<script src="<?php echo e(asset('js/full-calendar/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/full-calendar/locales-all.min.js')); ?>"></script>
<script src='<?php echo e(asset('js/full-calendar/main.global.min.js')); ?>'></script>


<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js')); ?>"></script>


<script>
    calender();
    var getEventDetail = function (id, start, end) {
        var url = '<?php echo e(route('admin.events.show', ':id')); ?>?start='+start+'&end='+end;
        url = url.replace(':id', id);

        $('#modelHeading').html('Event');
        $.ajaxModal('#eventDetailModal', url);
    }

    var calendarLocale = '<?php echo e($global->locale); ?>';
    var firstDay = '<?php echo e($global->week_start); ?>';
    jQuery('#start_date, #end_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'<?php echo e($global->week_start); ?>',
        format: '<?php echo e($global->date_picker_format); ?>',
    })

    $('#colorselector').colorselector();

    $('#start_time, #end_time').timepicker({
        
        <?php if($global->time_format == 'H:i'): ?>  
        
        showMeridian: false
        <?php endif; ?>
    });

    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });
    $('#createEventType').click(function(){
            var url = '<?php echo e(route('admin.events-type.create')); ?>';
            $('#modelHeading').html("<?php echo app('translator')->get('modules.contracts.manageContractType'); ?>");
            $.ajaxModal('#projectCategoryModal', url);
        })
        $('#add_category').click(function () {
            var url = '<?php echo e(route('admin.events-category.create')); ?>';
            $('#modelHeading').html('...');
            $.ajaxModal('#projectCategoryModal', url);
         })

    var url = '<?php echo e(route('admin.events.get-filter')); ?>';
    var employee = '';
    var client = '';
    var category = '';
    var event_type = '';

    
    
    
    function addEventModal(start, end, allDay){
        if(start){
            var sd = new Date(start);
            var curr_date = sd.getDate();
            if(curr_date < 10){
                curr_date = '0'+curr_date;
            }
            var curr_month = sd.getMonth();
            curr_month = curr_month+1;
            if(curr_month < 10){
                curr_month = '0'+curr_month;
            }
            var curr_year = sd.getFullYear();

            $('#start_date').val('<?php echo e(\Carbon\Carbon::now()->format($global->date_format)); ?>');

            var ed = new Date(start);
            var curr_date = sd.getDate();
            if(curr_date < 10){
                curr_date = '0'+curr_date;
            }
            var curr_month = sd.getMonth();
            curr_month = curr_month+1;
            if(curr_month < 10){
                curr_month = '0'+curr_month;
            }
            var curr_year = ed.getFullYear();
            $('#end_date').val('<?php echo e(\Carbon\Carbon::now()->format($global->date_format)); ?>');

            $('#start_date, #end_date').datepicker('destroy');
            jQuery('#start_date, #end_date').datepicker({
                autoclose: true,
                todayHighlight: true,
                weekStart:'<?php echo e($global->week_start); ?>',
                format: '<?php echo e($global->date_picker_format); ?>',
            })
        }

        $('#my-event').modal('show');

    }
    $('.toggle-filter').click(function () {
        $('#ticket-filters').slideToggle();
    })
    $('.save-event').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.events.store')); ?>',
            container: '#createEvent',
            type: "POST",
            data: $('#createEvent').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        })
    })

    $('#repeat-event').change(function () {
        if($(this).is(':checked')){
            $('#repeat-fields').show();
        }
        else{
            $('#repeat-fields').hide();
        }
    })
   
     function calender(employee,client,category,event_type){
        
    }
    var initialLocaleCode = '<?php echo e($global->locale); ?>';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        firstDay: firstDay,
        locale: initialLocaleCode,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        
        // initialDate: '2020-09-12',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function(arg) {
          addEventModal(arg.start, arg.end, arg.allDay);
          calendar.unselect()
        },
        eventClick: function(arg) {
            getEventDetail(arg.event.id, arg.event.startStr, arg.event.endStr);
        }, 
            
        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events  
        events: {
            url: '<?php echo e(route("admin.events.get-filter")); ?>',
            extraParams: function() { // a function that returns an object
                return {
                    employee: employee,
                    client: client,
                    category: category,
                    event_type: event_type
                };
            }

      }
        
      });
      $('#reset-filters').click(function () {
        $('.select2').val('all');
        $('.select2').trigger('change')
        employee = $('#employeeID').val();
         client = $('#clientID').val();
         category = $('#category_id').val();
         event_type = $('#event_type').val();
        calendar.refetchEvents();        
    });
      $('#apply-filters').click(function () {
         employee = $('#employeeID').val();
         client = $('#clientID').val();
         category = $('#category_id').val();
         event_type = $('#event_type').val();

        calendar.refetchEvents();
        url = url+'?employee=' + employee + '&client=' + client + '&category=' + category + '&event_type=' + event_type;
    });
    document.addEventListener('DOMContentLoaded', function() { 
      calendar.render();
    });
      
</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/event-calendar/index.blade.php ENDPATH**/ ?>