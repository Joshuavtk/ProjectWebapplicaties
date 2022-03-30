<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'station';

    protected $primaryKey = 'name';

    public $incrementing = false;
}
