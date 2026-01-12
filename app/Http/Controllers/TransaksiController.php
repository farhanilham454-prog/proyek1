<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        // hanya tampilkan transaksi milik user login
        $transaksi = Transaksi::where('user_id', Auth::user()->user_id)
                              ->orderBy('date', 'desc')
                              ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'        => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'date'        => 'required|date',
        ]);

        // simpan transaksi dengan user_id
        Transaksi::create([
            'user_id'     => Auth::user()->user_id,
            'type'        => $validated['type'],
            'description' => $validated['description'],
            'amount'      => $validated['amount'],
            'date'        => $validated['date'],
        ]);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'type'        => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
        ]);

        $transaksi->update($validated);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::where('user_id', Auth::user()->user_id)
                              ->findOrFail($id);

        return view('dashboard.struk', compact('transaksi'));
    }
}
