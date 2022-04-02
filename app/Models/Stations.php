<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    public $incrementing = false;
    protected $fillable = ['name','datetime'];

    public function measurement(){
        return $this->belongsTo(Measurement::class,'station_id','name');
    }
}
