<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'fileupload';

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
