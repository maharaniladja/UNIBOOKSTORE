<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'nama', 'alamat', 'kota', 'telepon'];
    protected $table = 'penerbits';

    public function dataBukuPenerbit()
    {
        return $this->hasMany(Buku::class, 'id_penerbit', 'id');
    }
}
