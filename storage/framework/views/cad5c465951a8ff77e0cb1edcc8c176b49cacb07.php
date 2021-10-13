<?php $__env->startComponent('mail::message'); ?>
# New Task

<?php echo app('translator')->get('email.newTask.subject'); ?>

<h5><?php echo app('translator')->get('app.task'); ?> <?php echo app('translator')->get('app.details'); ?></h5>

<?php $__env->startComponent('mail::text', ['text' => $content]); ?>

<?php if (isset($__componentOriginalc89b362e347ac15eb429debed60656ada449567a)): ?>
<?php $component = $__componentOriginalc89b362e347ac15eb429debed60656ada449567a; ?>
<?php unset($__componentOriginalc89b362e347ac15eb429debed60656ada449567a); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>


<?php $__env->startComponent('mail::button', ['url' => $url]); ?>
<?php echo app('translator')->get('app.view'); ?> <?php echo app('translator')->get('app.task'); ?>
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php echo app('translator')->get('email.regards'); ?>,<br>
<?php echo e(config('app.name')); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/evalupro/public_html/resources/views/mail/task/created.blade.php ENDPATH**/ ?>