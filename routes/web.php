<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact
Route::view('/contact', 'contact')->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:3,1');

// Projects (USE SLUG)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

// Resume
Route::get('/download-resume', function () {
    $path = public_path('resume.pdf');
    abort_if(!file_exists($path), 404);
    return response()->download($path, 'Kushal-Ghimire-Resume.pdf');
})->name('resume.download');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Admin Routes (USE ID)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // List
        Route::get('/projects', [ProjectController::class, 'adminIndex'])->name('projects.index');

        // Create
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

        // Edit (ID)
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

        // Delete
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });


/*
|--------------------------------------------------------------------------
| Redirect dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', fn () => redirect()->route('home'));


/*
|--------------------------------------------------------------------------
| TEMP DB FIX (optional)
|--------------------------------------------------------------------------
*/

Route::get('/fix-db', function () {
    Artisan::call('migrate:fresh --seed --force');
    return 'Database fixed!';
});


require __DIR__.'/auth.php';