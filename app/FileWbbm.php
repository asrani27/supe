<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileWbbm extends Model
{
    protected $table = "filewbbm";
    
    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }
}
