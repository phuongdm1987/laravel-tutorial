<?php
declare(strict_types=1);

use App\Http\Controllers\CategoryController;
//use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
//use App\Http\Controllers\Auth\PostController as AuthPostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::prefix('categories')->group(function () {
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::prefix('tags')->group(function () {
    Route::get('/{tag}', [TagController::class, 'show'])->name('tags.show');
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});

//Route::middleware('auth')->prefix('auth')->group(function () {
//    Route::prefix('posts')->group(function () {
//        Route::get('/', [AuthPostController::class, 'index'])->name('auth.posts.index');
//        Route::get('/create', [AuthPostController::class, 'create'])->name('auth.posts.create');
//        Route::post('/', [AuthPostController::class, 'store'])->name('auth.posts.store');
//        Route::get('/{post}/edit', [AuthPostController::class, 'edit'])->name('auth.posts.edit');
//        Route::match(['put', 'patch'], '/{post}', [AuthPostController::class, 'update'])->name('auth.posts.update');
//        Route::delete('/{post}', [AuthPostController::class, 'destroy'])->name('auth.posts.destroy');
//    });
//});
//
//Route::prefix('comments')->middleware('auth')->group(function () {
//    Route::post('/', [CommentController::class, 'store'])->name('comments.store');
//});
