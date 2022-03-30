<?php

namespace App\Models;

use App\Traits\Blendable;
use App\Traits\EncryptPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class Measurement extends Model
{
    use  Authorizable, HasFactory, EncryptPassword, Blendable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * All visable attribute when toArray is called.
     *
     * @var string[]
     */
    protected $visible = [];

    public $incrementing = false;
    protected $keyType = 'string';

    //Geeft het timezone object terug
    public function station(): HasOne
    {
        return $this->hasOne(Station::class, 'station_id', 'id');
    }
}
