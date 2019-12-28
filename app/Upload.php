<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'upload';

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function fileupload()
    {
        return $this->hasMany(FileUpload::class);
    }
}
