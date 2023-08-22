<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('image.index', compact('images'));
    }
    public function create()
    {
        $images = Image::all();
        return view('image.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('images', 's3');

        $image = Image::create([
            'filename' => basename($path),
            'url' => Storage::disk('s3')->url($path)
        ]);

        return redirect()->route('image.index')->with('success', 'Image uploaded successfully.');
    }


    public function show(Image $image)
    {
        $imagePath = 'images/' . $image->filename;
        return Storage::disk('s3')->response($imagePath);
    }

    public function destroy(Image $image)
    {
        // Hapus gambar dari penyimpanan S3
        Storage::disk('s3')->delete('images/' . $image->filename);

        // Hapus data gambar dari database
        $image->delete();

        return redirect()->route('image.index')->with('success', 'Image deleted successfully.');
    }
}

  // public function show(Image $image)
    // {
    //     return Storage::disk('s3')->response('images/' . $image->filename);
    // }
