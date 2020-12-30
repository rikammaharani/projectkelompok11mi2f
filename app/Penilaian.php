<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = ['id_mahasiswa', 'id_matkul', 'nilai', 'nilai_setara', 'nilai_huruf'];
    
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    public function matkul()
    {
        return $this->belongsTo('App\MataKuliah', 'id_matkul');
    }
}
