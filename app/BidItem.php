<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidItem extends Model
{
    protected $fillable = [
            'bid_id',
            'item_id'
        ];
}
