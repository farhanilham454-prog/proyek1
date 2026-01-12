@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Total Saldo</h3>
    <a href="/accounts/create" class="btn btn-primary mb-3">Tambah Akun</a>
    @foreach($accounts as $acc)
        <div class="card mb-2 p-3">
            <strong>{{ $acc->bank }}</strong> — Rp {{ number_format($acc->balance, 0, ',', '.') }}
            <div class="mt-2">
                <a href="/accounts/{{ $acc->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                <form action="/accounts/{{ $acc->id }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
