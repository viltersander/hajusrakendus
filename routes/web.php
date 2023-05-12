<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherApiController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CartAddController;
use App\Http\Controllers\CartRemoveController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Client;
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
    return Inertia::render('Index', [
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

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart-add', CartAddController::class)->name('cart.add');
Route::post('/cart-remove', CartRemoveController::class)->name('cart.remove');
Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])->name('shopping-cart.index');


Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('verified');

// blog
// Route::get('/', [BlogController::class, 'index'])->name('blog.index');


// api
Route::get('/films', [FilmController::class, 'index'])->name('index');
Route::get('/dogs', [StudentController::class, 'index']);
Route::get('/api/films', [FilmController::class, 'index'])->name('index');
Route::get('/api/dogs', function () {
    $client = new Client();
    $response = $client->get('https://hajusrakendused.deno.dev/api/dogs');
    return $response->getBody();
});

require __DIR__.'/auth.php';
