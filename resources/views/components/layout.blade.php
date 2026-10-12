<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIPUS-Del' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f5f3ff;
            color: #1f2937;
        }

        header {
            background-color: #4C1D95;
            color: white;
            padding: 20px 0;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .btn-purple {
            background-color: #4C1D95;
            color: white;
            border: none;
        }

        .btn-purple:hover {
            background-color: #3b1675;
            color: white;
        }

        main {
            min-height: 75vh;
        }

        footer {
            background-color: #4C1D95;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand fw-bold" href="{{ route('buku.index') }}">
                    SIPUS-Del
                </a>

                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('buku.index') }}">
                        Daftar Buku
                    </a>

                    <a class="nav-link" href="{{ route('kategori.index') }}">
                        Kategori
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup">
                </button>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer>
        <p class="mb-0">SIPUS-Del &copy; {{ date('Y') }}</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>