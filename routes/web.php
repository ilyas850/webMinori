<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);

        #Profil Karyawan
        Route::get('profilKaryawan', [AdminController::class, 'profilKaryawan'])->name('profilKaryawan');
        Route::get('input_profil_karyawan', [AdminController::class, 'input_profil_karyawan']);
        Route::post('post_profil_karyawan', [AdminController::class, 'post_profil_karyawan']);
        Route::get('edit_profil_karyawan/{id}', [AdminController::class, 'edit_profil_karyawan']);
        Route::post('update_profil_karyawan/{id}', [AdminController::class, 'update_profil_karyawan']);
        route::get('delete_profil_karyawan/{id}', [AdminController::class, 'delete_profil_karyawan']);

        #Jenis Training
        Route::get('jenisTraining', [AdminController::class, 'jenisTraining'])->name('jenisTraining');
        Route::get('input_jenis_training', [AdminController::class, 'input_jenis_training']);
        Route::post('post_jenis_training', [AdminController::class, 'post_jenis_training']);
        Route::get('edit_jenis_training/{id}', [AdminController::class, 'edit_jenis_training']);
        Route::post('update_jenis_training/{id}', [AdminController::class, 'update_jenis_training']);
        route::get('delete_jenis_training/{id}', [AdminController::class, 'delete_jenis_training']);

        #Training Karyawan
        Route::get('trainingKaryawan', [AdminController::class, 'trainingKaryawan'])->name('trainingKaryawan');
        Route::get('input_training_karyawan', [AdminController::class, 'input_training_karyawan']);
        Route::post('post_training_karyawan', [AdminController::class, 'post_training_karyawan']);
        Route::get('edit_training_karyawan/{id}', [AdminController::class, 'edit_training_karyawan']);
        Route::post('update_training_karyawan/{id}', [AdminController::class, 'update_training_karyawan']);
        route::get('delete_training_karyawan/{id}', [AdminController::class, 'delete_training_karyawan']);

        #Data Karyawan
        Route::get('dataKaryawan', [AdminController::class, 'dataKaryawan'])->name('dataKaryawan');
        Route::post('cari_data_karyawan', [AdminController::class, 'cari_data_karyawan']);
    });
});
