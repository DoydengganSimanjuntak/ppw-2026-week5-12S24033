<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPUS-Del')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --del-purple: #4C1D95;
        }

        body {
            background-color: #f5f3ff;
            color: #1f2937;
        }

        .navbar {
            background-color: var(--del-purple);
        }

        .navbar-brand,
        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #ddd6fe;
        }

        .btn-purple {
            background-color: var(--del-purple);
            color: white;
        }

        .btn-purple:hover {
            background-color: #3b1575;
            color: white;
        }

        .page-container {
            padding-top: 30px;
            padding-bottom: 40px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(76, 29, 149, 0.08);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('buku.index') }}">
                SIPUS-Del
            </a>

            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('buku.index') }}">Data Buku</a>
                <a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a>
            </div>
        </div>
    </nav>

    <main class="container page-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>