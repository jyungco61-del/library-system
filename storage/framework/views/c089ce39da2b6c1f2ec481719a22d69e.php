<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        nav { background: #2c3e50; padding: 12px 24px; }
        nav a { color: #fff; margin-right: 16px; text-decoration: none; }
        .container { max-width: 900px; margin: 24px auto; background: #fff; padding: 24px; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #ecf0f1; }
        input, select { padding: 6px; margin: 4px 8px 4px 0; }
        button { padding: 7px 16px; background: #2c3e50; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .success { background: #d4edda; padding: 10px; margin-bottom: 12px; border-radius: 4px; }
        .error { background: #f8d7da; padding: 10px; margin-bottom: 12px; border-radius: 4px; }
    </style>
</head>
<body>
    <nav>
        <a href="<?php echo e(route('books.index')); ?>">Books</a>
        <a href="<?php echo e(route('authors.index')); ?>">Authors</a>
        <a href="<?php echo e(route('categories.index')); ?>">Categories</a>
        <a href="<?php echo e(route('members.index')); ?>">Members</a>
        <a href="<?php echo e(route('library-cards.index')); ?>">Library Cards</a>
    </nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="error">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH C:\Users\Vash Dave Jumanguin\library-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>