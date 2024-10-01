<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/print-exercises', [MainController::class, 'print'])->name('print');
Route::post('/generate', [MainController::class, 'generate'])->name('generate');
