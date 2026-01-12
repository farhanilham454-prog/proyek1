<!-- resources/views/dashboard.blade.php -->


<?php $__env->startSection('content'); ?>
<style>
  body { background-color: #007bff; color: white; }
  .card-menu {
    background-color: white; color: #007bff; border-radius: 12px;
    padding: 24px; text-align: center; transition: .2s; text-decoration: none;
  }
  .card-menu:hover { background-color: #e2e6ea; color: #0056b3; }
</style>

<div class="container py-5">
  <h2 class="text-center mb-4">Dashboard Dompetku</h2>
  <div class="row justify-content-center g-4">
    <div class="col-md-4">
      <a href="/laporan" class="card-menu d-block shadow">
        <h4>Laporan Keuangan</h4>
        <p>Ringkasan transaksi dan grafik.</p>
      </a>
    </div>
    <div class="col-md-4">
      <a href="/konsultasi" class="card-menu d-block shadow">
        <h4>Konsultasi Keuangan</h4>
        <p>Saran finansial dan bantuan.</p>
      </a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/dashboard.blade.php ENDPATH**/ ?>