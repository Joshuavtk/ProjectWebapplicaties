<?php

namespace App\Models;

use App\Traits\Blendable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use Blendable, SoftDeletes;

    protected $fillable = ['name','datetime','description'];
}
