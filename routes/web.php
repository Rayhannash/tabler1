<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('pages.auth.login'); })->name('login');

    Route::get('/register', function () {
        return view('pages.auth.registrasi');
    })->name('register');


    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');

    });
});


Route::middleware(['auth', 'check-access', 'authorize-access'])->group(function () {
    Route::get('beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('menu/get-data-all', [App\Http\Controllers\MenuController::class, 'getDataAll'])->name('menu.get-data-all');
    Route::resource('menu', App\Http\Controllers\MenuController::class);
    
    Route::get('test', [App\Http\Controllers\UserExtrasController::class, 'index'])->name('test');
    

    Route::get('Kelola Penilai', [App\Http\Controllers\MasterPetugasController::class, 'index'])->name('daftar_petugas');
    Route::get('/master-petugas', [App\Http\Controllers\MasterPetugasController::class, 'index'])->name('master_petugas');
    Route::get('master-petugas/{id}/edit', [App\Http\Controllers\MasterPetugasController::class, 'edit'])->name('master_petugas.edit');
    
    Route::get('Lembaga Pendidikan', [App\Http\Controllers\MasterSklhController::class, 'index'])->name('master_sklh');

    Route::get('lengkapi-data', [App\Http\Controllers\UserExtrasController::class, 'index'])->name('lengkapi_data');
    Route::get('detail-data', [App\Http\Controllers\UserExtrasController::class, 'show'])->name('detail_data');
    Route::get('edit-data', [App\Http\Controllers\UserExtrasController::class, 'edit'])->name('edit_data');
    
    //Permohonan
    Route::get('buat-permohonan', [App\Http\Controllers\UserExtrasController::class, 'index'])->name('buat_permohonan');

    
});

Route::get('master_sklh/{id}/edit', [App\Http\Controllers\MasterSklhController::class, 'edit'])->name('master_sklh.edit');
Route::post('/master_sklh/{id}/verification', [App\Http\Controllers\MasterSklhController::class, 'verification'])
    ->name('master_sklh.verification');
Route::delete('/master_sklh/{id}/delete', [App\Http\Controllers\MasterSklhController::class, 'delete'])
    ->name('master_sklh.delete');

    Route::get('master_sklh/{id}/edit', [App\Http\Controllers\MasterSklhController::class, 'edit'])->name('master_sklh.edit');

Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

Route::get('user_extras', [App\Http\Controllers\UserExtrasController::class, 'index'])->name('user_extras');
Route::post('user_extras', [App\Http\Controllers\UserExtrasController::class, 'store'])->name('user_extras.store');

Route::get('user_extras/viewsklh', [App\Http\Controllers\UserExtrasController::class, 'show']) ->name('user_extras.viewsklh');

Route::post('/editsklh', [App\Http\Controllers\UserExtrasController::class, 'updatesklh'])->name('master_sklh.update');
    
Route::post('/user-extras/simpan-proposal', [App\Http\Controllers\UserExtrasController::class, 'simpanProposalMagang'])->name('user_extras.simpan_proposal');

Route::get('/proposal-masuk', [App\Http\Controllers\ProposalMasukController::class, 'index'])->name('proposal_masuk');

Route::get('/user/permohonan', [App\Http\Controllers\UserExtrasController::class, 'daftarPermohonanKeluar'])->name('user.daftar_permohonan');
Route::get('/user/permohonan/{id}/addpesertamagang', [App\Http\Controllers\UserExtrasController::class, 'addPesertaMagang'])->name('user.addpesertamagang');
Route::post('/user/permohonan/{id}/simpanpesertamagang', [App\Http\Controllers\UserExtrasController::class, 'simpanPesertaMagang'])->name('user.simpan-peserta-magang');

Route::delete('/user/permohonan/{id}', [App\Http\Controllers\UserExtrasController::class, 'hapusPermohonan'])->name('user.hapus_permohonan');

// Route::get('/user/permohonan/{id}', [App\Http\Controllers\UserExtrasController::class, 'lihatPermohonan'])->name('user_extras.lihat_permohonan');
