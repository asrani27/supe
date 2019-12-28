<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadKomponen extends Model
{
    protected $table = "uploadkomponen";

    public function komponen()
    {
        return $this->belongsTo(UploadKomponen::class, 'komponen_id');
    }
}
