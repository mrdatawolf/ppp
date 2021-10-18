<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route for view/blade file.
Route::middleware(['auth:sanctum', 'verified'])->get('importExportView', [ExcelController::class, 'importExportView'])->name('importExportView');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::middleware(['auth:sanctum', 'verified'])->get('exportExcel/{type}', [ExcelController::class, 'exportExcel'])->name('exportExcel');
// Route for import excel data to database.
Route::middleware(['auth:sanctum', 'verified'])->post('importExcel', [ExcelController::class, 'importExcel'])->name('importExcel');
Route::middleware(['auth:sanctum', 'verified'])->resource('vendors', \App\Http\Controllers\VendorCRUDController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('colors', \App\Http\Controllers\ColorCRUDController::class);
