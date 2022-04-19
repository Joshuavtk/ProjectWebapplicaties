<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    public $timestamps = false;
    protected $table = 'report';

    public function station()
    {
        return $this->hasOne(related: Station::class);
    }
}
