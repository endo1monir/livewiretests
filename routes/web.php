<?php

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
//    return view('welcome');
    return view('examples',['posts'=>\App\Models\Post::all()]);
});
Route::get('/post/{post}',[\App\Http\Controllers\PostController::class,'show'])->name('posts.show');
Route::get('/posts/{post}/edit',[\App\Http\Controllers\PostController::class,'edit'])->name('posts.edit');
Route::patch('posts/{post}',[\App\Http\Controllers\PostController::class,'update'])->name('posts.update');
Route::post('/comments/post/{post}',[\App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
