<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startSection('filter-section'); ?>
        <div class="row">
            <?php echo Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']); ?>

            <div class="col-xs-12">
                <div class="example">
                    <h5 class="box-title"><?php echo app('translator')->get('app.selectDateRange'); ?></h5>

                    <div class="input-daterange input-group" id="date-range">
                        <input type="text" class="form-control" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                            value="<?php echo e($fromDate->format($global->date_format)); ?>"/>
                        <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                        <input type="text" class="form-control" id="end-date" placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                            value="<?php echo e($toDate->format($global->date_format)); ?>"/>
                    </div>
                </div>
            </div>

            <div class="col-md-12 m-t-20">
                <h5 class="box-title"><?php echo app('translator')->get('app.select'); ?> <?php echo app('translator')->get('app.duration'); ?></h5>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.duration'); ?>" id="duration">
                                <option value="1"><?php echo app('translator')->get('app.last'); ?> 30 <?php echo app('translator')->get('app.days'); ?></option>
                                <option value="3"><?php echo app('translator')->get('app.last'); ?> 3 <?php echo app('translator')->get('app.month'); ?></option>
                                <option value="6"><?php echo app('translator')->get('app.last'); ?> 6 <?php echo app('translator')->get('app.month'); ?></option>
                                <option value="12"><?php echo app('translator')->get('app.last'); ?> 1 <?php echo app('translator')->get('app.year'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xs-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-success col-md-6" id="filter-results"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?>
                            </button>
                            <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    <?php $__env->stopSection(); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <div class="col-md-6  text-center">
                    <h4><span class="text-info"><?php echo e($global->currency->currency_symbol); ?></span><span class="text-info" id="total-incomes"><?php echo e($totalIncomes); ?></span> <span class="font-12 text-muted m-l-5"><?php echo app('translator')->get("modules.incomeVsExpenseReport.totalIncome"); ?></span></h4>
                </div>
                <div class="col-md-6 b-l text-center">
                    <h4><span class="text-danger"><?php echo e($global->currency->currency_symbol); ?></span><span class="text-danger" id="total-expenses"><?php echo e($totalExpenses); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get("modules.incomeVsExpenseReport.totalExpense"); ?></span></h4>
                </div>
            </div>
        </div>

    </div>

 
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title"><?php echo app('translator')->get("modules.incomeVsExpenseReport.chartTitle"); ?></h3>
                <div>
                    <div id="bar-chart" height="100"></div>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>


<script src="<?php echo e(asset('plugins/bower_components/Chart.js/Chart.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>

<script>

    var barGraph;

    $(function () {
        barChart(<?php echo json_encode($graphData); ?>);
        initConter();
    });

    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });

    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: '<?php echo e($global->date_picker_format); ?>',
    });

    function populateChart() {
        var token = '<?php echo e(csrf_token()); ?>';
        var url = '<?php echo e(route('admin.income-expense-report.store')); ?>';

        var startDate = $('#start-date').val();

        if (startDate == '') {
            startDate = null;
        }

        var endDate = $('#end-date').val();

        if (endDate == '') {
            endDate = null;
        }

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {_token: token, startDate: startDate, endDate: endDate},
            success: function (response) {

                $('#total-incomes').html(response.totalIncomes);
                $('#total-expenses').html(response.totalExpenses);

                $('#bar-chart').empty();
                barChart(response.graphData);
                initConter();
            }
        });
    }

    function barChart(graphData) {
        barGraph = Morris.Bar({
            element: 'bar-chart',
            data: graphData,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Income', 'Expense'],
            barColors:['#b8edf0', '#fcc9ba'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
    }

    function initConter() {
        $(".counter").counterUp({
            delay: 100,
            time: 1200
        });
    }

    $('#duration').on('change', function () {
        var month = this.value;

        var end_date = moment().format('YYYY-MM-DD');
        var start_date = moment().subtract('month', month).format('YYYY-MM-DD');

        $('#start-date').val(start_date);
        $('#end-date').val(end_date);
    });

    $('#filter-results').click(function () {
        populateChart();
    })

    $('#reset-filters').click(function () {
        $('.select2').val('1');
        $('.select2').trigger('change');
        
        populateChart();
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/reports/income-expense/index.blade.php ENDPATH**/ ?>