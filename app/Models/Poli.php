<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['nama', 'keterangan'];

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'poli_id');
    }
}
