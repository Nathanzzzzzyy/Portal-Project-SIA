
<?php $__env->startSection('title', 'Administrator Login'); ?>

<?php $__env->startSection('brand'); ?>
    <p class="tag">Administrative Portal</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h2>Administrator Login</h2>
    <p class="sub">Access the admin panel</p>

    <form method="POST" action="<?php echo e(route('admin.login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="field">
            <label>Username or Email</label>
            <input type="text" name="username" value="<?php echo e(old('username')); ?>" placeholder="admin" required autofocus>
            <?php $__errorArgs = ['username'];
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
            <input type="password" name="password" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <label class="check" style="margin-bottom:14px"><input type="checkbox" name="remember"> Remember Me</label>

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
    <p class="foot"><a href="<?php echo e(route('login')); ?>">Back to Portal</a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\natha\uc-portal\resources\views/auth/admin-login.blade.php ENDPATH**/ ?>