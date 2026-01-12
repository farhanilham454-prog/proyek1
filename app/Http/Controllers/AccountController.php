<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->user_id;
        $accounts = Account::where('user_id', $userId)->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank' => 'required|string|max:100',
            'balance' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        if (!$user || !$user->user_id) {
            return redirect('/login')->withErrors(['auth' => 'Silakan login terlebih dahulu']);
        }

        Account::where('user_id', $user->user_id)->delete();
        Transaksi::where('user_id', $user->user_id)->delete();

        Account::create([
            'user_id' => $user->user_id,
            'bank'    => $request->bank,
            'balance' => $request->balance,
        ]);

        return redirect('/dashboard')->with('success', 'Data akun berhasil di-reset dan saldo awal disimpan');
    }

    public function edit(Account $account)
    {
        if ($account->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        if ($account->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'bank' => 'required|string|max:100',
            'balance' => 'required|numeric|min:0',
        ]);

        $account->update([
            'bank'    => $request->bank,
            'balance' => $request->balance,
        ]);

        return redirect('/dashboard')->with('success', 'Saldo berhasil diperbarui');
    }

    public function destroy(Account $account)
    {
        if ($account->user_id !== Auth::user()->user_id) {
            abort(403, 'Akses ditolak');
        }

        $account->delete();
        return redirect('/dashboard')->with('success', 'Akun berhasil dihapus');
    }
}
