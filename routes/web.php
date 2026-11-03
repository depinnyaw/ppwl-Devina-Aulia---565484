<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Pengelolaan project hanya bisa diakses oleh admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/post/projects/trash', [ProjectController::class, 'trash'])
        ->name('projects.trash');

    Route::patch('/post/projects/{id}/restore', [ProjectController::class, 'restore'])
        ->name('projects.restore');

    Route::delete('/post/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])
        ->name('projects.forceDelete');

    Route::resource('/post/projects', ProjectController::class);
});

// Profil dan halaman Profil Saya bisa diakses semua pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/post/profile-saya', [ProfileController::class, 'profileSaya'])
        ->name('profile.saya');
});

require __DIR__.'/auth.php';
