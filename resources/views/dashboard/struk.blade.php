@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0d6efd 0%, #4ba3ff 100%);
        font-family: 'Courier New', monospace;
        color: #333;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .receipt-container {
        background: #fff;
        padding: 30px;
        width: 320px;
        border: 1px dashed #999;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        border-radius: 8px;
    }

    .receipt-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .receipt-header h4 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .receipt-header .app-name {
        font-size: 0.9rem;
        color: #555;
        margin-top: 4px;
        letter-spacing: 1px;
    }

    .receipt-line {
        border-top: 1px dashed #999;
        margin: 10px 0;
    }

    .receipt-item {
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .receipt-footer {
        text-align: center;
        font-size: 0.8rem;
        color: #666;
        margin-top: 20px;
    }

    .btn-group {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn-group a {
        flex: 1;
    }
</style>

<div class="receipt-container">
    <div class="receipt-header">
        <h4>🧾 STRUK TRANSAKSI</h4>
        <div class="app-name">Dompetku</div>
        <small>{{ \Carbon\Carbon::parse($transaksi->date)->format('d M Y') }}</small>
    </div>

    <div class="receipt-line"></div>

    <div class="receipt-item"><strong>Jenis:</strong> {{ ucfirst($transaksi->type) }}</div>
    <div class="receipt-item"><strong>Deskripsi:</strong> {{ $transaksi->description }}</div>
    <div class="receipt-item"><strong>Jumlah:</strong> Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</div>

    <div class="receipt-line"></div>

    <div class="receipt-footer">
        Terima kasih telah menggunakan Dompetku 🙏<br>
        Simpan struk ini sebagai bukti
    </div>

    <div class="btn-group">
        <a href="#" onclick="window.print()" class="btn btn-outline-primary btn-sm">🖨 Cetak</a>
        <a href="/pengeluaran" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>
</div>
@endsection
