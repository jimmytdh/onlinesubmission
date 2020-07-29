<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'project_id',
        'ref_no',
        'company',
        'bidder',
        'contact',
        'financial_file',
        'technical_file',
        'status',
        'remarks'
    ];
}
