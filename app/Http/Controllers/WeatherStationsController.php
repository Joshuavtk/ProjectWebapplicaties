<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use http\Exception\BadMethodCallException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeatherStationsController extends Controller
{
    /**
     * Alle endpoint voor het ontvangen van de data en het weergeven van de data van 1 of meerdere stations
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function receive(Request $request) {

        if ($request->post('WEATHERDATA') == null) {
            return;
        }

        foreach($request->post('WEATHERDATA') as $row) {
            $data = new WeatherData ;

            $frshtt = str_split($row['FRSHTT']);

            $data->station_nr = $row['STN'];
            $data->datetime = $row['DATE'] . ' ' . $row['TIME'];
            $data->temp = $row['TEMP'];
            $data->dew_point_temp = $row['DEWP'];
            $data->station_air_pressure = $row['STP'];
            $data->sea_level_air_pressure = $row['SLP'];
            $data->visibility = $row['VISIB'];
            $data->wind_speed = $row['WDSP'];
            $data->precipitation = $row['PRCP'];
            $data->snow_depth = $row['SNDP'];
            $data->frost = $frshtt[0];
            $data->rain = $frshtt[1];
            $data->snow = $frshtt[2];
            $data->hail = $frshtt[3];
            $data->thunderstorm = $frshtt[4];
            $data->tornado = $frshtt[5];
            $data->cloud_cover_percentage = $row['CLDC'];
            $data->wind_direction = $row['WNDDIR'];

            $data->save();
        }
    }

    public function get() {
        return WeatherData::all();
    }
}
