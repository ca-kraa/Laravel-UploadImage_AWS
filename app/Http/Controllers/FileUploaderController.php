<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileUploaderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'image' => 'required|file'
        ]);
        $file = $request->file('image');

        $path = Storage::putFile('image', $file);
        Storage::setVisibility($path, 'public');

        $url = Storage::url($path);

        // return response()->json([
        //     'data' => $path,
        //     'url' => $url
        // ]);
        return redirect()->route('file.upload')->with('success', 'Image uploaded successfully');
    }

    public function index()
    {
        $images = Storage::disk('s3')->files('images');
        $images = array_map(function ($image) {
            return str_replace('images/', '', $image);
        }, $images);
        return view('images.upload', compact('images'));
    }

    public function destroy($imagePath)
    {
        Storage::disk('s3')->delete($imagePath);
        return redirect()->route('images.upload')->with('success', 'Image deleted successfully');
    }
}
