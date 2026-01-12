<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dompetku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    <style>
        body {
            background: linear-gradient(135deg, #0047ab, #0077ff, #66ccff);
            background-attachment: fixed;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
   
    </style>

<body>
    <div class="content-wrapper">
        @yield('content')
    </div>
</body>
</html>
