<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemInfo extends Model
{
    protected $table = 'systeminfo';
    protected $fillable = [
        'section', 'value'
    ];
}
