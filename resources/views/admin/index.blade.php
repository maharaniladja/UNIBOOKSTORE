@extends('layout.app')

@section('title', 'Admin')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h2 class="card-title fw-bold text-center mb-4">
                <i class="fas fa-cogs me-2" style="color: #534582;"></i> Panel Admin
            </h2>
            
            <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-dark" id="buku-tab" data-bs-toggle="tab" data-bs-target="#buku" type="button">
                        <i class="fas fa-book me-2"></i> Data Buku
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-danger" id="penerbit-tab" data-bs-toggle="tab" data-bs-target="#penerbit" type="button">
                        <i class="fas fa-building me-2"></i> Data Penerbit
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="adminTabContent">
                <!-- Tab Buku -->
                <div class="tab-pane fade show active" id="buku" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold">Data Buku</h4>
                        <a href="{{ route('admin.buku.create') }}" class="btn" style="background-color: #534582; color: white;">
                            <i class="fas fa-plus me-1"></i> Tambah Buku
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="bukusTable" class="table table-hover align-middle mt-3">
                            <thead>
                                <tr class="text-center bg-danger text-white">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Judul Buku</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Penerbit</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bukus as $buku)
                                <tr class="border-bottom">
                                    <td class="text-center fw-bold">{{ $buku->id }}</td>
                                    <td class="text-center fw-semibold">{{ $buku->nama_buku }}</td>
                                    <td class="text-center"><span class="badge bg-light text-dark border">{{ $buku->kategori }}</span></td>
                                    <td class="text-center text-end fw-semibold">Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $buku->stok }}</td>
                                    <td class="text-center">{{ $buku->dataPenerbitBuku->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-sm btn-warning me-1 rounded-pill">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Tab Penerbit -->
                <div class="tab-pane fade" id="penerbit" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold">Data Penerbit</h4>
                        <a href="{{ route('admin.penerbit.create') }}" class="btn" style="background-color: #534582; color: white;">
                            <i class="fas fa-plus me-1"></i> Tambah Penerbit
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="penerbitTable" class="table table-hover align-middle mt-3">
                            <thead>
                                <tr class="text-center bg-danger text-white">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center"> Alamat</th>
                                    <th class="text-center">Kota</th>
                                    <th class="text-center">Telepon</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penerbits as $penerbit)
                                <tr class="border-bottom">
                                    <td class="text-center fw-bold">{{ $penerbit->id }}</td>
                                    <td class="text-center fw-semibold">{{ $penerbit->nama }}</td>
                                    <td class="text-center">{{ $penerbit->alamat }}</td>
                                    <td class="text-center">{{ $penerbit->kota }}</td>
                                    <td class="text-center">{{ $penerbit->telepon }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.penerbit.edit', $penerbit->id) }}" class="btn btn-sm btn-warning me-1 rounded-pill">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.penerbit.destroy', $penerbit->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    /* Custom table styling */
    .table {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-radius: 8px;
        overflow: hidden;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 2rem;
    }
    
    .table thead tr {
        background-image: linear-gradient(to right, #dc3545, #e35d6a);
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .table thead th {
        border: none;
        padding: 12px 15px;
        white-space: nowrap;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.05);
        transform: translateY(-2px);
    }
    
    .table tbody td {
        padding: 12px 15px;
        border-top: none;
        vertical-align: middle;
    }
    
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .badge {
        padding: 6px 10px;
        font-weight: 500;
    }
    
    /* DataTables custom styling */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        margin-left: 8px;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border-radius: 20px;
        padding: 4px 8px;
        border: 1px solid #ced4da;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50%;
        padding: 6px 12px;
        margin: 0 3px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #dc3545;
        border-color: #dc3545;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e35d6a;
        border-color: #e35d6a;
        color: white !important;
    }
</style>

<script>
    $(document).ready(function() {
        $('#bukusTable').DataTable({
            responsive: true,
            dom: '<"row align-items-center"<"col-sm-6"l><"col-sm-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row align-items-center mt-3"<"col-sm-5"i><"col-sm-7 d-flex justify-content-end"p>>',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari buku...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            }
        });
        
        $('#penerbitTable').DataTable({
            responsive: true,
            dom: '<"row align-items-center"<"col-sm-6"l><"col-sm-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row align-items-center mt-3"<"col-sm-5"i><"col-sm-7 d-flex justify-content-end"p>>',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari penerbit...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            }
        });
        
        // Aktifkan tab yang sesuai jika ada parameter URL
        var hash = window.location.hash;
        if (hash) {
            $('#adminTab button[data-bs-target="' + hash + '"]').tab('show');
        }

        // Ubah warna teks saat tab diaktifkan
        $('#adminTab button').on('shown.bs.tab', function (e) {
            // Reset semua tab ke warna merah
            $('#adminTab button').removeClass('text-dark').addClass('text-danger');
            // Set tab aktif ke warna hitam
            $(e.target).removeClass('text-danger').addClass('text-dark');
        });
    });
</script>
@endpush