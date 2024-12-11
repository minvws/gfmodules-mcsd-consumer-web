<?php

declare(strict_types=1);

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageSuppliersController;

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

Route::get('/', IndexController::class)->name('index');
Route::post('/update', [UpdateController::class, 'update'])->name('consumer.update');

Route::get('/suppliers', ManageSuppliersController::class)->name('suppliers.index');

Route::get('/suppliers/create', [ManageSuppliersController::class, 'create'])->name('suppliers.create');
Route::post('/suppliers', [ManageSuppliersController::class, 'store'])->name('suppliers.store');

Route::get('/suppliers/{id}', [ManageSuppliersController::class, 'show'])->name('suppliers.show');

Route::get('/suppliers/{id}' . '/edit', [ManageSuppliersController::class, 'edit'])->name('suppliers.edit');
Route::put('/suppliers/{id}', [ManageSuppliersController::class, 'update'])->name('suppliers.update');

Route::get('/suppliers/{id}' . "/delete", [ManageSuppliersController::class, 'destroy'])->name('suppliers.destroy');
