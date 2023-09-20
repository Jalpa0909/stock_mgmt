<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;

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
    return view('Auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\UnitController::class, 'index'])->name('unit.index');
Route::post('/store', [App\Http\Controllers\UnitController::class, 'store'])->name('unit.store');
Route::get('unit/edit/{id}', [App\Http\Controllers\UnitController::class, 'edit'])->name('unit.edit');
