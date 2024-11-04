<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $fillable = ['nik', 'nama', 'telepon', 'alamat', 'jenis_kelamin', 't_lahir'];

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'pengunjung_id');
    }
}
