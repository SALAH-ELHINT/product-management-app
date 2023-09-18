<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product/{id}', [productController::class, 'show'])->name('product.show');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('/AboutMe', function () {
    return Inertia::render('AboutMe');
})->name('AboutMe');