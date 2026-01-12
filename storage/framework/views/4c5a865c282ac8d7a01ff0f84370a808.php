

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h3>Tambah Saldo Awal</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="/accounts" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="bank" class="form-label">Nama Bank</label>
            <input type="text" name="bank" id="bank" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="balance" class="form-label">Saldo Awal (Rp)</label>
            <input type="number" name="balance" id="balance" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/dashboard" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/accounts/create.blade.php ENDPATH**/ ?>