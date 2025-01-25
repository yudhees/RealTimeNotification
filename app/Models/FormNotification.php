<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FormNotification extends Model
{
    protected $guarded=[];

    public function getFileUrl()
    {
        $file=$this->fileName;
        if(empty($file))return null;
        return asset('storage/form/'.$file);
    }
}
