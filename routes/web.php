<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/myblog', [BlogController::class, 'index'])->name('myblog');
    Route::get('/myblog/create', [BlogController::class, 'create'])->name('myblog.create');
    Route::post('/myblog', [BlogController::class, 'store'])->name('myblog.store');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/myblog/{id}/edit', [BlogController::class, 'edit'])->name('myblog.edit');
    Route::put('/myblog/{id}', [BlogController::class, 'update'])->name('myblog.update');
    Route::delete('/myblog/{id}', [BlogController::class, 'destroy'])->name('myblog.destroy');
});

require __DIR__.'/auth.php';
