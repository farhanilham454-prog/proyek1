@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Transaksi</h3>
    <form action="{{ url('/transaksi/'.$transaksi->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="type" class="form-label">Jenis</label>
            <select name="type" class="form-select" required>
                <option value="pemasukan" {{ $transaksi->type == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ $transaksi->type == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" name="description" class="form-control" value="{{ $transaksi->description }}" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="amount" class="form-control" value="{{ $transaksi->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" value="{{ $transaksi->date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
