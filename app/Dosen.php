<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nip', 'nama','jenis_kelamin', 'alamat', 'no_telp', 'id_matkul'];
    
    public function matkul()
    {
        return $this->belongsTo('App\MataKuliah', 'id_matkul');
    }
}
