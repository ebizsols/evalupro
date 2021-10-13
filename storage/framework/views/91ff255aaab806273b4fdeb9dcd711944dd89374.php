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
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>

<style>
    .col-in {
        padding: 0 20px !important;

    }

    .fc-event{
        font-size: 10px !important;
    }

    @media (min-width: 769px) {
        #wrapper .panel-wrapper{
            height: 250px;
            overflow-y: auto;
        }
    }

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="white-box">
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $faqCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faqCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                <div class="col-md-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading"> <?php echo e($faqCategory->name); ?></div>
                        <div class="panel-wrapper collapse in">

                            <div class="panel-body">
                                <ul class="list-icons">
                                    <?php $__empty_2 = true; $__currentLoopData = $faqCategory->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                        <li>
                                            <a href="javascript:void(0)" onclick="showFaqDetails(<?php echo e($faq->id); ?>)">
                                                <i class="fa fa-file-text"></i> <?php echo e($faq->title); ?>

                                                </a>
                                        </li>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <div class="empty-space" style="height: 200px;">
                                                        <div class="empty-space-inner">
                                                            <div class="icon" style="font-size:30px"><i
                                                                        class="icon-layers"></i>
                                                            </div>
                                                            <div class="title m-b-15"><?php echo app('translator')->get('messages.noFaqCreated'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            <div class="empty-space" style="height: 200px;">
                                <div class="empty-space-inner">
                                    <div class="icon" style="font-size:30px"><i
                                                class="icon-layers"></i>
                                    </div>
                                    <div class="title m-b-15"><?php echo app('translator')->get('messages.noFaqCreated'); ?>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
        </div>
    </div>

    
    <div class="modal fade bs-modal-md in" id="faqDetailsModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="faq-details-modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
<?php $__env->stopSection(); ?>


<?php $__env->startPush('footer-script'); ?>
<script>
    function showFaqDetails(id) {
        var url = '<?php echo e(route('admin.faqs.details', ':id')); ?>';
        url = url.replace(':id', id);

        $.ajaxModal('#faqDetailsModal', url);
    }
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/evalupro/public_html/resources/views/admin/faqs/index.blade.php ENDPATH**/ ?>