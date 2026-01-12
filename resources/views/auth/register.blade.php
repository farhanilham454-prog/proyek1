@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #007bff;
        color: white;
    }
    .card {
        background-color: white;
        color: black;
        border-radius: 12px;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Registrasi</h3>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email aktif" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password aman" required>
            </div>
            <button type="submit" class="btn btn-success w-100 btn-lg">Daftar</button>
        </form>

        <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="/login">Login</a></small>
        </div>
        <div class="text-center mt-2">
            <a href="/" class="btn btn-secondary btn-sm">← Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
