<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    // This is a generic model idea. In many apps rows belong to dynamic tables.
    protected $table = 'rows';
    protected $guarded = [];
}
