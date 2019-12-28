<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
