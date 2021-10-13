<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">
<div class="row dashboard-stats front-dashboard">
    <?php if(in_array('clients',$modules) && in_array('total_clients',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.clients.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-success-gradient"><i class="icon-people"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalClients'); ?></span><br>
                            <span class="counter"><?php echo e($totalClient); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('leads',$modules) && in_array('total_leads',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.leads.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-warning-gradient"><i class="icon-people"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalLeads'); ?></span><br>
                            <span class="counter"><?php echo e($totalLead); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('leads',$modules) && in_array('total_lead_conversions',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.leads.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-danger-gradient"><i class="icon-people"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalLeadConversions'); ?></span><br>
                            <span class="counter"><?php echo e($totalLeadConversions); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('contracts',$modules) && in_array('total_contracts_generated',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.contracts.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-inverse-gradient"><i class="icon-book-open"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalContractsGenerated'); ?></span><br>
                            <span class="counter"><?php echo e($totalContractsGenerated); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('contracts',$modules) && in_array('total_contracts_signed',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.contracts.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-success-gradient"><i class="icon-book-open"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalContractsSigned'); ?></span><br>
                            <span class="counter"><?php echo e($totalContractsSigned); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div> 
<div class="row">
    <?php if(in_array('payments',$modules) && in_array('client_wise_earnings',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.clientWiseEarnings'); ?>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if(!empty(json_decode($chartData))): ?>
                                    <div id="morris-area-chart"  class="morris-bar-chart" style="height: 350px"></div>
                                    <h6 style="line-height: 2em;"><span class=" label label-danger"><?php echo app('translator')->get('app.note'); ?>:</span> <?php echo app('translator')->get('messages.earningChartNote'); ?>
                                        <a href="<?php echo e(route('admin.settings.index')); ?>"><i class="fa fa-arrow-right"></i></a>
                                    </h6>
                                <?php else: ?>
                                    <div  class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px"><i class="fa fa-money"></i></div>
                                                <div class="title m-b-15"><?php echo app('translator')->get('messages.noEarningRecordFound'); ?></div>
                                                <div class="subtitle">
                                                    <a href="<?php echo e(route('admin.payments.index')); ?>" class="btn btn-info btn-outline btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                        <?php echo app('translator')->get('app.manage'); ?>
                                                    </a>
                                                </div>
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
    <?php if(in_array('timelogs',$modules) && in_array('client_wise_timelogs',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.clientWiseTimelogs'); ?></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if(!empty(json_decode($clientWiseTimelogChartData))): ?>
                                    <div id="morris-timelog-chart" class="morris-bar-chart" style="height: 350px; padding-bottom: 25px;"></div>
                                <?php else: ?>
                                    <div  class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px"><i class="fa fa-clock-o"></i></div>
                                                <div class="title m-b-15"><?php echo app('translator')->get('messages.noTimeLogsFound'); ?></div>
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
    <?php if(in_array('leads',$modules) && in_array('lead_vs_status',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.leadVsStatus'); ?>
                    <a href="javascript:;" data-chart-id="lead_vs_status_chart" class="text-dark pull-right download-chart">
                        <i class="fa fa-download"></i> <?php echo app('translator')->get('app.download'); ?>
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
    
                                <?php if(!empty(json_decode($leadVsStatus))): ?>
                                    <div>
                                        <canvas id="lead_vs_status_chart" height="240"></canvas>
                                    </div>
                                <?php else: ?>
                                    <div  class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px">
                                                    <i class="fa fa-tasks"></i>
                                                </div>
                                                <div class="title m-b-15"><?php echo app('translator')->get('messages.noLeadsFound'); ?>
                                                </div>
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
    <?php if(in_array('leads',$modules) && in_array('lead_vs_source',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.leadVsSource'); ?>
                    <a href="javascript:;" data-chart-id="lead_vs_source_chart" class="text-dark pull-right download-chart">
                        <i class="fa fa-download"></i> <?php echo app('translator')->get('app.download'); ?>
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
    
                                <?php if(!empty(json_decode($leadVsSource))): ?>
                                    <div>
                                        <canvas id="lead_vs_source_chart" height="240"></canvas>
                                    </div>
                                <?php else: ?>
                                    <div  class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px">
                                                    <i class="fa fa-tasks"></i>
                                                </div>
                                                <div class="title m-b-15"><?php echo app('translator')->get('messages.noLeadsFound'); ?>
                                                </div>
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
    <?php if(in_array('clients',$modules) && in_array('latest_client',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.latestClient'); ?></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            <?php $__empty_1 = true; $__currentLoopData = $latestClient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="sl-item">
                                    <div class="sl-left">
                                        <img src="<?php echo e($activity->image_url); ?>" width="40" height="40" alt="user" class="img-circle">
                                    </div>
                                    <div class="sl-right">
                                        <div class="m-l-40"><a href="<?php echo e(route('admin.clients.show', $activity->id)); ?>" class="text-success"><?php echo e(ucwords($activity->name)); ?> <?php echo e(($activity->company_name) ? ' (' . ucwords($activity->company_name) . ')' : ''); ?></a>
                                            <span class="sl-date"><?php echo e($activity->created_at ? $activity->created_at->diffForHumans(): '--'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(count($latestClient) > ($key+1)): ?>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div  class="text-center">
                                <div class="empty-space" style="height: 200px;">
                                    <div class="empty-space-inner">
                                        <div class="icon" style="font-size:30px">
                                            <i class="icon-people"></i>
                                        </div>
                                        <div class="title m-b-15"><?php echo app('translator')->get('messages.noLatestClientFound'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(in_array('clients',$modules) && in_array('recent_login_activities',$activeWidgets)): ?>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.dashboard.recentLoginActivities'); ?></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            <?php $__empty_1 = true; $__currentLoopData = $recentLoginActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="sl-item">
                                    <div class="sl-left">
                                        <img src="<?php echo e($activity->image_url); ?>" width="40" height="40" alt="user" class="img-circle">
                                    </div>
                                    <div class="sl-right">
                                        <div class="m-l-40"><a href="<?php echo e(route('admin.clients.show', $activity->id)); ?>" class="text-success"><?php echo e(ucwords($activity->name)); ?></a>
                                            <span class="sl-date"><?php echo app('translator')->get('app.last'); ?> <?php echo app('translator')->get('app.login'); ?> <?php echo e($activity->last_login ? \Carbon\Carbon::parse($activity->last_login)->diffForHumans(): '--'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(count($recentLoginActivities) > ($key+1)): ?>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center">
                                    <div class="empty-space" style="height: 200px;">
                                        <div class="empty-space-inner">
                                            <div class="icon" style="font-size:30px">
                                                <i class="icon-lock"></i>
                                            </div>
                                            <div class="title m-b-15"><?php echo app('translator')->get('messages.noLoginActivityFound'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<!--weather icon -->

<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        <?php if(!empty(json_decode($chartData))): ?>
            var chartData = <?php echo $chartData; ?>;

            function barChart() {
                Morris.Bar({
                    element: 'morris-area-chart',
                    data: chartData,
                    xkey: 'client',
                    ykeys: ['total'],
                    labels: ['Earning'],
                    pointSize: 3,
                    fillOpacity: 0,
                    barColors: ['#6fbdff'],
                    behaveLikeLine: true,
                    gridLineColor: '#e0e0e0',
                    lineWidth: 2,
                    hideHover: 'auto',
                    lineColors: ['#e20b0b'],
                    resize: true,
                    xLabelMargin: 10,
                    xLabelAngle: 70,
                    padding: 20
                });
                $('#morris-area-chart').addClass('customChartCss');
            }
            barChart();
        <?php endif; ?>

        <?php if(!empty(json_decode($clientWiseTimelogChartData))): ?>

            var clientWiseTimelogChartData = <?php echo $clientWiseTimelogChartData; ?>;
            
            function timelogBarChart() {
                Morris.Bar({
                    element: 'morris-timelog-chart',
                    data: clientWiseTimelogChartData,
                    xkey: 'client',
                    ykeys: ['totalHours'],
                    labels: ['Hours'],
                    pointSize: 3,
                    fillOpacity: 0,
                    barColors: ['#6fbdff'],
                    behaveLikeLine: true,
                    gridLineColor: '#e0e0e0',
                    lineWidth: 2,
                    hideHover: 'auto',
                    lineColors: ['#e20b0b'],
                    resize: true,
                    xLabelMargin: 10,
                    xLabelAngle: 70,
                    padding: 20
                });
                $('#morris-timelog-chart').addClass('customChartCss');
            }

            timelogBarChart();
        <?php endif; ?>

        <?php if(!empty(json_decode($leadVsStatus))): ?>

            function pieChart(leadVsStatus) {
                var ctx2 = document.getElementById("lead_vs_status_chart");
                var data = new Array();
                var color = new Array();
                var labels = new Array();
                var total = 0;

                $.each(leadVsStatus, function(key,val){
                    labels.push(val.label);
                    data.push(parseInt(val.total));
                    total = total+parseInt(val.total);
                    color.push(val.color);
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
                chart.canvas.parentNode.style.width = '470px';
            }

            pieChart(jQuery.parseJSON('<?php echo $leadVsStatus; ?>'));

        <?php endif; ?>
        
        <?php if(!empty(json_decode($leadVsSource))): ?>

            function leadVsSourcePieChart(leadVsSource) {
                
                var ctx3 = document.getElementById("lead_vs_source_chart").getContext('2d');;
                var data = new Array();
                var color = new Array();
                var labels = new Array();

                $.each(leadVsSource, function(key,val){
                    labels.push(val.label);
                    data.push(parseInt(val.total));
                    color.push(getRandomColor());
                });

                var chart = new Chart(ctx3,{
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
                chart.canvas.parentNode.style.width = '470px';
            }

            leadVsSourcePieChart(jQuery.parseJSON('<?php echo $leadVsSource; ?>'));

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

    })
</script><?php /**PATH /home/evalupro/public_html/resources/views/admin/dashboard/client-dashboard.blade.php ENDPATH**/ ?>