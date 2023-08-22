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
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Upload Image
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="image" name="image" type="file" accept="image/*" required>
                <p class="text-red-500 text-xs italic hidden" id="error">Please choose an image less than 5MB.</p>
            </div>
            <div class="mb-6">
                <img id="preview" src="" alt="" class="hidden w-full h-64 rounded object-cover mt-2">
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-check mr-2"></i> Submit
            </button>
        </form>

        <h2>Uploaded Images</h2>
        <ul>
            @foreach($images as $image)
                <li><a href="{{ Storage::disk('s3')->url($image) }}">{{ $image }}</a></li>
            @endforeach
        </ul>

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
