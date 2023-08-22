<?php

use App\Http\Controllers\FileUploaderController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/upload', [FileUploaderController::class, 'showUploadForm'])->name('image.upload');
// Route::post('/upload', [FileUploaderController::class, 'storeImage'])->name('image.store');
// Route::delete('/images/{imagePath}', [FileUploaderController::class, 'destroy'])->name('images.destroy');
Route::get('/upload', [FileUploaderController::class, 'showUploadForm'])->name('file.upload.form');
Route::post('/upload', FileUploaderController::class)->name('file.upload');
Route::get('/upload', [FileUploaderController::class, 'index'])->name('images.index');
Route::delete('/upload/{imagePath}', [FileUploaderController::class, 'destroy'])->name('images.destroy');
// Route::get('/', [ImageController::class, 'index']);
// Route::get('/', [ImageController::class, 'create']);
// Route::post('/', [ImageController::class, 'store']);
// Route::get('/{image}', [ImageController::class, 'show']);


Route::get('/images', [ImageController::class, 'index'])->name('image.index');
Route::post('/images', [ImageController::class, 'store'])->name('image.store');
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('image.destroy');
