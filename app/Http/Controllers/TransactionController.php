<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->user_id)
                                   ->orderBy('date', 'desc')
                                   ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'        => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'date'        => 'required|date',
        ]);

        Transaction::create([
            'user_id'     => Auth::user()->user_id,
            'type'        => $request->type,
            'description' => $request->description,
            'amount'      => $request->amount,
            'date'        => $request->date,
        ]);

        return redirect('/transactions')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'type'        => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'date'        => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect('/transactions')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        $transaction->delete();

        return redirect('/transactions')->with('success', 'Transaksi berhasil dihapus');
    }
}
