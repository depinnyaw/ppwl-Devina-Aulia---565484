<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\SkillController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/experience', 'experience')->name('experience');
Route::view('/education', 'education')->name('education');

Route::get('/projects/{slug}', [ProjectController::class, 'publicShow'])
    ->name('projects.public.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Pengelolaan project hanya bisa diakses oleh admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/post/dashboard', [DashboardController::class, 'index'])
        ->name('post.dashboard');

    Route::resource('/post/skills', SkillController::class);

    Route::post('/post/projects/{project}/gallery', [ProjectGalleryController::class, 'store'])
        ->name('projects.gallery.store');

    Route::delete('/post/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'destroy'])
        ->name('projects.gallery.destroy');

    Route::put('/post/projects/{project}/gallery/{image}/caption', [ProjectGalleryController::class, 'updateCaption'])
        ->name('projects.gallery.updateCaption');

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
