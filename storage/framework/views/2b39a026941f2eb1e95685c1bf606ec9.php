

<?php $__env->startSection('content'); ?>
    <h2>Members</h2>

    <form action="<?php echo e(route('members.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" placeholder="Full name" value="<?php echo e(old('name')); ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
        <button type="submit">Add Member</button>
    </form>

    <table>
        <tr><th>#</th><th>Name</th><th>Email</th><th>Library Card</th></tr>
        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($member->id); ?></td>
                <td><?php echo e($member->name); ?></td>
                <td><?php echo e($member->email); ?></td>
                <td><?php echo e($member->libraryCard->card_number ?? 'No card yet'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">No members yet.</td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\library-system\resources\views/members/index.blade.php ENDPATH**/ ?>