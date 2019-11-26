<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    //
    protected  $table = 'learn';

    protected $fillable = [
        'name', 'remark', 'score', 'class'
    ];
}
