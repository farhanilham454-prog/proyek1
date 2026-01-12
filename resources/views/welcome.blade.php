<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dompetku - Aplikasi Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #001f4d, #0047ab, #0077ff, #00bfff, #66d9ff);
            background-attachment: fixed; /* gradasi tetap saat scroll */
            color: white;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
        }
        .nav-btn {
            font-size: 1.2rem;
            padding: 10px 20px;
            margin-left: 10px;
        }
        .hero {
            padding: 80px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 2rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .footer {
            margin-top: 50px;
            font-size: 0.9rem;
        }
        .btn-white {
            background-color: #e2e6ea;
            color: #007bff;
            border: none;
        }
        .btn-white:hover {
            background-color: #d6d8db;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="d-flex justify-content-between align-items-center p-3">
        <h3 class="ms-3">Dompetku</h3>
        <div class="me-3">
            <a href="/login" class="btn btn-white nav-btn">Login</a>
            <a href="/register" class="btn btn-white nav-btn">Registrasi</a>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 80vh;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Dompetku" style="width: 400px; height: auto;">
        <h1 class="text-white text-center mt-4">Aplikasi Keuangan untuk Catat Transaksi, Budgeting dan Nabung Tanpa Ribet!</h1>
        <p class="text-white text-center">Dompetku siap catat transaksi & analisis finansial kamu secara otomatis.</p>
    </div>

    <div class="footer text-center">
        <p>No. 1 Indonesia keuangan web | Best of 2025 Awards | 1jt+ Dipercaya Pengguna</p>
    </div>
</body>
</html>
