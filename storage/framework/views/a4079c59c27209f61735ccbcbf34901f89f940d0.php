<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">

<div class="row dashboard-stats front-dashboard">
    <?php if(in_array('projects',$modules) && in_array('total_project',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.projects.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-success-gradient"><i class="icon-layers"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalProject'); ?></span><br>
                            <span class="counter"><?php echo e($totalProject); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('timelogs',$modules) && in_array('total_hours_logged',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.all-time-logs.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-warning-gradient"><i class="icon-clock"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalHoursLogged'); ?></span><br>
                            <span class="counter"><?php echo e($totalHoursLogged); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('projects',$modules) && in_array('total_overdue_project',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.projects.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-danger-gradient"><i class="icon-layers"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalOverdueProject'); ?></span><br>
                            <span class="counter"><?php echo e($totalOverdueProject); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div>
<div class="row">
    <?php if(in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.statusWiseProject'); ?>
                    <a href="javascript:;" data-chart-id="statusWiseProject" class="text-dark pull-right download-chart">
                        <i class="fa fa-download"></i> <?php echo app('translator')->get('app.download'); ?>
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">

                                <?php if(!empty(json_decode($statusWiseProject))): ?>
                                    <div>
                                        <canvas id="statusWiseProject"></canvas>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px"><i class="icon-layers"></i></div>
                                                <div class="title m-b-15"><?php echo app('translator')->get('messages.noProjectFound'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    <?php endif; ?>
    <?php if(in_array('projects',$modules) && in_array('pending_milestone',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.pendingMilestone'); ?></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('app.milestone'); ?></th>
                                    <th><?php echo app('translator')->get('app.project'); ?></th>
                                    <th><?php echo app('translator')->get('app.amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $pendingMilestone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('admin.milestones.show', $milestone->project_id)); ?>" class="font-12"><?php echo e(ucwords($milestone->milestone_title)); ?></a>                                        
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.projects.show', $milestone->project_id)); ?>" class="font-12"><?php echo e(ucwords($milestone->project_name)); ?></a>
                                    </td>
                                    <td><?php echo e($milestone->currency_symbol . $milestone->cost); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3">
                                        <?php echo app('translator')->get("messages.noRecordFound"); ?>
                                    </td>
                                    
                                </tr>
                               
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/locale-all.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        <?php if(!empty(json_decode($statusWiseProject)) && in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets)): ?>
            function statusWiseProjectPieChart(statusWiseProject) {
                var ctx2 = document.getElementById("statusWiseProject");
                var data = new Array();
                var color = new Array();
                var labels = new Array();
                var total = 0;

                $.each(statusWiseProject, function(key,val){
                    labels.push(val.status.toUpperCase());
                    data.push(parseInt(val.totalProject));
                    total = total+parseInt(val.totalProject);
                    if (val.status == "in progress") {
                        color.push("#03a9f3");
                    } else if (val.status == "on hold") {
                        color.push("#fec107");
                    } else if (val.status == "not started") {
                        color.push("#fec107");
                    } else if (val.status == "canceled") {
                        color.push("#fb9678");
                    } else if (val.status == "finished") {
                        color.push("#00c292");
                    }
                });

                // labels.push('Total '+total);
                var chart = new Chart(ctx2,{
                    "type":"doughnut",
                    "data":{
                        "labels":labels,
                        "datasets":[{
                            "data":data,
                            "backgroundColor":color
                        }]
                    }
                });
                chart.canvas.parentNode.style.height = '470px';
            }
            statusWiseProjectPieChart(jQuery.parseJSON('<?php echo $statusWiseProject; ?>'));

        <?php endif; ?>


        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $('.download-chart').click(function() {
            var id = $(this).data('chart-id');
            this.href = $('#'+id)[0].toDataURL();// Change here
            this.download = id+'.png';
        });

    });

    
    
</script><?php /**PATH /home/evalupro/public_html/resources/views/admin/dashboard/project-dashboard.blade.php ENDPATH**/ ?>