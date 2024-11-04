<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['user_id', 'nik', 'first_name', 'last_name', 'phone_number', 'email', 'gender', 't_lahir', 'd_lahir'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
