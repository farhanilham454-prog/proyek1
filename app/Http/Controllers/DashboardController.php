<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->user_id;

        // ambil akun milik user login
        $account = Account::where('user_id', $userId)->latest()->first();
        $bankName = $account ? $account->bank : null;

        // hitung saldo awal, pemasukan, pengeluaran milik user login
        $saldoAwal = Account::where('user_id', $userId)->sum('balance');
        $totalPengeluaran = Transaksi::where('user_id', $userId)
                                     ->where('type', 'pengeluaran')
                                     ->sum('amount');
        $totalPemasukan = Transaksi::where('user_id', $userId)
                                   ->where('type', 'pemasukan')
                                   ->sum('amount');

        $saldoAkhir = $saldoAwal + $totalPemasukan - $totalPengeluaran;

        return view('dashboard.dashboard', compact(
            'saldoAwal',
            'totalPengeluaran',
            'totalPemasukan',
            'saldoAkhir',
            'bankName'
        ));
    }
}
