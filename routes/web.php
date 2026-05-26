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

use Illuminate\Support\Facades\Artisan;

Route::get('/llenar', function () {
    try {// Ejecutamos el seeder principal (DatabaseSeeder)
        Artisan::call('db:seed', ['--force' => true]);
        
        return "¡Datos de prueba generados con éxito! 🚀 Ya puedes verlos en tu app.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});