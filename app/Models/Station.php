<?php

namespace App\Models;

use App\Traits\Blendable;
use App\Traits\EncryptPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class Station extends Model
{
    use  Authorizable, HasFactory, EncryptPassword, Blendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'longitude', 'latitude', 'elevation'];

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
    protected $visible = ['name', 'longitude', 'latitude', 'elevation'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected $primaryKey = 'name';

    //Geeft het timezone object terug
    public function timezone(): HasOne
    {
        return $this->hasOne(Timezone::class, 'timezone_id', 'id');
    }

    //Geeft een collectie van alle measurements terug
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class, 'id', 'station_id');
    }

    protected $table = 'station';

    public function weatherData(): HasMany
    {
        return $this->hasMany(WeatherData::class, 'station_name', 'name');
    }
}
