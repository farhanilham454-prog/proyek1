@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0d6efd 0%, #4ba3ff 100%);
        color: white;
        font-family: 'Segoe UI', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Sidebar menu */
    #sidebarMenu {
        position: fixed;
        top: 0;
        left: 0;
        width: 220px;
        height: 100%;
        background-color: white;
        color: #007bff;
        box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        z-index: 1000;
        padding: 20px;
        transition: transform 0.3s ease;
        transform: translateX(-100%);
    }

    #sidebarMenu.active {
        transform: translateX(0);
    }

    #sidebarMenu a {
        display: block;
        padding: 10px 0;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    #sidebarMenu a:hover {
        background-color: #f0f0f0;
        border-radius: 6px;
        color: #0056b3;
    }

    /* Toggle button */
    .menu-toggle {
        position: fixed;
        top: 10px;
        left: 10px;
        font-size: 1.8rem;
        background-color: white;
        color: #007bff;
        border: none;
        border-radius: 6px;
        padding: 1px 10px;
        cursor: pointer;
        z-index: 1100;
        transition: opacity 0.3s ease;
    }

    .menu-toggle.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* Konten utama */
    .main-content {
        padding: 20px;
    }

    /* Tombol putih custom */
    .btn-white {
        background-color: #ffffff;
        color: #007bff;
        border: 1px solid #ffffff;
    }
    .btn-white:hover {
        background-color: #f8f9fa;
        color: #0056b3;
        border: 1px solid #e2e6ea;
    }
</style>

<!-- Sidebar Menu -->
<div id="sidebarMenu">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Menu</h5>
        <button class="btn btn-sm btn-outline-primary" onclick="toggleSidebar()">✕</button>
    </div>

    <a href="/dashboard">🏠 Home </a>
    <a href="/transaksi">💳 Transaksi</a>
    <a href="/diagram">📊 Diagram</a>
    <a href="/pengeluaran">💸 Histori</a>
    <a href="/logout">🚪 Logout</a>
</div>

<!-- Tombol ☰ -->
<button id="toggleBtn" class="menu-toggle" onclick="toggleSidebar()">☰</button>

<!-- Konten utama -->
<div id="mainContent" class="main-content container py-4">
    <h3>Daftar Transaksi</h3>
    <!-- Tombol putih -->
    <a href="{{ url('/transaksi/create') }}" class="btn btn-white mb-3">Tambah Transaksi</a>
    <a href="/dashboard" class="btn btn-white mb-3">← Kembali ke Dashboard</a>

    @if($transaksi->isEmpty())
        <div class="alert alert-info">Belum ada transaksi.</div>
    @else
        @foreach($transaksi as $trx)
            <div class="card mb-2 p-3">
                <strong>{{ ucfirst($trx->type) }}</strong> — {{ $trx->description }}  
                <br>Rp {{ number_format($trx->amount, 0, ',', '.') }} • {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                <div class="mt-2">
                    <a href="{{ url('/transaksi/'.$trx->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ url('/transaksi/'.$trx->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus transaksi ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    const toggleBtn = document.getElementById('toggleBtn');

    sidebar.classList.toggle('active');

    if (sidebar.classList.contains('active')) {
        toggleBtn.classList.add('hidden');
    } else {
        toggleBtn.classList.remove('hidden');
    }
}
</script>
@endsection
