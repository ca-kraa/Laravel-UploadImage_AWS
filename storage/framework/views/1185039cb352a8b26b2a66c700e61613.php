<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-white">
    <div class="w-full max-w-3xl mx-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="<?php echo e(route('image.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Upload Image
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="image" name="image" type="file" accept="image/*">
                <p class="text-red-500 text-xs italic hidden" id="error">Please choose an image less than 5MB.</p>
            </div>
            <div class="mb-6">
                <img id="preview" src="" alt="" class="hidden w-full h-64 rounded object-cover mt-2">
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-check mr-2"></i> Submit
            </button>
        </form>

        <table class="border-collapse w-full mt-4">
            <thead>
                <tr>
                    <th class="border border-gray-600 px-4 py-2">#</th>
                    <th class="border border-gray-600 px-4 py-2">Image</th>
                    <th class="border border-gray-600 px-4 py-2 center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                            <img src="<?php echo e(Storage::disk('s3')->url($image->image_path)); ?>" alt="Image <?php echo e($loop->iteration); ?>" class="w-20 h-20 object-cover">
                        </td>
                        <td>
                            <form action="<?php echo e(route('images.destroy', $image)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-delete text-red-600 hover:text-red-800 rounded px-2 py-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.size < 5 * 1024 * 1024) {
                document.getElementById('error').classList.add('hidden');
                document.getElementById('preview').classList.remove('hidden');
                document.getElementById('preview').src = URL.createObjectURL(file);
            } else {
                document.getElementById('error').classList.remove('hidden');
                document.getElementById('preview').classList.add('hidden');
            }
        });
    </script>
</body>
</html>
<?php /**PATH D:\UdaCoding\CodeDev\Image\uploadGambar\resources\views/welcome.blade.php ENDPATH**/ ?>