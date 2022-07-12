<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index'])->name("index");
Route::get('/vehiculos',[VehicleController::class, 'vehicles'])->name("vehicles");
Route::get('/vehiculos/crear',[VehicleController::class, 'create'])->name("vehicles_create");
Route::post('/vehiculos/save',[VehicleController::class, 'save'])->name("vehicles_save");

Route::get('/vehiculos/editar/{id}', [VehicleController::class, 'edit'])->name('vehicles_edit');
Route::post('/vehiculos/updated/{id}', [VehicleController::class, 'updated'])->name('vehicles_updated');
Route::delete('/vehiculos/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicles_delete');
