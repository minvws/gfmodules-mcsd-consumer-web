<?php

declare(strict_types=1);

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapperController;
use App\Http\Controllers\ConsumerController;

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
Route::get('/update', [UpdateController::class, 'update'])->name('consumer.update');

Route::get('/mapper', [MapperController::class, 'index'])->name('resource.mapper');

Route::get('/consumer', [ConsumerController::class, 'index'])->name('consumer.index');
Route::get('/consumer-view', [ConsumerController::class, 'getResource'])->name('consumer.getResource');
