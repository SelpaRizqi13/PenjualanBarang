<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarangM extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','nama_jenisbarang', 'deskripsi'
    ];

    public function penjalanbarang()
    {
        # code...
        return $this->hasMany(PenjualanBarangT::class);
    }

    public function barang()
    {
        return $this->belongsTo(BarangM::class, 'barang_id', 'id');
    }
}
