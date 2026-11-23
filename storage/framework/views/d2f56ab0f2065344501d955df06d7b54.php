

<?php $__env->startSection('content'); ?>
    <h2>Authors</h2>

    <form action="<?php echo e(route('authors.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" placeholder="Author name" value="<?php echo e(old('name')); ?>" required>
        <button type="submit">Add Author</button>
    </form>

    <table>
        <tr><th>#</th><th>Name</th><th>Number of Books</th></tr>
        <?php $__empty_1 = true; $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($author->id); ?></td>
                <td><?php echo e($author->name); ?></td>
                <td><?php echo e($author->books_count); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="3">No authors yet.</td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\library-system\resources\views/authors/index.blade.php ENDPATH**/ ?>