<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherApiController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\BlogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/weather', [WeatherApiController::class, 'index']);
Route::get('/map', [MapController::class, 'index']);
Route::get('/markers', [MarkerController::class, 'index'])->name('markers.index');
Route::post('/markers', [MarkerController::class, 'store'])->name('markers.store');
Route::put('/markers/{marker}', [MarkerController::class, 'update'])->name('markers.update');
Route::delete('/markers/{marker}', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

require __DIR__.'/auth.php';
