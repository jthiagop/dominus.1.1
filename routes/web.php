<?php

use App\Http\Controllers\Admin\MatrizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('matriz', [MatrizController::class, 'store'])->name('matriz.store');
    Route::get('/matriz/list', [MatrizController::class, 'list'])->name('matriz.list');
    Route::get('/matriz/create', [MatrizController::class, 'create'])->name('matriz.create');
    Route::get('/matriz', [MatrizController::class, 'index'])->name('matriz.index');
});
