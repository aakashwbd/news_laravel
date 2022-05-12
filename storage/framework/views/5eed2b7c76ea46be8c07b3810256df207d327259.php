<?php $__env->startSection('content'); ?>
    <div class="row login-content justify-content-center">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 col-12 offset-lg-3">
                    <div class="card p-5">
                        <div class="card-body">
                            <?php if(session()->has('message')): ?>
                                <div class="alert alert-danger text-center">
                                    <p class="mb-0"><?php echo e(session('message')); ?></p>
                                </div>
                            <?php endif; ?>

                            <center>
                                <h4>Log In</h4>
                                <span>Log in to your account to continue</span>
                            </center>
                            <div class="login-submit-form">
                                <form method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group mb-3">
                                        <label class="my-2" for="">Email</label>
                                        <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <!-- <i class="bi bi-person-circle"></i> -->
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                            <input id="email" type="email"
                                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                                   value="<?php echo e(old('email')); ?>" placeholder="Type your email" required
                                                   autocomplete="email">
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="my-2" for="">Password</label>
                                        <div class="input-group">
                                        <span class="input-group-text" id="basic-addon">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                            <input id="password" type="password"
                                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                                   placeholder="Type your password" required autocomplete="current-password">

                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(url('forgotpassword')); ?>" style="float: right;color:rgb(167, 167, 167);padding:5px 0px;">Forgot Password ? </a>
                                    <div class="form-group text-right">
                                        <button type="submit" class="form-control btn btn-danger mb-3 ">Log in</button>
                                    </div>
                                </form>
                            </div>
                            <center>
                                <span>© 2021 All Rights Reserved. ProjectX</span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/auth/login.blade.php ENDPATH**/ ?>