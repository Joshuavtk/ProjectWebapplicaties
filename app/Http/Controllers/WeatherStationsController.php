<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationCollection;
use App\Http\Resources\StationResource;
use App\Http\Resources\WeatherCollection;
use App\Models\Measurement;
use App\Models\Station;
use App\Models\Stations;
use App\Models\WeatherData;
use Illuminate\Http\Request;

class WeatherStationsController extends Controller
{
//    public function create(Request $request)
//    {
//
//        Measurement::insert($request->json('WEATHERDATA')));
//        return Measurement::create();
//    }

    public function index()
    {
        return WeatherData::all();
    }

    public function receive(Request $request) {


        if ($request->post('WEATHERDATA') == null) {
            return "Error";
        }

        foreach($request->post('WEATHERDATA') as $row) {
            $data = new WeatherData ;

            $data->station_name = $row['STN'];
            $data->datetime = $row['DATE'] . ' ' . $row['TIME'];
            $data->temp = $row['TEMP'] == "None" ? null : $row['TEMP'];
            $data->dew_point_temp = $row['DEWP'] == "None" ? null : $row['DEWP'];
            $data->station_air_pressure = $row['STP'] == "None" ? null : $row['STP'];
            $data->sea_level_air_pressure = $row['SLP'] == "None" ? null : $row['SLP'];
            $data->visibility = $row['VISIB'] == "None" ? null : $row['VISIB'];
            $data->wind_speed = $row['WDSP'] == "None" ? null : $row['WDSP'];
            $data->precipitation = $row['PRCP'] == "None" ? null : $row['PRCP'];
            $data->snow_depth = $row['SNDP'] == "None" ? null : $row['SNDP'];

            if ($row['FRSHTT'] !== "") {
                $frshtt = str_split($row['FRSHTT']);
                $data->frost = $frshtt[0];
                $data->rain = $frshtt[1];
                $data->snow = $frshtt[2];
                $data->hail = $frshtt[3];
                $data->thunderstorm = $frshtt[4];
                $data->tornado = $frshtt[5];
            }

            $data->cloud_cover_percentage = $row['CLDC'] == "None" ? null : $row['CLDC'];
            $data->wind_direction = $row['WNDDIR'] == "None" ? null : $row['WNDDIR'];

            $data->save();
        }
        return "Success";
    }

    public function get() {
        return WeatherData::all();
    }

    public function showStation($station_name) {
        $station = Station::all()->where('name', '=', $station_name)->first();
        return ['station' => $station, 'measurements' => $station->weatherData];
    }

    public function getStations()
    {
        return Station::with('weatherData')->has('weatherData')->get();
    }
}
