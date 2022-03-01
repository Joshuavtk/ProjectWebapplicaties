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
        Schema::create('timezones', function (Blueprint $blueprint){
            $blueprint->uuid('id')->primary()->default('uuid()');
            $blueprint->integer('offset');
            $blueprint->text('description');
            $blueprint->uuid('created_by')->index();
            $blueprint->uuid('updated_by')->index()->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();

            $blueprint->foreign('created_by')->references('id')->on('users');
            $blueprint->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('stations', function (Blueprint $blueprint){
            $blueprint->uuid('id')->primary()->default('uuid()');
            $blueprint->uuid('timezone_id')->index();
            $blueprint->uuid('created_by')->index();
            $blueprint->uuid('updated_by')->index()->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();

            $blueprint->foreign('timezone_id')->references('id')->on('timezones');
            $blueprint->foreign('created_by')->references('id')->on('users');
            $blueprint->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('measurements', function (Blueprint $blueprint){
            $blueprint->uuid('id')->primary()->default('uuid()');
            $blueprint->uuid('station_id')->index();
            $blueprint->double('temperature');
            $blueprint->double('DEWP');
            $blueprint->double('STP');
            $blueprint->double('SLP');
            $blueprint->double('VISIB');
            $blueprint->double('WDSP');
            $blueprint->double('PRCP');
            $blueprint->double('SNDP');
            $blueprint->double('CLDC');
            $blueprint->double('WNDDIR');
            $blueprint->char('FRSHTT',6);
            $blueprint->uuid('created_by')->index();
            $blueprint->uuid('updated_by')->index()->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();

            $blueprint->foreign('station_id')->references('id')->on('stations');
            $blueprint->foreign('created_by')->references('id')->on('users');
            $blueprint->foreign('updated_by')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropDatabaseIfExists('timezones');
        Schema::dropDatabaseIfExists('measurements');
        Schema::dropDatabaseIfExists('stations');
    }
};
