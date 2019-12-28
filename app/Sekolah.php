<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function sekolah()
    {
        return $this->hasMany(Pegawai::class);
    }
    
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
