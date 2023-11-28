<?php

use App\Models\Pembayaran;
use App\Models\TagihanDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\KartuSppController;
use App\Http\Controllers\WaliSiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankPondokController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\WaliSantriController;
use App\Http\Controllers\BerandaWaliController;
use App\Http\Controllers\BerandaOperatorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\KirimPesanController;
use App\Http\Controllers\KwitansiPembayaranController;
use App\Http\Controllers\LaporanFormController;
use App\Http\Controllers\LaporanPembayaranController;
use App\Http\Controllers\LaporanRekapPembayaran;
use App\Http\Controllers\LaporanTagihanController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembayaranMidtransController;
use App\Http\Controllers\SantriImportController;
use App\Http\Controllers\SettingAppController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SettingPjController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TagihanBiayaLainController;
use App\Http\Controllers\TagihanLainStep2;
use App\Http\Controllers\TagihanLainStep2Controller;
use App\Http\Controllers\TagihanLainStep4Controller;
use App\Http\Controllers\TagihanLainStepController;
use App\Http\Controllers\TagihanUpdateLunas;
use App\Http\Controllers\WaliNotifikasiController;
use App\Http\Controllers\WaliPaymentController;
use App\Http\Controllers\WaliSantriInvoiceController;
use App\Http\Controllers\WaliSantriPembayaranController;
use App\Http\Controllers\WaliSantriProfilController;
use App\Http\Controllers\WaliSantriSantriController;
use App\Http\Controllers\WaliSantriTagihanController;
use App\Imports\SantriImport;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('tes', function () {
//     echo $url = URL::temporarySignedRoute(
//         'login.url',
//         now()->addDays(10),
//         [
//             'pembayaran_id' => 2,
//             'user_id' => 2,
//             'url' => route('pembayaran.show', 2)
//         ]
//     );
// });

Route::get('login/login-url', [LoginController::class, 'loginUrl'])->name('login.url');

Route::get('/', function () {
    return view('landing_page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function () {
    //ini route khusus untuk operator
    Route::get('beranda', [BerandaOperatorController::class, 'index'])->name('operator.beranda');
    Route::resource('settingpj', SettingPjController::class);
    Route::resource('settingapp', SettingAppController::class);
    Route::resource('bankpondok', BankPondokController::class);
    Route::resource('user', UserController::class);
    Route::resource('wali', WaliController::class);
    Route::resource('santri', SantriController::class);
    Route::resource('walisantri', WaliSantriController::class);
    Route::resource('biaya', BiayaController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('setting', SettingController::class);
    Route::get('delete-biaya-item/{id}', [BiayaController::class, 'deleteItem'])->name('delete-biaya.item');
    Route::get('status/update}', [StatusController::class, 'update'])->name('status.update');
    //laporan
    Route::get('laporanform/create', [LaporanFormController::class, 'create'])->name('laporanform.create');
    Route::get('laporantagihan', [LaporanTagihanController::class, 'index'])->name('laporantagihan.index');
    Route::get('laporanpembayaran', [LaporanPembayaranController::class, 'index'])->name('laporanpembayaran.index');
    Route::get('laporanrekappembayaran', [LaporanRekapPembayaran::class, 'index'])->name('laporanrekappembayaran.index');
    //invoke
    Route::post('tagihanupdatelunas', TagihanUpdateLunas::class)->name('tagihanupdate.lunas');
    Route::resource('logactivity', LogActivityController::class);
    Route::resource('jobstatus', JobStatusController::class);
    Route::post('santriimport', SantriImportController::class)->name('santriimport.store');
    Route::resource('kirimpesan', KirimPesanController::class);
    Route::resource('tagihanlainstep', TagihanLainStepController::class);
    Route::post('tagihanlainstep2', TagihanLainStep2Controller::class)->name('tagihanlainstep2.store');
    Route::get('tagihanlainstep2', TagihanLainStep2Controller::class)->name('tagihanlainstep2.delete');
    Route::post('tagihanlainstep4', TagihanLainStep4Controller::class)->name('tagihanlainstep4.store');
});

\Imtigger\LaravelJobStatus\ProgressController::routes();

Route::get('login-wali', [LoginController::class, 'showLoginFormWali'])->name('login.wali');

Route::prefix('wali')->middleware(['auth', 'auth.wali', 'verified'])->name('wali.')->group(function () {
    //ini route khusus untuk wali-murid
    Route::get('beranda', [BerandaWaliController::class, 'index'])->name('beranda');
    Route::resource('santri', WaliSantriSantriController::class);
    Route::resource('tagihan', WaliSantriTagihanController::class);
    Route::resource('pembayaran', WaliSantriPembayaranController::class);
    Route::resource('profil', WaliSantriProfilController::class);
    Route::resource('notifikasi', WaliNotifikasiController::class);
});
Route::get('kartuspp', [KartuSppController::class, 'index'])->name('kartuspp.index')->middleware('auth');
Route::get('kwitansi-pembayaran/{id}', [KwitansiPembayaranController::class, 'show'])->name('kwitansipembayaran.show')->middleware('auth');
Route::resource('invoice', InvoiceController::class)->middleware('auth');


Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    //ini route khusus untuk admin
});



Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return view('auth.login_sneat');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
