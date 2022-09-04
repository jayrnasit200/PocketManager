<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books', [App\Http\Controllers\HomeController::class, 'books'])->name('books');
Route::get('/book', [App\Http\Controllers\HomeController::class, 'book']);
Route::get('/createbook', [App\Http\Controllers\HomeController::class, 'createbook']);
Route::post('/createbook', [App\Http\Controllers\HomeController::class, 'createbookpost']);
Route::get('/book_emi_update/{emi}/{book}/{amunt}', [App\Http\Controllers\HomeController::class, 'book_emi_update']);

Route::get('/account', [App\Http\Controllers\HomeController::class, 'account']);
Route::get('/update_fund/{amunt}/{type}', [App\Http\Controllers\HomeController::class, 'update_fund']);


