<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return redirect('/petani');});
// Route::get('/petani/login', LoginPetani::class)->name('filament.petani.auth.login');