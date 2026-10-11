<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {return redirect('/petani');});
Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
Route::post('/diagnosa/proses', [DiagnosaController::class, 'proses'])->name('diagnosa.proses');
Route::get('/diagnosa/hasil', [DiagnosaController::class, 'hasil'])->name('diagnosa.result');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// Route::get('/', function () {return view('dashboard');})->name('dashboard');