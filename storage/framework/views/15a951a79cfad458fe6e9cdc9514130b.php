

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
    <a href="/e-statement">📑 E‑Statement</a>
    <a href="/logout">🚪 Logout</a>
</div>

<!-- Tombol ☰ -->
<button id="toggleBtn" class="menu-toggle" onclick="toggleSidebar()">☰</button>

<!-- Konten utama -->
<div id="mainContent" class="main-content">
    <h3>Laporan Pembukuan Mutasi (E‑Statement)</h3>

    <!-- Filter Tahun & Bulan -->
    <form method="GET" action="<?php echo e(route('statement.index')); ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="year" class="form-label">Tahun</label>
            <select name="year" id="year" class="form-select">
                <?php for($y = date('Y'); $y >= date('Y')-5; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('year') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="month" class="form-label">Bulan</label>
            <select name="month" id="month" class="form-select">
                <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m); ?>" <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                        <?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('F')); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Tabel Transaksi -->
    <table class="table table-bordered mt-3 bg-white text-dark">
        <thead class="table-primary">
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Saldo Berjalan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($trx->date)->format('d M Y')); ?></td>
                    <td><?php echo e(ucfirst($trx->type)); ?></td>
                    <td><?php echo e($trx->description); ?></td>
                    <td>Rp <?php echo e(number_format($trx->amount, 0, ',', '.')); ?></td>
                    <td>Rp <?php echo e(number_format($trx->running_balance, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="mt-3">
        <a href="#" onclick="window.print()" class="btn btn-outline-primary">🖨 Cetak / Simpan PDF</a>
        <a href="/dashboard" class="btn btn-secondary">← Kembali</a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/statement/index.blade.php ENDPATH**/ ?>