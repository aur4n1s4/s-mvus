<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['nama', 'foto', 'poli_id'];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }
}
