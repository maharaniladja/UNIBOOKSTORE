<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public $timestamps = true;
    public $incrementing = false;
    protected $fillable = ['id', 'kategori', 'nama_buku', 'harga', 'stok', 'id_penerbit'];
    protected $table = 'bukus';

    public function dataPenerbitBuku()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
}
