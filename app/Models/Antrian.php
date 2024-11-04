<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = ['no_antrian', 'tanggal', 'status', 'pengunjung_id', 'poli_id'];

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }
}
