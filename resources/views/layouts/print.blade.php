<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 20px;
                font-size: 12px;
            }
            .table {
                font-size: 12px;
            }
            .header {
                border-bottom: 2px solid #000;
                margin-bottom: 15px;
                padding-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>
    
    <div class="container no-print mt-4 text-center">
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>