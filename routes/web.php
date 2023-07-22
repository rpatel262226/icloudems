<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvImport;
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

// Route::get('/', function () {
//     //return view('welcome');
// });

Route::get('/', [CsvImport::class, 'index']);
Route::post('/store', [CsvImport::class, 'store'])->name('csvimport.store');
