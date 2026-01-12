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

    .main-content {
        padding: 20px;
    }

    .chart-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        padding: 28px;
    }

    .transaksi-list {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        padding: 20px;
        color: #fff;
        max-height: 400px;
        overflow-y: auto;
    }

    .badge-income {
        background: rgba(40,167,69,0.9);
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
    }

    .badge-expense {
        background: rgba(220,53,69,0.9);
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
    }

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

    .total-box {
        background-color: #ffffff;
        color: #007bff;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: inline-block;
        margin-bottom: 20px;
    }
</style>

<!-- Sidebar Menu -->
<div id="sidebarMenu">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Menu</h5>
        <button class="btn btn-sm btn-outline-primary" onclick="toggleSidebar()">✕</button>
    </div>

    <a href="/dashboard">🏠 Home</a>
    <a href="/transaksi">💳 Transaksi</a>
    <a href="/diagram">📊 Diagram</a>
    <a href="/pengeluaran">💸 Histori</a>
    <a href="/e-statement">📑 E‑Statement</a>   <!-- ✅ Tambahan menu baru -->
    <a href="/logout">🚪 Logout</a>
</div>

<!-- Tombol ☰ -->
<button id="toggleBtn" class="menu-toggle" onclick="toggleSidebar()">☰</button>

<!-- Konten utama -->
<div id="mainContent" class="main-content container mt-5">
    <h3 class="text-center mb-4">🥧 Diagram Pie Keuangan</h3>

    <!-- Filter Periode -->
    <div class="text-center mb-4">
        <form method="GET" action="/diagram">
            <select name="periode" class="form-select d-inline w-auto">
                <option value="today" {{ $periode=='today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="7days" {{ $periode=='7days' ? 'selected' : '' }}>7 Hari</option>
                <option value="30days" {{ $periode=='30days' ? 'selected' : '' }}>30 Hari</option>
            </select>
            <button type="submit" class="btn btn-white ms-2">Terapkan</button>
        </form>
    </div>

    <!-- Total di atas grafik -->
    <div class="text-center">
        <div class="total-box">
            Total Keuangan: Rp {{ number_format($totalPemasukan + $totalPengeluaran, 0, ',', '.') }}
        </div>
    </div>

    <!-- Grafik + Deskripsi Transaksi -->
    <div class="row">
        <div class="col-md-6">
            <div class="chart-card">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="transaksi-list">
                <h5>🧾 Deskripsi Transaksi</h5>
                @if($transaksi->isEmpty())
                    <p>Belum ada transaksi.</p>
                @else
                    @foreach($transaksi as $trx)
                        <div class="mb-3">
                            @if($trx->type == 'pemasukan')
                                <span class="badge-income">Pemasukan</span>
                            @else
                                <span class="badge-expense">Pengeluaran</span>
                            @endif
                            — {{ $trx->description }}  
                            <br>Rp {{ number_format($trx->amount, 0, ',', '.') }} • {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pieChart').getContext('2d');

    const totalPemasukan = {{ (int) $totalPemasukan }};
    const totalPengeluaran = {{ (int) $totalPengeluaran }};

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                data: [totalPemasukan, totalPengeluaran],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: ['#28a745','#dc3545'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const val = ctx.raw || 0;
                            return `${ctx.label}: Rp ${Number(val).toLocaleString('id-ID')}`;
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            }
        }
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebarMenu');
        const toggleBtn = document.getElementById('toggleBtn');

        sidebar.classList.toggle('active');
        toggleBtn.classList.toggle('hidden', sidebar.classList.contains('active'));
    }
</script>
@endsection
