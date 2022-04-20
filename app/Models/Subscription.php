<?php

namespace App\Models;

use App\Traits\Blendable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use Blendable, SoftDeletes;


    protected $keyType = 'string';
    protected $fillable = ['name','times_day','times_hour'];
}
