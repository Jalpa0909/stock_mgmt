<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'main'])->name('main');

Route::get('/unit', [App\Http\Controllers\UnitController::class, 'index'])->name('unit.index');
Route::post('/unit/store', [App\Http\Controllers\UnitController::class, 'store'])->name('unit.store');
Route::get('/unit/edit/{id}', [App\Http\Controllers\UnitController::class, 'edit'])->name('unit.edit');
Route::get('/unit/delete/{id}', [UnitController::class, 'destroy'])->name('unit.delete');


Route::get('/colour', [App\Http\Controllers\ColorController::class, 'index'])->name('colour.index');
Route::post('/colour/store', [App\Http\Controllers\ColorController::class, 'store'])->name('colour.store');
Route::get('/colour/edit/{id}', [App\Http\Controllers\ColorController::class, 'edit'])->name('colour.edit');
Route::get('/colour/delete/{id}', [ColorController::class, 'destroy'])->name('colour.delete');

Route::get('/size', [App\Http\Controllers\SizeController::class, 'index'])->name('size.index');
Route::post('/size/store', [App\Http\Controllers\SizeController::class, 'store'])->name('size.store');
Route::get('/size/edit/{id}', [App\Http\Controllers\SizeController::class, 'edit'])->name('size.edit');
Route::get('/size/delete/{id}', [SizeController::class, 'destroy'])->name('size.delete');

Route::get('/brand', [App\Http\Controllers\BrandController::class, 'index'])->name('brand.index');
Route::post('/brand/store', [App\Http\Controllers\BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/edit/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('brand.edit');
Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');



