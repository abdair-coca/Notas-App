<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/notas')->name('home');

use App\Http\Controllers\NotaController;

Route::resource('notas', NotaController::class);

Route::patch(
    '/notas/{nota}/toggle-fijada',
    [NotaController::class, 'toggleFijada']
)->name('notas.toggleFijada');

Route::get(
    '/notas/categoria/{categoria}',
    [NotaController::class, 'categoria']
)->name('notas.categoria');
