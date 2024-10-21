<?php

use App\Http\Controllers;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/posts/datatables', [Controllers\Datatables\PostsDatatablesController::class, 'index'])->name('posts.datatables');
    Route::get('/posts/odd', [Controllers\Datatables\PostsDatatablesController::class, 'odd'])->name('posts.odd');
    Route::get('/posts/even', [Controllers\Datatables\PostsDatatablesController::class, 'even'])->name('posts.even');

    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/new', [PostsController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
