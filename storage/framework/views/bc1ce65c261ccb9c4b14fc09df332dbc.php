
<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('brand'); ?>
    <p class="tag">Building Lives, Shaping the Future</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h2>Welcome Back!</h2>
    <p class="sub">Log in to your University Portal</p>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="field">
            <label>Email or Student Number</label>
            <input type="text" name="login" value="<?php echo e(old('login')); ?>" placeholder="nathanmabag@uc.edu.ph or 2026-0000" required autofocus>
            <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="between">
            <label class="check"><input type="checkbox" name="remember"> Remember Me</label>
            <a href="#" onclick="alert('Please contact the Registrar or an administrator to reset your password.');return false">Forgot Password?</a>
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

        <button class="btn block" type="submit">Login</button>
    </form>

    <p class="foot">Don't have an account? <a href="<?php echo e(route('register')); ?>"><b>Register here</b></a><br>
        <a href="<?php echo e(route('admin.login')); ?>" style="font-size:12px">Administrator login</a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\natha\uc-portal\resources\views/auth/login.blade.php ENDPATH**/ ?>