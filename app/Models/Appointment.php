<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','judul', 'waktu_awal', 'waktu_akhir'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function loginpemakai()
    {
        return $this->belongsTo(User::class, 'createloginpemakai_id');
    }
}
