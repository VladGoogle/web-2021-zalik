<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/store', [PersonController::class, 'store'])->name('persons.store');
Route::put('/update', [PersonController::class, 'update'])->name('persons.update');
Route::get('/show', [PersonController::class, 'show'])->name('persons.show');
