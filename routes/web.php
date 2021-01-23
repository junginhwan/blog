<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoItemController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->prefix('/todo')->name('todo.')->group(function() {
    Route::get('/', [TodoItemController::class, 'index'])->name('index');
    Route::post('/', [TodoItemController::class, 'store'])->name('store');
    Route::put('/', [TodoItemController::class, 'update'])->name('update');
    Route::delete('/{id}', [TodoItemController::class, 'destroy'])->name('delete');
});
