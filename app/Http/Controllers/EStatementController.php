<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class EStatementController extends Controller
{
public function index(Request $request)
{
    $userId = Auth::user()->user_id;
    $query = Transaksi::where('user_id', $userId)->orderBy('date', 'asc');

    if ($request->year) {
        $query->whereYear('date', $request->year);
    }
    if ($request->month) {
        $query->whereMonth('date', $request->month);
    }

    $transaksis = $query->get();

    $saldo = 0;
    foreach ($transaksis as $trx) {
        $saldo += ($trx->type === 'pemasukan') ? $trx->amount : -$trx->amount;
        $trx->running_balance = $saldo;
    }

    return view('statement.index', compact('transaksis'));
}

}

