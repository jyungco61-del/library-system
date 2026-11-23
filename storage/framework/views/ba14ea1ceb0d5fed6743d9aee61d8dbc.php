

<?php $__env->startSection('content'); ?>
    <h2>Library Cards</h2>

    <form action="<?php echo e(route('library-cards.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <select name="member_id" required>
            <option value="">-- Select Member --</option>
            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($member->id); ?>" <?php if(old('member_id') == $member->id): echo 'selected'; endif; ?>><?php echo e($member->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="text" name="card_number" placeholder="Card number" value="<?php echo e(old('card_number')); ?>" required>
        <input type="date" name="issued_date" value="<?php echo e(old('issued_date', date('Y-m-d'))); ?>" required>
        <button type="submit">Add Card</button>
    </form>

    <table>
        <tr><th>#</th><th>Member</th><th>Card Number</th><th>Issued Date</th></tr>
        <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($card->id); ?></td>
                <td><?php echo e($card->member->name); ?></td>
                <td><?php echo e($card->card_number); ?></td>
                <td><?php echo e($card->issued_date); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">No library cards yet.</td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\library-system\resources\views/library-cards/index.blade.php ENDPATH**/ ?>