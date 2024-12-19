<?php

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Santri;

use App\Exports\IzinExport;
use App\Exports\SantriExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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


// Rute Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'proses']);

// Grup Middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Rute Cetak Izin
    Route::get('/cetakIzin', function () {
        $date = Carbon::now()->format('d-m-y');
        $fileName = 'izin_' . $date . '.xlsx';
        return Excel::download(new IzinExport, $fileName);
    });

    // Rute Cetak Santri
    Route::get('/cetakSantri', function () {
        $date = Carbon::now()->format('Y-m-d');
        $fileName = 'santri_' . $date . '.xlsx';
        return Excel::download(new SantriExport, $fileName);
    });

    // Rute Scanner
    Route::get('/scanner', [IzinController::class, 'scanner']);

    // Rute Izin Tambah
    Route::post('/izinTambah', [IzinController::class, 'tambah'])->name('izin.santri.tambah');

    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



    // Rute Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Halaman User
    Route::get('/user', [UsersController::class, 'index'])->name('users.index');
    Route::post('/user', [UsersController::class, 'tambahUser'])->name('users');
    Route::delete('/user/{user}', [UsersController::class, 'hapusUser'])->name('user.hapus');
    Route::put('/user/{id}', [UsersController::class, 'update'])->name('user.update');

    // Rute Halaman Izin Santri
    Route::get('/izinSantri', [IzinController::class, 'index'])->name('santri.izin');
    Route::post('/izinSantri', [IzinController::class, 'tambah'])->name('izin.santri.tambah');
    Route::delete('/izinSantri/{id}', [IzinController::class, 'hapus'])->name('izin.hapus');
    Route::get('/kopsurat/{slug}', [IzinController::class, 'showKopSurat'])->name('izin.kopsurat');

    // Rute Log Perizinan
    Route::get('/logizin', [LogController::class, 'index'])->name('logizin.index');

    // Print route
    Route::get('/logizin/print', [LogController::class, 'print'])->name('logizin.print');
    Route::get('/IzinLaporan', [LogController::class, 'exportIzin'])->name('logizin.export');
    // Rute Halaman Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::post('/tambahGuruKelas', [GuruController::class, 'tambah']);
    Route::get('/guruKelas', [GuruController::class, 'guruKelas'])->name('guru.guruKelas');

    // Rute Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Rute Halaman Santri
    Route::get('/santri', [SantriController::class, 'index']);
    Route::post('/santri/tambah', [SantriController::class, 'tambahSantri'])->name('santri.tambah');
    Route::delete('/santri/{idSantri}', [SantriController::class, 'hapus'])->name('santri.hapus');
    Route::put('/santri/{idSantri}', [SantriController::class, 'update'])->name('santri.update');
    Route::post('/santri/import', [SantriController::class, 'import'])->name('santri.import');


    // Rute Halaman Card
    Route::get('/card', [CardController::class, 'index']);
    Route::get('/cetakKartu/{slug}', [CardController::class, 'generateQrCode'])->name('santri.qrcode');

    // Rute Halaman Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('santri.kelas');
    Route::post('/tambahKelas', [KelasController::class, 'tambah'])->name('kelas.tambah');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'hapus'])->name('kelas.hapus');

    // Rute Halaman Jurusan
    Route::get('/jurusan', [JurusanController::class, 'index']);

    // Rute Halaman Izin
    Route::get('/izin', [IzinController::class, 'index']);

    // Rute Default
    Route::get('/', function () {
        return redirect('login');
    });
});
