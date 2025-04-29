@extends('layout.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">{{ isset($penerbit) ? 'Edit Penerbit' : 'Tambah Penerbit Baru' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.penerbit.store') }}" method="POST">
                @csrf
                
                <!-- ID Penerbit -->
                <div class="mb-3">
                    <label for="id" class="form-label fw-semibold">ID Penerbit</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" 
                           pattern="[A-Z]{2}[0-9]{2}" placeholder="Masukkan ID Penerbit (contoh: PB01)" 
                           value="{{ old('id', $penerbit->id ?? '') }}" 
                           {{ isset($penerbit) ? 'readonly' : '' }} 
                           title="ID Penerbit harus terdiri dari 2 huruf besar di awal dan 2 angka di akhir">
                    <small class="form-text text-muted">Format: 2 huruf kapital diikuti 2 angka.</small>
                    @error('id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Penerbit -->
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Penerbit</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama Penerbit"
                           value="{{ isset($penerbit) ? $penerbit->nama : old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan Alamat Penerbit" rows="3">{{ isset($penerbit) ? $penerbit->alamat : old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kota -->
                <div class="mb-3">
                    <label for="kota" class="form-label fw-semibold">Kota</label>
                    <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" placeholder="Masukkan Kota Penerbit"
                           value="{{ isset($penerbit) ? $penerbit->kota : old('kota') }}">
                    @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Telepon -->
                <div class="mb-3">
                    <label for="telepon" class="form-label fw-semibold">Telepon</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkan Nomor Telepon Penerbit"
                           value="{{ isset($penerbit) ? $penerbit->telepon : old('telepon') }}">
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>{{ isset($penerbit) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
