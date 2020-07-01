<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPriv extends Model
{
    protected $connection = 'tdh_user';
    protected $table = 'user_priv';
}
