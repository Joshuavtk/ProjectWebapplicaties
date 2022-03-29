<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->integer("station_nr");
            $table->dateTime('datetime');
            $table->decimal('temp');
            $table->decimal('dew_point_temp');
            $table->decimal('station_air_pressure');
            $table->decimal('sea_level_air_pressure');
            $table->decimal('visibility');
            $table->decimal('wind_speed');
            $table->decimal('precipitation');
            $table->decimal('snow_depth');
            $table->boolean('frost')->default(false);
            $table->boolean('rain')->default(false);
            $table->boolean('snow')->default(false);
            $table->boolean('hail')->default(false);
            $table->boolean('thunderstorm')->default(false);
            $table->boolean('tornado')->default(false);
            $table->decimal('cloud_cover_percentage');
            $table->integer('wind_direction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_data');
    }
};
