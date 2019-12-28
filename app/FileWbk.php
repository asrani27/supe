<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileWbk extends Model
{
    protected $table = "filewbk";

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }
}
