<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = "komponen";

    public function uploadkomponen()
    {
        return $this->hasMany(UploadKomponen::class, 'komponen_id');
    }
}
