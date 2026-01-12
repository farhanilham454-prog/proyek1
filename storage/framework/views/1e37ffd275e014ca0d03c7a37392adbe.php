

<?php $__env->startSection('content'); ?>
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
    <h3>Tambah Transaksi</h3>
    <form action="<?php echo e(url('/transaksi')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="type" class="form-label">Jenis</label>
            <select name="type" class="form-select" required>
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo e(url('/transaksi')); ?>" class="btn btn-secondary">Batal</a>
    </form>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/transaksi/create.blade.php ENDPATH**/ ?>