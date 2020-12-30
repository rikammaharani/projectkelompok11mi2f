<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = ['nama_matkul','sks'];

    public function dosen()
    {
        return $this->hasMany('App\Dosen');
    }
}
