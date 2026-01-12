<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Tambah Transaksi</h2>
    <form action="/transactions" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control">
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control">
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</body>
</html>
<?php /**PATH C:\laragon\www\proyek1\resources\views/transactions/create.blade.php ENDPATH**/ ?>