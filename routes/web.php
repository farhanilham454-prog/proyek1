<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagramController;
use App\Models\Transaksi;
use App\Http\Controllers\EStatementController;


//E-statementcontroller
Route::get('/e-statement', [EStatementController::class, 'index'])->middleware('auth')->name('statement.index');

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Halaman login & register
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// AccountController
Route::resource('accounts', AccountController::class)->middleware('auth');

// TransaksiController
Route::resource('transaksi', TransaksiController::class)->middleware('auth');

// DiagramController
Route::get('/diagram', [DiagramController::class, 'index'])
    ->name('diagram')
    ->middleware('auth');

// Histori Transaksi (pengeluaran)
Route::get('/pengeluaran', function () {
    $userId = Auth::user()->user_id;
    $transaksi = Transaksi::where('user_id', $userId)
                          ->orderBy('date', 'desc')
                          ->get();
    return view('dashboard.pengeluaran', compact('transaksi'));
})->middleware('auth');

// Route untuk tampilan struk (bukan download txt)
Route::get('/struk/{id}', function ($id) {
    $trx = Transaksi::findOrFail($id);

    if ($trx->user_id !== Auth::user()->user_id) {
        abort(403);
    }

    // tampilkan halaman struk dengan Blade
    return view('dashboard.struk', ['transaksi' => $trx]);
})->name('struk.download')->middleware('auth');
