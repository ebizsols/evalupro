<?php $__env->startSection('content'); ?>

    <form class="form-horizontal form-material" id="loginform" action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>



        <?php if(session('message')): ?>
            <div class="alert alert-danger m-t-10">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
            <div class="col-xs-12">
                <input class="form-control" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" autofocus required="" placeholder="<?php echo app('translator')->get('app.email'); ?>">
                <?php if($errors->has('email')): ?>
                    <div class="help-block with-errors"><?php echo e($errors->first('email')); ?></div>
                <?php endif; ?>

            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" id="password" type="password" name="password" required="" placeholder="<?php echo app('translator')->get('modules.client.password'); ?>">
                <?php if($errors->has('password')): ?>
                    <div class="help-block with-errors"><?php echo e($errors->first('password')); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php if($global->google_recaptcha_status): ?>
        <div class="form-group <?php echo e($errors->has('g-recaptcha-response') ? 'has-error' : ''); ?>">
            <div class="col-xs-12">
                <div class="g-recaptcha"
                     data-sitekey="<?php echo e($global->google_recaptcha_key); ?>">
                </div>
                <?php if($errors->has('g-recaptcha-response')): ?>
                    <div class="help-block with-errors"><?php echo e($errors->first('g-recaptcha-response')); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="checkbox-signup" class="text-dark"> <?php echo app('translator')->get('app.rememberMe'); ?> </label>
                </div>
                <a href="<?php echo e(route('password.request')); ?>"  class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> <?php echo app('translator')->get('app.forgotPassword'); ?>?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit"><?php echo app('translator')->get('app.login'); ?></button>
            </div>
        </div>
        <div class="row">
            
                <script>
                    var facebook = "<?php echo e(route('social.login', 'facebook')); ?>";
                    var google = "<?php echo e(route('social.login', 'google')); ?>";
                    var twitter = "<?php echo e(route('social.login', 'twitter')); ?>";
                    var linkedin = "<?php echo e(route('social.login', 'linkedin')); ?>";
                </script>
                <?php if(isset($socialAuthSettings) && !module_enabled('Subdomain')): ?>
                    <?php if($socialAuthSettings && $socialAuthSettings->facebook_status == 'enable'): ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 m-t-10 text-center mb-16">
                                <a href="javascript:;" class="btn btn-primary btn-facebook" data-toggle="tooltip" title="<?php echo app('translator')->get('app.loginWithFacebook'); ?>" onclick="window.location.href = facebook;" data-original-title="<?php echo app('translator')->get('app.loginWithFacebook'); ?>"><i aria-hidden="true" class="fa fa-facebook-f"></i>  &nbsp;<?php echo app('translator')->get('app.loginWithFacebook'); ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if($socialAuthSettings->google_status == 'enable'): ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 m-t-10 text-center mb-16">
                                <a href="javascript:;" class="btn btn-primary btn-google" data-toggle="tooltip" title="<?php echo app('translator')->get('app.loginWithGoogle'); ?>" onclick="window.location.href = google;" data-original-title="<?php echo app('translator')->get('app.loginWithGoogle'); ?>"><i aria-hidden="true" class="fa fa-google-plus"></i> &nbsp;<?php echo app('translator')->get('app.loginWithGoogle'); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($socialAuthSettings->twitter_status == 'enable'): ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 m-t-10 text-center mb-16">
                                <a href="javascript:;" class="btn btn-primary btn-twitter" data-toggle="tooltip" title="<?php echo app('translator')->get('app.loginWithTwitter'); ?>" onclick="window.location.href = twitter;" data-original-title="<?php echo app('translator')->get('app.loginWithTwitter'); ?>"><i aria-hidden="true" class="fa fa-twitter"></i> &nbsp;<?php echo app('translator')->get('app.loginWithTwitter'); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($socialAuthSettings->linkedin_status == 'enable'): ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 m-t-10 text-center mb-16">
                                <a href="javascript:;" class="btn btn-primary btn-linkedin" data-toggle="tooltip" title="<?php echo app('translator')->get('app.loginWithLinkedin'); ?>" onclick="window.location.href = linkedin;" data-original-title="<?php echo app('translator')->get('app.loginWithLinkedin'); ?>"><i aria-hidden="true" class="fa fa-linkedin"></i> &nbsp;<?php echo app('translator')->get('app.loginWithLinkedin'); ?></a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            
        </div>
        <?php if(!module_enabled('Subdomain')): ?>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p><?php echo app('translator')->get('messages.dontHaveAccount'); ?> <a href="<?php echo e(route('front.signup.index')); ?>" class="text-primary m-l-5"><b><?php echo app('translator')->get('app.signup'); ?></b></a></p>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p><?php echo app('translator')->get('messages.goToWebsite'); ?> <a href="<?php echo e(route('front.home')); ?>" class="text-primary m-l-5"><b><?php echo app('translator')->get('app.home'); ?></b></a></p>
                </div>
            </div>
        <?php endif; ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\evalupro\resources\views/auth/login.blade.php ENDPATH**/ ?>