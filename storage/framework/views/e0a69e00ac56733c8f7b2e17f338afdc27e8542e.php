<section class="section-hero">
    <div class="banner position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12 text-lg-left text-center">
                    <div class="banner-text mr-0 mr-lg-5">
                        <h3 class="mb-3 mb-md-4">  <?php echo e($trFrontDetail->header_title ?: $defaultTrFrontDetail->header_title); ?></h3>
                        <p><?php echo $trFrontDetail->header_description ?: $defaultTrFrontDetail->header_description; ?></p>
                        <?php if($frontDetail->get_started_show == 'yes'): ?>
                            <?php if(isset($packageSetting) && isset($trialPackage) && $packageSetting && !is_null($trialPackage)): ?>
                                <a href="<?php echo e(route('front.signup.index')); ?>" class="btn btn-lg btn-custom mt-4 btn-outline"><?php echo e($packageSetting->trial_message); ?> </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('front.signup.index')); ?>"  style ="margin-bottom: 46px;" class="btn btn-lg btn-custom mt-4 btn-outline"><?php echo e($frontMenu->get_start); ?></a>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-lg-6 col-12 d-lg-block wow zoomIn" data-wow-delay="0.2s">
                    <div class="banner-img shadow1">
                        <img src="<?php echo e($trFrontDetail->image_url ?: $defaultTrFrontDetail->image_url); ?>" alt="business" class="shadow1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /**PATH C:\xampp\htdocs\evalupro\resources\views/saas/section/header.blade.php ENDPATH**/ ?>