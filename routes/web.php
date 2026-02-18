<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// All Projects
Route::get('/projects', [ProjectController::class, 'index'])
    ->name('projects.index');

// Single Project (Slug Binding)
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])
    ->name('projects.show');
    
Route::get('/download-resume', function () {
    $path = public_path('resume.pdf');
    abort_if(!file_exists($path), 404);
    return response()->download($path, 'Kushal-Ghimire-Resume.pdf');
})->name('resume.download');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('dashboard');

        Route::resource('projects', ProjectController::class)
            ->except(['index', 'show']);

        Route::get('/projects', [ProjectController::class, 'adminIndex'])
            ->name('projects.index');
    });

require __DIR__.'/auth.php';