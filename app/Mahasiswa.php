<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nim', 'nama','jenis_kelamin', 'alamat', 'no_telp', 'id_kelas'];
    
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
