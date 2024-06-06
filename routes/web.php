<?php

use App\Http\Controllers\Admin\AdminAdministradorController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminMedicosController;
use App\Http\Controllers\Admin\AdminPacientesController;
use App\Http\Controllers\Admin\AdminPerfilController;
use App\Http\Controllers\Admin\AdminRecepcionistasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/**
 * Routa para o template da Loja
 */
Route::get('/', [AdminLoginController::class, 'index'])->name('login');
/**
 * Routa para o Painel do admin
*/
Route::prefix('sgmh/painel')->middleware(['auth', 'Admin'])->group(function(){

    //Home
    Route::get('/home', [AdminHomeController::class, 'index'])->name('painel.admin');
    //------------------------------------------------------------

    //administradores
    Route::get('/administradores', [AdminAdministradorController::class, 'index'])->name('painel.administradores');
    Route::post('/administradores_store', [AdminAdministradorController::class, 'store'])->name('admin.registro');
    Route::get('/administradores/delete/{id}', [AdminAdministradorController::class, 'delete'])->name('admin.delete');
    Route::get('/administradores/edit/{id}', [AdminAdministradorController::class, 'edit'])->name('admin.edit');
    Route::post('/administradores/update/{id}', [AdminAdministradorController::class, 'update'])->name('admin.update');
    Route::get('/administradores/show/{id}', [AdminAdministradorController::class, 'show'])->name('admin.show');
    Route::get('/administradores/estado/{id}/{estado}', [AdminAdministradorController::class, 'estado'])->name('admin.estado');
    //------------------------------------------------------------

    //médicos
    Route::get('/medicos', [AdminMedicosController::class, 'index'])->name('painel.medicos');
    Route::post('/medicos/store', [AdminMedicosController::class, 'store'])->name('medicos.registro');
    Route::get('/medicos/delete/{id}/{idusuario}', [AdminMedicosController::class, 'delete'])->name('medico.delete');
    Route::get('/medicos/edit/{id}', [AdminMedicosController::class, 'edit'])->name('medicos.edit');
    Route::post('/medicos/update/{id}/{idusuario}', [AdminMedicosController::class, 'update'])->name('medicos.update');
    Route::get('/medicos/show/{id}', [AdminMedicosController::class, 'show'])->name('medicos.show');
    Route::get('/medicos/estado/{id}/{estado}', [AdminMedicosController::class, 'estado'])->name('medicos.estado');
    //------------------------------------------------------------

    //recepcionistas
    Route::get('/recepcionistas', [AdminRecepcionistasController::class, 'index'])->name('painel.recepcionistas');
    Route::post('/recepcionistas/store', [AdminRecepcionistasController::class, 'store'])->name('recepcionistas.registro');
    Route::get('/recepcionistas/delete/{id}', [AdminRecepcionistasController::class, 'delete'])->name('recepcionistas.delete');
    Route::get('/recepcionistas/edit/{id}', [AdminRecepcionistasController::class, 'edit'])->name('recepcionistas.edit');
    Route::post('/recepcionistas/update/{id}/{idusuario}', [AdminRecepcionistasController::class, 'update'])->name('recepcionistas.update');
    Route::get('/recepcionistas/show/{id}', [AdminRecepcionistasController::class, 'show'])->name('recepcionistas.show');
    Route::get('/recepcionistas/estado/{id}/{estado}', [AdminRecepcionistasController::class, 'estado'])->name('recepcionistas.estado');
    //------------------------------------------------------------

    //pacientes
    Route::get('/maternidade/pacientes', [AdminPacientesController::class, 'index'])->name('painel.pacientes');
    Route::post('/maternidade/pacientes/store', [AdminPacientesController::class, 'store'])->name('pacientes.registro');
    Route::get('/maternidade/pacientes/delete/{id}', [AdminPacientesController::class, 'delete'])->name('pacientes.delete');
    Route::get('/maternidade/pacientes/edit/{id}', [AdminPacientesController::class, 'edit'])->name('pacientes.edit');
    Route::post('/maternidade/pacientes/update/{id}', [AdminPacientesController::class, 'update'])->name('pacientes.update');
    Route::get('/maternidade/pacientes/show/{id}', [AdminPacientesController::class, 'show'])->name('pacientes.show');
    Route::get('/maternidade/pacientes/estado/{id}/{estado}', [AdminPacientesController::class, 'estado'])->name('pacientes.estado');
    //------------------------------------------------------------

    //Perfil
    Route::get('/perfil', [AdminPerfilController::class, 'index'])->name('painel.perfil');
    Route::get('/perfil/update/{id}', [AdminPerfilController::class, 'update'])->name('perfil.update');
    //------------------------------------------------------------

});

Auth::routes();

