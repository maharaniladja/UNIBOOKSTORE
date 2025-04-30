@extends('layout.app')

@section('title', 'Beranda')

@section('content')
    <div class="container py-4">
        <div class="text-center p-5 bg-light rounded-4 shadow-sm mb-5">
            <h1 class="fw-bold display-4">Selamat Datang di <span style="color: #534582;">UNIBOOKSTORE</span> <i class="fas fa-book" style="color: #534582;"></i></h1>
            <p class="text-muted lead">Temukan berbagai buku menarik dari penerbit terbaik untuk kebutuhan literasi Anda</p>
        </div>

       <!-- Info Cards -->
        <div class="row g-3 mb-5">
        <!-- Card Total Stok Buku -->
        <div class="col-md-4">
            <a href="{{ route('admin.index') }}#buku" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="cursor: pointer; transition: transform 0.2s;">
                    <div class="card-body text-center p-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-book-open fa-2x text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">Stok Buku</h5>
                        <p class="display-6 text-danger fw-bold mb-0">{{ $totalBuku }}</p>
                    </div>
                    <div class="card-footer border-0 text-center py-2"  style="background-color: rgba(83, 69, 130, 0.3);">
                        <small class="text-muted">Jumlah stok buku</small>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Card Stok Menipis -->
        <div class="col-md-4">
            <a href="{{ route('pengadaan') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="cursor: pointer; transition: transform 0.2s;">
                    <div class="card-body text-center p-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">Stok Menipis</h5>
                        <p class="display-6 text-danger fw-bold mb-0">{{ $stokMenipis ?? 0 }}</p>
                    </div>
                    <div class="card-footer border-0 text-center py-2" style="background-color: rgba(83, 69, 130, 0.3);">
                        <small class="text-muted">Butuh pengadaan segera</small>
                    </div>
                </div>
            </a>
        </div>
    
        <!-- Card Total Penerbit -->
        <div class="col-md-4">
            <a href="{{ route('admin.index') }}#penerbit" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="cursor: pointer; transition: transform 0.2s;">
                    <div class="card-body text-center p-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-building fa-2x text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">Total Penerbit</h5>
                        <p class="display-6 text-danger fw-bold mb-0">{{ $totalPenerbit }}</p>
                    </div>
                    <div class="card-footer border-0 text-center py-2"  style="background-color: rgba(83, 69, 130, 0.3);">
                        <small class="text-muted">Penerbit terpercaya</small>
                    </div>
                </div>
            </a>
        </div>
    </div>


        <!-- Search Buku -->
        <div class="card shadow-sm rounded-4 border-0 mb-4">
            <div class="card-header text-white py-3 rounded-top-4" style="background-color: #534582">
                <h5 class="mb-0"><i class="fas fa-search me-2"></i> Pencarian Buku</h5>
            </div>
            <div class="card-body p-4">
                <form method="GET" action="{{ route('home') }}">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg rounded-start-pill" name="search" placeholder="Cari berdasarkan judul atau kategori..." value="{{ $search ?? '' }}">
                        <button class="btn btn-lg rounded-end-pill px-4" type="submit" style="background-color: #534582; color: white;">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($search) && $bukus->isEmpty())
            <div class="alert alert-warning rounded-4 shadow-sm border-0">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x me-3 text-warning"></i>
                    <div>
                        <h5 class="mb-1">Tidak Ditemukan</h5>
                        <p class="mb-0">Buku atau kategori dengan kata kunci "<strong>{{ $search }}</strong>" tidak ditemukan. Silakan coba kata kunci lain.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tabel Buku-->
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header text-white py-3 rounded-top-4" style="background-color: #534582">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-books me-2"></i> Daftar Buku</h5>
                    <span class="badge bg-white" style="color: #846DCF;">{{ count($bukus) }} buku</span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="bukusTable" class="table table-hover table-striped align-middle w-100 mt-3">
                        <thead>
                            <tr>
                                <th class="text-center">Judul Buku</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Penerbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukus as $buku)
                            <tr>
                                <td class="text-center"><strong>{{ $buku->nama_buku }}</strong></td>
                                <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-dark">{{ $buku->kategori }}</span></td>
                                <td class="text-center">Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($buku->stok > 10)
                                        <span class="badge bg-success">{{ $buku->stok }}</span>
                                    @elseif($buku->stok > 0)
                                        <span class="badge bg-danger text-light">{{ $buku->stok }}</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                                <td class="text-center"><span class="text-muted"><i class="fas fa-building me-1"></i> {{ $buku->dataPenerbitBuku->nama }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    /* Custom Font Styling */
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    /* Rounded Elements */
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    .rounded-top-4 {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }
    
    /* Custom DataTables Styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #dc3545 !important;
        color: white !important;
        border-color: #dc3545 !important;
        border-radius: 50px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f8d7da !important;
        color: #dc3545 !important;
        border-color: #dc3545 !important;
        border-radius: 50px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50px;
        margin: 0 2px;
    }
    
    .dataTables_wrapper .dataTables_info {
        color: #6c757d;
        padding-top: 1rem;
    }
    
    .dataTables_filter input, .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    
    .dataTables_filter input:focus, .dataTables_length select:focus {
        border-color: #f8d7da;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        outline: none;
    }
    
    .dataTable thead {
        background-color: #dc3545;
        color: white;
    }
    
    .dataTable thead th {
        border-bottom: none !important;
        padding: 1rem 0.75rem;
    }
    
    .dataTable tbody tr:nth-of-type(odd) {
        background-color: rgba(220, 53, 69, 0.05);
    }
    
    .dataTable tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
    
    .dataTable tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    $('#bukusTable').DataTable({
        responsive: true,
        dom: '<"row align-items-center"<"col-sm-6"l><"col-sm-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row align-items-center mt-3"<"col-sm-5"i><"col-sm-7 d-flex justify-content-end"p>>',
        language: {
            search: "",
            searchPlaceholder: "Cari data...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        }
    });
// Add additional spacing after the table
$('#bukusTable').wrap('<div class="table-container mb-2"></div>');

        // Enhance search input
        $('.dataTables_filter input').addClass('shadow-sm');
        $('.dataTables_length select').addClass('shadow-sm');
    });
</script>
@endpush