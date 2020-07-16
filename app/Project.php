<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'bac_no',
        'ABC',
        'status',
        'date_open',
        'date_close',
        'awarded'
    ];
}
