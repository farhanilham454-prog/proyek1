@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Tambah Saldo Awal</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="/accounts" method="POST">
        @csrf
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
@endsection
