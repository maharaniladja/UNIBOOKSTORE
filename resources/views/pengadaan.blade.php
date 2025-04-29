@extends('layout.app')

@section('title', 'Pengadaan')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h2 class="card-title fw-bold text-center mb-4">
                <i class="fas fa-clipboard-list me-2" style="color: #534582;"></i> Laporan Pengadaan Buku
            </h2>
            
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Perhatian:</strong> Buku dengan stok kurang dari atau sama dengan 10 ditandai dengan warna merah dan perlu segera ditambah stoknya.
            </div>
            
            <div class="table-responsive">
                <table id="pengadaanTable" class="table table-hover table-striped table align-middle mt-2">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">ID Buku</th>
                            <th class="text-center">Judul Buku</th>
                            <th class="text-center">Penerbit</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukus as $buku)
                        <tr class="{{ $buku->stok <= 10 ? 'low-stock-row' : '' }}">
                            <td class="text-center fw-bold">{{ $buku->id }}</td>
                            <td class="fw-semibold">{{ $buku->nama_buku }}</td>
                            <td class="text-center fw-bold">{{ $buku->dataPenerbitBuku->nama }}</td>
                            <td class="text-center">
                                <span class="badge stock-badge {{ $buku->stok <= 10 ? 'low-stock' : '' }}">
                                    {{ $buku->stok }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($buku->stok <= 10)
                                    <span class="badge bg-danger text-white">
                                        <i class="fas fa-exclamation-circle me-1"></i> Perlu Restock
                                    </span>
                                @else
                                    <span class="badge bg-success text-white">
                                        <i class="fas fa-check-circle me-1"></i> Stok Cukup
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    /* DataTable Custom Styling */
    #pengadaanTable {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(217, 4, 41, 0.1);
        border-collapse: separate;
        border-spacing: 0;
    }
    
    #pengadaanTable thead tr {
        background-color: #d90429;
        color: white;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    #pengadaanTable thead th {
        padding: 12px 16px;
        border: none;
    }
    
    #pengadaanTable tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #ffe5e5;
    }
    
    #pengadaanTable tbody tr:last-child {
        border-bottom: none;
    }
    
    #pengadaanTable tbody tr:hover {
        background-color: rgba(217, 4, 41, 0.04);
        transform: translateY(-2px);
    }
    
    #pengadaanTable tbody td {
        padding: 12px 16px;
        border: none;
    }
    
    /* Styling untuk baris dengan stok rendah */
    .low-stock-row {
        background-color: rgba(217, 4, 41, 0.1);
        color: #d90429;
        font-weight: 500;
    }
    
    .low-stock-row:hover {
        background-color: rgba(217, 4, 41, 0.15) !important;
    }
    
    .low-stock-row td {
        border-bottom: 1px solid rgba(217, 4, 41, 0.2);
    }
    
    .stock-badge {
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        min-width: 45px;
        display: inline-block;
    }
    
    .low-stock {
        background-color: #d90429;
        color: white;
        animation: pulse-red 2s infinite;
    }
    
    @keyframes pulse-red {
        0% {
            box-shadow: 0 0 0 0 rgba(217, 4, 41, 0.7);
        }
        70% {
            box-shadow: 0 0 0 6px rgba(217, 4, 41, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(217, 4, 41, 0);
        }
    }
    
    /* .good-stock {
        background-color: #2b9348;
        color: white;
    } */
    
    /* DataTables Custom Controls */
    .dataTables_wrapper .dataTables_length, 
    .dataTables_wrapper .dataTables_filter, 
    .dataTables_wrapper .dataTables_info, 
    .dataTables_wrapper .dataTables_paginate {
        margin-bottom: 10px;
        margin-top: 10px;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid rgba(217, 4, 41, 0.2);
        padding: 5px 30px 5px 10px;
        border-radius: 20px;
        background-position: right 10px center;
        font-size: 0.875rem;
        color: #555;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid rgba(217, 4, 41, 0.2);
        border-radius: 20px;
        padding: 6px 12px 6px 35px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23d90429' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 12px center;
        margin-left: 10px;
        font-size: 0.875rem;
    }
    
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 15px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 4px;
        margin: 0 2px;
        padding: 5px 10px;
        color: #d90429 !important;
        border: 1px solid transparent;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #d90429 !important;
        color: white !important;
        border: 1px solid #d90429;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(217, 4, 41, 0.1) !important;
        border: 1px solid rgba(217, 4, 41, 0.2);
        color: #d90429 !important;
    }
    
    .dataTables_wrapper .dataTables_info {
        color: #666;
        font-size: 0.875rem;
    }
    
    .dataTables_scrollBody {
        border-bottom: none !important;
    }
    
    /* Empty state styling */
    .dataTables_empty {
        background-color: #fff0f0;
        padding: 24px !important;
        font-style: italic;
        color: #d90429;
        text-align: center;
    }
</style>

<script>
    $(document).ready(function() {
        $('#pengadaanTable').DataTable({
            responsive: true,
            order: [[5, 'asc']], // Urutkan berdasarkan stok terkecil
            dom: '<"row align-items-center"<"col-sm-6"l><"col-sm-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row align-items-center mt-3"<"col-sm-5"i><"col-sm-7 d-flex justify-content-end"p>>',
            language: {
                search: "",
                searchPlaceholder: "Cari buku...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                // info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                },
                infoEmpty: "Tidak ada data yang tersedia",
                emptyTable: "Tidak ada data buku untuk pengadaan"
            }
        });
        
        // Highlight rows with low stock
        $('.low-stock-row').each(function() {
            $(this).css('background-color', 'rgba(217, 4, 41, 0.1)');
        });
        
        // Add a container class to help with styling
        $('.dataTables_wrapper').addClass('dt-custom-container');
    });
</script>
@endpush