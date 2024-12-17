<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarangT extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_awal', // Add this line
    ];


    public function barang()
    {
        return $this->belongsTo(BarangM::class, 'barang_id', 'id');
    }

    public function jenisbarang()
    {
        return $this->belongsTo(JenisBarangM::class, 'jenisbarang_id', 'id');
    }
}
