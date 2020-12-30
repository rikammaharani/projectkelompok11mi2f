<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas','tingkatan'];

    public function mahasiswa()
    {
        return $this->hasMany('App\Mahasiswa');
    }
}
