<?php

use App\Http\Controllers\IndexCkeditorController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('test', [IndexController::class, 'index'])->name('test');

Route::post('create', [IndexController::class, 'create'])->name('create');

Route::get('view/{id}', [IndexController::class, 'view'])->name('view');

Route::post('update', [IndexController::class, 'update'])->name('update');

Route::get('/model/{id}', [IndexController::class, 'model'])->name('model');

Route::get('/create-model', [IndexController::class, 'createModel'])->name('create-model');

Route::get('/custom-model', [IndexController::class, 'generateModel'])->name('custom-model');

Route::get('sql/{script}/{parameter}', [IndexController::class, 'sqlToResultModel'])->name('sql');

Route::get('tiny-pdf', [IndexController::class, 'toPdf'])->name('tiny-pdf');

Route::get('download', [IndexController::class, 'downloadPdf'])->name('download');



/**
 * *****CK EDITOR
 */
Route::get('ckeditor', [IndexCkeditorController::class, 'index'])->name('ckeditor');