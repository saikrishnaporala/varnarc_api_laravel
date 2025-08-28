<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $fillable = ['entity_id','path','original_name','mime'];
}
