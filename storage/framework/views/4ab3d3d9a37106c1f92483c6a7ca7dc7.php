<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-md mx-auto py-8">
    <form action="<?php echo e(route('image.store')); ?>" method="POST" class="flex items-center justify-between border border-300" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
    <input type="file" name="image">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2">Submit</button>
</form>
<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <img src="<?php echo e(Storage::disk('s3')->url($image->url)); ?>" alt="Image">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</body>
</html>
<?php /**PATH D:\UdaCoding\CodeDev\Image\uploadGambar\resources\views/image/create.blade.php ENDPATH**/ ?>