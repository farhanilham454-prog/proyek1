

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h3>Edit Transaksi</h3>
    <form action="<?php echo e(url('/transaksi/'.$transaksi->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="type" class="form-label">Jenis</label>
            <select name="type" class="form-select" required>
                <option value="pemasukan" <?php echo e($transaksi->type == 'pemasukan' ? 'selected' : ''); ?>>Pemasukan</option>
                <option value="pengeluaran" <?php echo e($transaksi->type == 'pengeluaran' ? 'selected' : ''); ?>>Pengeluaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" name="description" class="form-control" value="<?php echo e($transaksi->description); ?>" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="amount" class="form-control" value="<?php echo e($transaksi->amount); ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" value="<?php echo e($transaksi->date); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(url('/transaksi')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek1\resources\views/transaksi/edit.blade.php ENDPATH**/ ?>