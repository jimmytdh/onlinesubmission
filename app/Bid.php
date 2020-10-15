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
        'date_financial',
        'mfinancial_file',
        'date_mfinancial',
        'technical_file',
        'date_technical',
        'mtechnical_file',
        'date_mtechnical',
        'status',
        'final_status',
        'remarks'
    ];
}
