<?php
// web.php

use Illuminate\Support\Facades\Route; // Importa la clase Route. La clase Route es la clase principal de Laravel para definir rutas.
use App\Http\Controllers\ProfileController; // Importa el controlador ProfileController
use App\Http\Controllers\ArticuloController; // Importa el controlador ArticuloController
use App\Http\Controllers\DashboardController; // Importa el controlador DashboardController
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Página principal
Route::get('/', function () { // Define una ruta GET a la raíz de la aplicación.
    $articulos = App\Models\Articulo::paginate(5);  // Obtiene los artículos de la base de datos y los pagina. Obtiene los artículos en grupos de 5 a la vez.
    return view('welcome', compact('articulos')); // Devuelve la vista welcome.blade.php con los artículos paginados.
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']) // Define una ruta GET a /dashboard que llama al método index del controlador DashboardController. 
//El usuario visita esa url, laravel ejecutará el método index del controlador DashboardController.
    ->middleware(['auth', 'verified']) 
    // Middleware para autenticación y verificación de correo electrónico. El middleware 'auth' verifica si el usuario está autenticado. 
    // Sino esta autenticado le dirigirá a la página de inicio. 
    // El middleware 'verified' verifica si el usuario ha verificado su dirección de correo electrónico. 
    //Si no lo ha hecho, lo redirigirá a la página de verificación de correo electrónico.
    ->name('dashboard'); // Nombre de la ruta.

// Perfil del usuario
Route::middleware('auth')->group(function () { // Agrupa las rutas que requieren autenticación.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Ruta GET a /profile que llama al método edit del controlador ProfileController. El usuario visita esa url, laravel ejecutará el método edit del controlador ProfileController.
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Ruta PATCH a /profile que llama al método update del controlador ProfileController. El usuario visita esa url, laravel ejecutará el método update del controlador ProfileController.
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Ruta DELETE a /profile que llama al método destroy del controlador ProfileController. El usuario visita esa url, laravel ejecutará el método destroy del controlador ProfileController.
});

// Rutas de recursos para ArticuloController
Route::resource('articulos', ArticuloController::class)->middleware('auth'); // Define las rutas de recursos para el controlador ArticuloController. El middleware 'auth' verifica si el usuario está autenticado. Si no lo está, lo redirigirá a la página de inicio.
// Usa CRUD para crear, leer, actualizar y eliminar artículos.

// Auth routes
require __DIR__.'/auth.php'; // Incluye las rutas de autenticación.


?>
