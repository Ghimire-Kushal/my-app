<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact Page
Route::view('/contact', 'contact')->name('contact');

// Contact Form Submit (rate limited)
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:3,1');

// Projects (Public)
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
| CUSTOM REGISTER ROUTE (/kushal)
|--------------------------------------------------------------------------
*/

Route::get('/kushal', [RegisteredUserController::class, 'create'])->name('kushal.register');
Route::post('/kushal', [RegisteredUserController::class, 'store'])->name('kushal.store');


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
| Admin Routess
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {


// FIX: direct route instead of redirect
Route::get('/', [AdminController::class, 'index'])->name('dashboard');

// Dashboard (optional duplicate)
Route::get('/dashboard', [AdminController::class, 'index']);

// Projects
Route::get('/projects', [ProjectController::class, 'adminIndex'])->name('projects.index');

Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');


});



/*
|--------------------------------------------------------------------------
| Redirect Public Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('home');
});


/*
|--------------------------------------------------------------------------
| TEMP DB FIX (REMOVE IN PRODUCTION)
|--------------------------------------------------------------------------
*/

Route::get('/fix-db', function () {
    Artisan::call('migrate:fresh --seed --force');
    return 'Database fixed!';
}); 


Route::get('/test-mail', function () {
    Mail::raw('Test Email from Kushal Portfolio', function ($msg) {
        $msg->to('kushal.upr@gmail.com')
            ->subject('TEST');
    });

    return "Mail Sent";
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');

    return "Cache Cleared ✅";
});

require __DIR__.'/auth.php';
