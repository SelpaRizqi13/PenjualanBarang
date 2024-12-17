<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangM extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','jenisbarang_id', 'nama_barang', 'stock'
    ];

    public function penjalanbarang()
    {
        return $this->hasMany(PenjualanBarangT::class);
    }

    public function jenisbarang()
    {
        return $this->belongsTo(JenisBarangM::class, 'jenisbarang_id', 'id');
    }
}
