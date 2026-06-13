<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = ['pasien_id', 'nama_tes', 'hasil', 'tanggal'];

  
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}