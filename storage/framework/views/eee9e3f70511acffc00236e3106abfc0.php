

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #007bff;
        color: white;
        font-family: 'Segoe UI', sans-serif;
        overflow-x: hidden;
    }

    /* Sidebar menu overlay */
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
        transition: margin-left 0.3s ease;
        margin-left: 0;
        padding: 20px;
    }

    .main-content.shifted {
        margin-left: 220px;
    }

    .greeting {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .saldo-box {
        background-color: white;
        color: #007bff;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .menu-section {
        margin-top: 40px;
    }

    .card-menu {
        background-color: white;
        color: #007bff;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: 0.3s;
        text-decoration: none;
    }

    .card-menu:hover {
        background-color: #e2e6ea;
        color: #0056b3;
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
<div id="mainContent" class="main-content">
    <div class="dashboard-wrapper">
        <!-- Sapaan pengguna -->
        <div class="greeting">Halo <?php echo e(Auth::user()->name); ?> 👋</div>

        <h3>Dompetku</h3>

        <div class="saldo-box">
            <h5>Saldo Saat Ini</h5>
            <h2>Rp <?php echo e(number_format($saldoAkhir, 0, ',', '.')); ?></h2>
            <p>Saldo awal: Rp <?php echo e(number_format($saldoAwal, 0, ',', '.')); ?></p>
            <p>Total Pengeluaran: Rp <?php echo e(number_format($totalPengeluaran, 0, ',', '.')); ?></p>
               <!-- Tambahan: tampilkan nama bank -->
            <?php if(isset($bankName)): ?>
                <p>Bank: <?php echo e($bankName); ?></p>
            <?php endif; ?>
            <a href="/accounts/create" class="btn btn-outline-primary mt-2">Tambah Saldo Awal</a>
        </div>

        <div class="row justify-content-center menu-section g-4">
            <div class="col-md-4">
          <a href="/diagram" class="card-menu d-block shadow">
            <h5>Laporan Keuangan</h5>
            <p>Ringkasan transaksi dan grafik</p>
        </a>
    </div>
    <div class="col-md-4">
        <a href="/konsultasi" class="card-menu d-block shadow">
            <h5>Konsultasi Keuangan</h5>
            <p>Saran finansial dan bantuan</p>
        </a>
    </div>
    <div class="col-md-4">
        <a href="/pengeluaran" class="card-menu d-block shadow">
            <h5>Upload Struk</h5>
            <p>Unggah bukti transaksi kamu</p>
        </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    const main = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('toggleBtn');

    sidebar.classList.toggle('active');
    main.classList.toggle('shifted');

    if (sidebar.classList.contains('active')) {
        toggleBtn.classList.add('hidden');
    } else {
        toggleBtn.classList.remove('hidden');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>