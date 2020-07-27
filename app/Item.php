<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'amount',
        'qty'
    ];
}
