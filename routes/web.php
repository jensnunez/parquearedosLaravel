<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ReportarController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
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

Route::get('/admin2', function () {
	
    return view('admin');
})->middleware('auth')->name('admin2');

Route::get('/welcome', function () {
	
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/dash', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('dash');

//Route Hooks - Do not delete//
	Route::view('vehiculos', 'livewire.vehiculos.index')->middleware(['auth','student'])->name('vehiculos');
	Route::view('periodos', 'livewire.periodos.index')->middleware(['auth','student'])->name('periodos');
	Route::view('tipo_vehiculos', 'livewire.tipo-vehiculos.index')->middleware(['auth','student'])->name('tipo_vehiculos');
	Route::view('tipo_reportes', 'livewire.tipo-reportes.index')->middleware(['auth','student'])->name('tipo_reportes');
	Route::view('sedes', 'livewire.sedes.index')->middleware(['auth','student'])->name('sedes');
    Route::view('admin', 'livewire.admin.index')->middleware(['auth','admin'])->name('admin');
	//Route::view('reportar', 'livewire.reportes.index')->middleware(['auth','student'])->name('reportar');
	Route::resource('reportar',ReportarController::class)->only([
		'index', 'store'
	])->middleware(['auth','student'])->names([
		'reportar' => 'reportar.index'
	]);
	
	Route::get('asignar/{placa}', [App\Http\Controllers\AsignarVehiculoController::class, 'index'])->name('asignar');

	Route::view('/changepassword', 'changepassword')->name('changepassword');
	Route::post('/changepassword',  [ChangePasswordController::class,'update'])->name('changepassword'); 

Auth::routes();


