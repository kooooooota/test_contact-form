<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CsvDownloadController;

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
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
// Route::get('/admin', [AuthController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
});
Route::get('/search', [AdminController::class, 'search']);
Route::delete('/delete', [AdminController::class, 'destroy']);
Route::get('/csv-download', [CsvDownloadController::class, 'downloadCsv']);
