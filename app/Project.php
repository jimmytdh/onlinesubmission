<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'cat_id',
        'name',
        'bac_no',
        'ABC',
        'status',
        'date_open',
        'awarded'
    ];
}
