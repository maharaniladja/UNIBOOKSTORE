@extends('layout.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">{{ isset($buku) ? 'Edit Buku' : 'Tambah Buku Baru' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.buku.store') }}" method="POST">
                @csrf
                
                <!-- ID Buku -->
                <div class="mb-3">
                    <label for="id" class="form-label fw-semibold">ID Buku</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" 
                           pattern="[A-Z]{2}[0-9]{3}" placeholder="Masukkan ID Buku (contoh: AB123)" 
                           value="{{ old('id', $buku->id ?? '') }}" 
                           {{ isset($buku) ? 'readonly' : '' }} 
                           title="ID Buku harus terdiri dari 2 huruf besar di awal dan 3 angka di akhir">
                    <small class="form-text text-muted">Format: 2 huruf kapital diikuti 3 angka.</small>
                    @error('id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Buku -->
                <div class="mb-3">
                    <label for="nama_buku" class="form-label fw-semibold">Nama Buku</label>
                    <input type="text" class="form-control @error('nama_buku') is-invalid @enderror" id="nama_buku" name="nama_buku" placeholder="Masukkan Nama Buku"
                           value="{{ isset($buku) ? $buku->nama_buku : old('nama_buku') }}">
                    @error('nama_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-semibold">Kategori</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" placeholder="Masukkan Kategori Buku"
                           value="{{ isset($buku) ? $buku->kategori : old('kategori') }}">
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Buku" value="{{ old('harga', $buku->harga ?? '') }}">
                    </div>
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label fw-semibold">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Masukkan Stok Buku"
                           value="{{ isset($buku) ? $buku->stok : old('stok') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penerbit -->
                <div class="mb-3">
                    <label for="id_penerbit" class="form-label fw-semibold">Penerbit</label>
                    <select class="form-control @error('id_penerbit') is-invalid @enderror" id="id_penerbit" name="id_penerbit">
                        <option value="">-- Pilih Penerbit --</option>
                        @foreach($penerbits as $penerbit)
                            <option value="{{ $penerbit->id }}" {{ (isset($buku) && $buku->id_penerbit == $penerbit->id) ? 'selected' : (old('id_penerbit') == $penerbit->id ? 'selected' : '') }}>
                                {{ $penerbit->nama }} - {{ $penerbit->kota }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>{{ isset($buku) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
