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

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

// Resume Download
Route::get('/download-resume', function () {
    $path = public_path('resume.pdf');
    abort_if(!file_exists($path), 404);

    return response()->download($path, 'Kushal-Ghimire-Resume.pdf');
})->name('resume.download');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Admin Projects
        Route::get('/projects', [ProjectController::class, 'adminIndex'])->name('projects.index');

        // CRUD
        Route::resource('projects', ProjectController::class)
            ->except(['index', 'show']);
    });


/*
|--------------------------------------------------------------------------
| Redirect public /dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('home');
});


/*
|--------------------------------------------------------------------------
| TEMP: Fix DB Route (REMOVE AFTER USE)
|--------------------------------------------------------------------------
*/

Route::get('/fix-db', function () {
    Artisan::call('migrate:fresh --seed --force');
    return 'Database fixed!';
});


/*
|--------------------------------------------------------------------------
| Auth Routes (IMPORTANT)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';