
<?php $__env->startSection('title', 'Create Account'); ?>

<?php $__env->startSection('brand'); ?>
    <p class="tag">Join the UC Community</p>
    <p style="text-transform:none;letter-spacing:0;color:#e9f3ec;margin-top:8px">Create your account to access your academic journey.</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h2>Create Account</h2>
    <p class="sub">We'll email you a link to verify your address.</p>

    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <div class="field">
            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter your full name" required autofocus>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="field">
            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter your email" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="row">
            <div class="field">
                <label>Student Number</label>
                <input type="text" value="Auto-generated" disabled style="background:#f1f5f2;color:#6b7a72">
            </div>
            <div class="field">
                <label>Course</label>
                <select name="course" required>
                    <option value="">Select...</option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c); ?>" <?php if(old('course') === $c): echo 'selected'; endif; ?>><?php echo e($c); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min. 8 chars, letters + numbers" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            </div>
        </div>

        <?php if(config('recaptcha.enabled')): ?>
            <div class="captcha"><div class="g-recaptcha" data-sitekey="<?php echo e(config('recaptcha.site_key')); ?>"></div></div>
            <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err" style="text-align:center"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php endif; ?>

        <button class="btn block" type="submit">Register</button>
    </form>

    <p class="foot">Already have an account? <a href="<?php echo e(route('login')); ?>"><b>Login here</b></a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\natha\uc-portal\resources\views/auth/register.blade.php ENDPATH**/ ?>