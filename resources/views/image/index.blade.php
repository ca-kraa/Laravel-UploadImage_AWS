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
        <form action="{{ route('image.store') }}" method="POST" class="flex items-center justify-between border border-300" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image_path" required>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Upload Image</button>
        </form>
        <table class="table-auto mt-4 mx-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Display</th>
                    <th class="px-4 py-2">Filename</th>
                    <th class="px-4 py-2">URL</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($images as $image)
                    <tr>
                        <td class="border px-4 py-2">{{ $no++ }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ $image->url }}" alt="Foto Siswa" width="50px" class="rounded">
                        </td>
                        <td class="border px-4 py-2">{{ $image->filename }}</td>
                        <td class="border px-4 py-2"><a href="{{ $image->url }}" target="_blank">View Image</a></td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('image.destroy', $image) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
