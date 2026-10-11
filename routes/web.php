<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;

Route::get('/', function () {return redirect('/petani');});
Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
Route::post('/diagnosa/proses', [DiagnosaController::class, 'proses'])->name('diagnosa.proses');
Route::get('/diagnosa/hasil', [DiagnosaController::class, 'hasil'])->name('diagnosa.result');