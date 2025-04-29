<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIBOOKSTORE - @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: rgba(132, 109, 207, 0.1);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #534582;
        }
        .footer-custom {
            background-color: #534582;
            color: white;
            margin-top: auto;
        }
        .footer-custom a {
            color: white;
            text-decoration: none;
        }
        .content-wrapper {
            flex: 1;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="fas fa-book-open-reader me-2"></i> UNIBOOKSTORE
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pengadaan') ? 'active' : '' }}" href="{{ route('pengadaan') }}">Pengadaan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container my-5 content-wrapper">
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer-custom py-4">
    <div class="container text-center">
        <p class="mb-1 fw-bold">📚 UNIBOOKSTORE - Buka Buku, Buka Dunia</p>
        <p class="small">Follow kami di:
            <a href="#"><i class="fab fa-instagram ms-2"></i> Instagram</a> |
            <a href="#"><i class="fab fa-x-twitter ms-2"></i> Twitter</a>
        <p class="small mb-0">© 2025 UNIBOOKSTORE. Dibuat oleh Maharani Ladja Puwa 🌟</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    // Delete confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const formDelete = document.querySelectorAll('.form-delete');
        formDelete.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Hapus data ini?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@endif

@stack('scripts')

</body>
</html>