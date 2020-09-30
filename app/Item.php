<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'project_id',
        'item_no',
        'name',
        'unit',
        'amount',
        'qty'
    ];
}
