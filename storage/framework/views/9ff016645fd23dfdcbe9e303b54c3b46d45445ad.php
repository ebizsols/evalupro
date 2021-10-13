<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">

<div class="row dashboard-stats front-dashboard">
    <?php if(in_array('invoices',$modules) && in_array('total_paid_invoices',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.all-invoices.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-success-gradient"><i class="fa fa-money"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalPaidInvoices'); ?></span><br>
                            <span class="counter"><?php echo e($totalPaidInvoice); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('expenses',$modules) && in_array('total_expenses',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.expenses.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-warning-gradient"><i class="fa fa-money"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalExpenses'); ?></span><br>
                            <span class="counter"><?php echo e($global->currency->currency_symbol .' '. number_format($totalExpenses)); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('payments',$modules) && in_array('total_earnings',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.payments.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-danger-gradient"><i class="fa fa-money"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalEarnings'); ?></span><br>
                            <span class="counter"><?php echo e($global->currency->currency_symbol .' '. number_format($totalEarnings)); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('payments',$modules) && in_array('expenses',$modules) && in_array('total_profit',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="javascript:;">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-inverse-gradient"><i class="fa fa-money"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalProfit'); ?></span><br>
                            <span class="counter"><?php echo e($global->currency->currency_symbol .' '. number_format($totalProfit)); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <?php if(in_array('invoices',$modules) && in_array('total_pending_amount',$activeWidgets)): ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(route('admin.all-invoices.index')); ?>">
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-3">
                            <div><span class="bg-success-gradient"><i class="fa fa-money"></i></span></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span class="widget-title"> <?php echo app('translator')->get('modules.dashboard.totalPendingAmount'); ?></span><br>
                            <span class="counter"><?php echo e($global->currency->currency_symbol .' '. number_format($totalPendingAmount)); ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div>
<div class="row m-b-20">
    <?php if(in_array('invoices',$modules) && in_array('invoice_overview',$activeWidgets)): ?>
        <div class="col-md-4 col-sm-6">
            <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.dashboard.invoiceOverview'); ?></h3>
            <hr class="m-b-20">
            <?php $__currentLoopData = $invoiceOverviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceOverview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="progress-label m-b-10">
                    <span class="progressCountType dashboard-text-<?php echo e($invoiceOverview['color']); ?>"><span><?php echo e($invoiceOverview['count']); ?></span> <?php echo app('translator')->get('modules.dashboard.'.$key); ?></span>
                    <span class="progressPercent"><?php echo e($invoiceOverview['percent']); ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar dashboard-bg-<?php echo e($invoiceOverview['color']); ?>" role="progressbar" style="width: <?php echo e($invoiceOverview['percent']); ?>%" aria-valuenow="<?php echo e($invoiceOverview['percent']); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($invoiceOverviewCount); ?>"></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if(in_array('estimates',$modules) && in_array('estimate_overview',$activeWidgets)): ?>
        <div class="col-md-4 col-sm-6">
            <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.dashboard.estimateOverview'); ?></h3>
            <hr class="m-b-20">
            <?php $__currentLoopData = $estimateOverviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $estimateOverview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="progress-label m-b-10">
                    <span class="progressCountType dashboard-text-<?php echo e($estimateOverview['color']); ?>"><span><?php echo e($estimateOverview['count']); ?></span> <?php echo app('translator')->get('modules.dashboard.'.$key); ?></span>
                    <span class="progressPercent"><?php echo e($estimateOverview['percent']); ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar dashboard-bg-<?php echo e($estimateOverview['color']); ?>" role="progressbar" style="width: <?php echo e($estimateOverview['percent']); ?>%" aria-valuenow="<?php echo e($estimateOverview['percent']); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($estimateOverviewCount); ?>"></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if(in_array('leads',$modules) && in_array('proposal_overview',$activeWidgets)): ?>
        <div class="col-md-4 col-sm-6">
            <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.dashboard.proposalOverview'); ?></h3>
            <hr class="m-b-20">
            <?php $__currentLoopData = $proposalOverviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $proposalOverview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="progress-label m-b-10">
                    <span class="progressCountType dashboard-text-<?php echo e($proposalOverview['color']); ?>"><span><?php echo e($proposalOverview['count']); ?></span> <?php echo app('translator')->get('modules.dashboard.'.$key); ?></span>
                    <span class="progressPercent"><?php echo e($proposalOverview['percent']); ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar dashboard-bg-<?php echo e($proposalOverview['color']); ?>" role="progressbar" style="width: <?php echo e($proposalOverview['percent']); ?>%" aria-valuenow="<?php echo e($proposalOverview['percent']); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($proposalOverviewCount); ?>"></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<div class="row m-t-20">
    <div class="col-xs-12"> 
        <!-- Nav tabs -->
        <div class="card dashboard_tabs">
            <ul class="nav nav-tabs" id="dashboard_tabs" role="tablist">
                <?php if(in_array('invoices',$modules) && in_array('invoice_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#invoice" aria-controls="invoice" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.invoiceTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(in_array('estimates',$modules) && in_array('estimate_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#estimate" aria-controls="estimate" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.estimateTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(in_array('expenses',$modules) && in_array('expense_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.expenseTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(in_array('payments',$modules) && in_array('payment_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.paymentTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(in_array('payments',$modules) && in_array('due_payments_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#due_payments" aria-controls="due_payments" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.duePaymentsTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(in_array('leads',$modules) && in_array('proposal_tab',$activeWidgets)): ?>
                    <li role="presentation">
                        <a href="#proposal" aria-controls="proposal" role="tab" data-toggle="tab">
                            <span><?php echo app('translator')->get('modules.dashboard.proposalTab'); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <?php if(in_array('invoices',$modules) && in_array('invoice_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="invoice">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="invoice-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo app('translator')->get('app.invoice'); ?> #</th>
                                        <th><?php echo app('translator')->get('app.project'); ?></th>
                                        <th><?php echo app('translator')->get('app.client'); ?></th>
                                        <th><?php echo app('translator')->get('modules.invoices.total'); ?></th>
                                        <th><?php echo app('translator')->get('modules.invoices.invoiceDate'); ?></th>
                                        <th><?php echo app('translator')->get('app.status'); ?></th>
                                        <th><?php echo app('translator')->get('app.action'); ?></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                <?php endif; ?> 
                <?php if(in_array('estimates',$modules) && in_array('estimate_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="estimate">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="estimate-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('app.estimate'); ?> #</th>
                                    <th><?php echo app('translator')->get('app.client'); ?></th>
                                    <th><?php echo app('translator')->get('modules.invoices.total'); ?></th>
                                    <th><?php echo app('translator')->get('modules.estimates.validTill'); ?></th>
                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                    <th><?php echo app('translator')->get('app.action'); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                <?php endif; ?> 
                <?php if(in_array('expenses',$modules) && in_array('expense_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="expense">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="expense-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('modules.employees.title'); ?></th>
                                    <th><?php echo app('translator')->get('modules.expenses.itemName'); ?></th>
                                    <th><?php echo app('translator')->get('app.price'); ?></th>
                                    <th><?php echo app('translator')->get('modules.expenses.purchaseDate'); ?></th>
                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                    <th><?php echo app('translator')->get('app.action'); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                <?php endif; ?> 
                <?php if(in_array('payments',$modules) && in_array('payment_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="payment">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="payment-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('app.project'); ?></th>
                                    <th><?php echo app('translator')->get('app.invoice'); ?></th>
                                    <th><?php echo app('translator')->get('modules.invoices.amount'); ?></th>
                                    <th><?php echo app('translator')->get('modules.payments.paidOn'); ?></th>
                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                    <th><?php echo app('translator')->get('app.action'); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                <?php endif; ?> 
                <?php if(in_array('payments',$modules) && in_array('due_payments_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="due_payments">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="due_payments-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('app.project'); ?></th>
                                    <th><?php echo app('translator')->get('app.invoice'); ?></th>
                                    <th><?php echo app('translator')->get('modules.invoices.amount'); ?></th>
                                    <th><?php echo app('translator')->get('modules.payments.paidOn'); ?></th>
                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                    <th><?php echo app('translator')->get('app.action'); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                <?php endif; ?> 
                <?php if(in_array('leads',$modules) && in_array('proposal_tab',$activeWidgets)): ?>
                    <div role="tabpanel" class="tab-pane" id="proposal">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="proposal-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('app.lead'); ?></th>
                                    <th><?php echo app('translator')->get('modules.invoices.total'); ?></th>
                                    <th><?php echo app('translator')->get('modules.estimates.validTill'); ?></th>
                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                    <th><?php echo app('translator')->get('app.action'); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php if(in_array('payments',$modules) && in_array('earnings_by_client',$activeWidgets)): ?>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.dashboard.earningsByClient'); ?></h3>

                    <?php if(!empty(json_decode($earningsByClient))): ?>
                    <div>
                        <canvas id="earnings_by_clients" height="100"></canvas>
                    </div>
                        <h6 style="line-height: 2em;"><span
                                    class=" label label-danger"><?php echo app('translator')->get('app.note'); ?>:</span> <?php echo app('translator')->get('messages.earningChartNote'); ?>
                            <a href="<?php echo e(route('admin.settings.index')); ?>"><i class="fa fa-arrow-right"></i></a></h6>

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
    <?php endif; ?>
    <?php if(in_array('payments',$modules) && in_array('projects',$modules) && in_array('earnings_by_projects',$activeWidgets)): ?>
        <div class="col-md-12 m-t-20">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.dashboard.earningsByProjects'); ?></h3>

                    <?php if(!empty(json_decode($earningsByProjects))): ?>
                    <div>
                        <canvas id="earnings_by_project" height="100"></canvas>
                    </div>
                    <?php else: ?>
                        <div  class="text-center">
                            <div class="empty-space" style="height: 200px;">
                                <div class="empty-space-inner">
                                    <div class="icon" style="font-size:30px"><i class="fa fa-tasks"></i></div>
                                    <div class="title m-b-15"><?php echo app('translator')->get('messages.noEarningRecordFound'); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    <?php endif; ?>
</div>


<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/responsive.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>



<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>

<!--weather icon -->

<script src="<?php echo e(asset('plugins/bower_components/calendar/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/calendar/dist/locale-all.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>



<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script>
    
    var table;
    $(function () {
        // $('#dashboard_tabs a:first').tab('show');
    });
    
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        var tab = $(e.target);
        var contentId = tab.attr("href");
        //This check if the tab is active
        if (tab.parent().hasClass('active')) {
            
            if ((contentId == '#estimate')) {
                var url = '<?php echo route('admin.financeDashboardEstimate'); ?>?startDate=' + startDate + '&endDate=' + endDate;
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'original_estimate_number', name: 'original_estimate_number' },
                    { data: 'name', name: 'users.name' },
                    { data: 'total', name: 'total' },
                    { data: 'valid_till', name: 'valid_till' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', width: '5%' }
                ]
                dataTable('#estimate-table', url, columns);
            }
            else if ((contentId == '#invoice')) {
                var url = '<?php echo route('admin.financeDashboardInvoice'); ?>?startDate=' + startDate + '&endDate=' + endDate;
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'invoice_number', name: 'invoice_number' },
                    { data: 'project_name', name: 'project.project_name' },
                    { data: 'name', name: 'project.client.name' },
                    { data: 'total', name: 'total' },
                    { data: 'issue_date', name: 'issue_date' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', width: '12%' }
                ]
                dataTable('#invoice-table', url, columns);
            }
            else if ((contentId == '#expense')) {
                var url = '<?php echo route('admin.financeDashboardExpense'); ?>?startDate=' + startDate + '&endDate=' + endDate;
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_id', name: 'user_id', searchable: false },
                    { data: 'item_name', name: 'item_name' },
                    { data: 'price', name: 'price' },
                    { data: 'purchase_date', name: 'purchase_date' },
                    { data: 'status_export', name: 'status' },
                    { data: 'action', name: 'action', width: '20%' }
                ]
                dataTable('#expense-table', url, columns);
            }
            else if ((contentId == '#payment')) {
                var url = '<?php echo route('admin.financeDashboardPayment'); ?>?startDate=' + startDate + '&endDate=' + endDate + '&status=complete';
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'project_id', name: 'project_id' },
                    { data: 'invoice_number', name: 'invoices.invoice_number' },
                    { data: 'amount', name: 'amount' },
                    { data: 'paid_on', name: 'paid_on' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', width: '10%' }
                ]
                dataTable('#payment-table', url, columns);
            }
            else if ((contentId == '#due_payments')) {
                var url = '<?php echo route('admin.financeDashboardPayment'); ?>?startDate=' + startDate + '&endDate=' + endDate + '&status=pending';
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'project_id', name: 'project_id' },
                    { data: 'invoice_number', name: 'invoices.invoice_number' },
                    { data: 'amount', name: 'amount' },
                    { data: 'paid_on', name: 'paid_on' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', width: '10%' }
                ]
                dataTable('#due_payments-table', url, columns);
            }
            else if ((contentId == '#proposal')) {
                var url = '<?php echo route('admin.financeDashboardProposal'); ?>?startDate=' + startDate + '&endDate=' + endDate;
                var columns = [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'company_name', name: 'leads.company_name' },
                    { data: 'total', name: 'total' },
                    { data: 'valid_till', name: 'valid_till' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', width: '5%' }
                ]
                dataTable('#proposal-table', url, columns);
            }
        }

    });

    function dataTable(id, url, columns){
        table = $(id).dataTable({
            dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            order: [[ 0, "desc" ]],
            ajax: url,
            buttons: [],
            language: {
                "url": "<?php echo __("app.datatable") ?>"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: columns
        });
    }
    $(document).ready(function () {
        <?php if(in_array('payments',$modules) && in_array('earnings_by_client',$activeWidgets)): ?>
            <?php if(!empty(json_decode($earningsByClient))): ?>
                var earningsByClient = <?php echo $earningsByClient; ?>;

                function earningsByClientBarChart() {

                    var ctx3 = document.getElementById("earnings_by_clients");
                    var data = new Array();
                    var color = new Array();
                    var labels = new Array();

                    $.each(earningsByClient, function(key,val){
                        labels.push(val.client);
                        data.push(parseInt(val.total));
                        color.push('#03a9f3');
                    });

                    new Chart(ctx3,{
                        "type":"horizontalBar",
                        "data":{
                            "labels":labels,
                            "datasets":[{
                                "label":'Earnings',
                                "data":data,
                                "backgroundColor":color
                            }]
                        }
                    });
                }
                earningsByClientBarChart();
            <?php endif; ?>
        <?php endif; ?>
        <?php if(in_array('payments',$modules) && in_array('projects',$modules) && in_array('earnings_by_projects',$activeWidgets)): ?>
            <?php if(!empty(json_decode($earningsByProjects))): ?>

                var earningsByProjects = <?php echo $earningsByProjects; ?>;
                
                var ctx3 = document.getElementById("earnings_by_project");
                    var data = new Array();
                    var color = new Array();
                    var labels = new Array();

                    $.each(earningsByProjects, function(key,val){
                        labels.push(val.project);
                        data.push(parseInt(val.total));
                        color.push('#03a9f3');
                    });

                    new Chart(ctx3,{
                        "type":"horizontalBar",
                        "data":{
                            "labels":labels,
                            "datasets":[{
                                "label":'Earnings',
                                "data":data,
                                "backgroundColor":color
                            }]
                        }
                    });

            <?php endif; ?>
        <?php endif; ?>
        setTimeout(function(){ $('#dashboard_tabs a:first').tab('show'); }, 1000);
    })
</script><?php /**PATH /home/evalupro/public_html/resources/views/admin/dashboard/finance-dashboard.blade.php ENDPATH**/ ?>