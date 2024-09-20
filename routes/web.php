<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspekController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardKaprodi;
use App\Http\Controllers\DashboardDosen;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardMahasiswa;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiProfileController;
use App\Http\Controllers\PemilihanDosenController;
use App\Http\Controllers\MahasiswaPengajuanController;
use App\Http\Controllers\DosenPengajuanController;
use App\Http\Controllers\AuthController;



// Route untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['guest:user,mahasiswa,dosen'])->group(function () {
    Route::get('/login', function () {
        return view('auth.sign-in');
    })->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

// Route untuk halaman sign-in
// Route::get('/sign-in', function () {
//     return view('auth.sign-in');
// })->name('sign-in');

// Route untuk halaman sign-up
Route::get('/sign-up', function () {
    return view('auth.sign-up',);
})->name('sign-up');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:user,mahasiswa,dosen'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('/pemilihandosen/{mahasiswa_id}', [Dashboard::class, 'pemilihandosen'])->name('pemilihandosen');
    Route::post('/perhitungan', [Dashboard::class, 'perhitungan'])->name('perhitungan');
    Route::post('/select-dosen', [Dashboard::class, 'selectDosen'])->name('selectDosen');

    //Route untuk dashboard
    //Route untuk aspek
    Route::resource('aspek', AspekController::class);
    //Route untuk kriteria
    Route::resource('kriteria', KriteriaController::class)->parameters([
        'kriteria' => 'kriteria'
    ]);
    Route::get('/createkriteriadosen', [KriteriaController::class, 'createkriteriados'])->name('kriteria.createkriteriados');
    Route::post('/createkriteriadosen/store', [KriteriaController::class, 'storekriteriados'])->name('kriteria.storekriteriados');
    // Tambahkan route untuk edit dan update
    Route::get('/editkriteriadosen/{dosen_id}', [KriteriaController::class, 'editKriteriaDosen'])->name('kriteria.editkriteriadosen');
    Route::post('/updatekriteriadosen/{dosen_id}', [KriteriaController::class, 'updateKriteriaDosen'])->name('kriteria.updatekriteriadosen');

    // Tambahkan route untuk delete
    Route::delete('/deletekriteriadosen/{dosen_id}', [KriteriaController::class, 'deleteKriteriaDosen'])->name('kriteria.deletekriteriadosen');


    //Route untuk nilai profile core
    Route::get('/nilai', [NilaiProfileController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/test', [NilaiProfileController::class, 'test'])->name('nilai.test');
    Route::post('/nilai/predict', [NilaiProfileController::class, 'predict'])->name('nilai.predict');
    Route::get('/nilai/{mahasiswa_id}/{dosen_id}/edit', [NilaiProfileController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{mahasiswa_id}/{dosen_id}', [NilaiProfileController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/{mahasiswa_id}/{dosen_id}', [NilaiProfileController::class, 'destroy'])->name('nilai.destroy');
    Route::get('/nilai/create', [NilaiProfileController::class, 'test'])->name('nilai.create');
    Route::post('/nilai/store', [NilaiProfileController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/available-dosens/{mahasiswa_id}', [NilaiProfileController::class, 'getAvailableDosens']);
    Route::get('/nilaigap', [NilaiProfileController::class, 'nilaigap'])->name('nilai.nilaigap');
    Route::get('/hasilgap', [NilaiProfileController::class, 'hasilgap'])->name('nilai.hasilgap');
    Route::get('/nilaicore', [NilaiProfileController::class, 'nilaicore'])->name('nilai.nilaicore');
    Route::get('/nilaisecondary', [NilaiProfileController::class, 'nilaisecondary'])->name('nilai.nilaisecondary');
    Route::get('/nilai/criteria/{dosen_id}', [NilaiProfileController::class, 'getCriteriaByDosen']);

    Route::get('/dosen/{dosen_id}/kriteria/{mahasiswaId}', [NilaiProfileController::class, 'getDosenKriteria']);

    //Route untuk nilai profile second
    Route::resource('nilaisecond', NilaiProfileController::class);
    //Route untuk dosen
    Route::resource('dosen', DosenController::class);
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'index']);
    Route::get('/data_bimbingan', [DashboardDosenController::class, 'data_bimbingan'])->name('data_bimbingan');

    Route::post('/approve/{id}', [DashboardDosenController::class, 'approveJudul']);
    Route::post('/reject/{id}', [DashboardDosenController::class, 'rejectJudul'])->name('dashboard-dosen.reject');

    //Route untuk mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class);
    //Route untuk dashboard dosen
    //Route untuk pemilihandosen
    //Rute pengajuan judul
    Route::get('/pengajuanjudul', [MahasiswaPengajuanController::class, 'index'])->name('mahasiswa.pengajuanjudul');
    Route::get('/pengajuanjudul/tambah', [MahasiswaPengajuanController::class, 'create'])->name('mahasiswa.pengajuanjudul.create');
    Route::get('/pengajuanjudul/{id}/edit', [MahasiswaPengajuanController::class, 'edit'])->name('mahasiswa.edit.pengajuan');
    Route::put('/pengajuanjudul/{id}', [MahasiswaPengajuanController::class, 'update'])->name('mahasiswa.update.pengajuan');
    Route::delete('/pengajuanjudul/{id}', [MahasiswaPengajuanController::class, 'destroy'])->name('mahasiswa.destroy.pengajuan');

    Route::post('/pengajuan', [MahasiswaPengajuanController::class, 'store'])->name('mahasiswa.pengajuanjudul.store');
    // Route::get('/dashboarddosen', [MahasiswaPengajuanController::class, 'index'])->name('dosen.dashboarddosen');
    //Route untuk pemilihan judul
    Route::get('/pemilihanjudul/{id}', [MahasiswaPengajuanController::class, 'show'])->name('pemilihanjudul');
    //Ruote verifikasi
    Route::post('/mahasiswa/submitjudul/{id}', [MahasiswaPengajuanController::class, 'submitjudul'])->name('mahasiswa.submitjudul');
});

Route::middleware(['auth:mahasiswa', 'checkRole:Admin'])->group(function () {
});

// //Route dashboard mahasiswa
// Route::get('/dashboardmahasiswa', [MahasiswaPengajuanController::class, 'index'])->name('mahasiswa.dashboardmahasiswa');

// // Route::get('/dashboardmahasiswa', [MahasiswaPengajuanController::class, 'index'])->name('mahasiswa.dashboardmahasiswa');
