

<?php $__env->startSection('content'); ?>
    <h2>Books</h2>

    <form action="<?php echo e(route('books.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="text" name="title" placeholder="Title" value="<?php echo e(old('title')); ?>" required>
        <input type="text" name="isbn" placeholder="ISBN (optional)" value="<?php echo e(old('isbn')); ?>">

        <select name="author_id" required>
            <option value="">-- Select Author --</option>
            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($author->id); ?>" <?php if(old('author_id') == $author->id): echo 'selected'; endif; ?>><?php echo e($author->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <div style="margin: 8px 0;">
            <strong>Categories:</strong>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="margin-right: 10px;">
                    <input type="checkbox" name="category_ids[]" value="<?php echo e($category->id); ?>"
                        <?php if(in_array($category->id, old('category_ids', []))): echo 'checked'; endif; ?>>
                    <?php echo e($category->name); ?>

                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="submit">Add Book</button>
    </form>

    <table>
        <tr><th>#</th><th>Title</th><th>ISBN</th><th>Author</th><th>Categories</th></tr>
        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($book->id); ?></td>
                <td><?php echo e($book->title); ?></td>
                <td><?php echo e($book->isbn); ?></td>
                <td><?php echo e($book->author->name); ?></td>
                <td><?php echo e($book->categories->pluck('name')->join(', ')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5">No books yet.</td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\library-system\resources\views/books/index.blade.php ENDPATH**/ ?>