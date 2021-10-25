<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Auth;
// use Response;

use App\Models\Post;
use App\Models\Comment;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $posts = Post::with(['comments','user'])->orderBy('created_at','desc')->get();

    // dd($posts);

    return view('dashboard',compact('posts'));
})->name('dashboard');

// post
Route::middleware(['auth:sanctum', 'verified'])->get('/post',[PostController::class, 'index'])->name('post.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/post/add',[PostController::class, 'getAdd'])->name('post.add');
Route::middleware(['auth:sanctum', 'verified'])->post('/post/add',[PostController::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/post/edit/{id}',[PostController::class, 'getEdit'])->name('post.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/post/edit/{id}',[PostController::class, 'edit']);

Route::middleware(['auth:sanctum', 'verified'])->post('/post/delete',[PostController::class, 'delete'])->name('post.delete');

Route::get('/post/detail/{id}',[PostController::class, 'detail'])->name('post.detail');

// user
Route::middleware(['auth:sanctum', 'verified'])->get('/user',[UserController::class, 'index'])->name('user.index');

// comment
Route::middleware(['auth:sanctum', 'verified'])->post('/comment/add',[CommentController::class, 'add'])->name('comment.add');
