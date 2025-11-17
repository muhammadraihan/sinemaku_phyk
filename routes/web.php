<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PsikotesController;

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

// Route::get('/', function () {
//     return view('welcome');
//     Route::get('/', [PsikotesController::class, 'index'])->name('home');
//     Route::post('/answer', [PsikotesController::class, 'store'])->name('store.answer');
//     Route::get('/result', [PsikotesController::class, 'result'])->name('result');
// });

Route::get('/', [PsikotesController::class, 'index'])->name('home');
Route::view('/form', 'form')->name('form');
Route::get('/questions', [PsikotesController::class, 'questions'])->name('quiz.start');
Route::post('/answer', [PsikotesController::class, 'store'])->name('store.answer');
Route::post('/form', [PsikotesController::class, 'store_form'])->name('store.form');
Route::get('/result', [PsikotesController::class, 'result'])->name('result');
Route::post('/share/video', [PsikotesController::class, 'video'])
    ->name('share.video');