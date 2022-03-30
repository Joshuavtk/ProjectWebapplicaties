<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $db_name = config('database.connections.mysql.database');
        $sql = "
        use " . $db_name . ";
    CREATE TRIGGER correct_measurement BEFORE INSERT ON " . $db_name . ".weather_data
         FOR EACH ROW
         BEGIN
             SELECT ROUND(SUM(lastValues.temp) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
             IF NEW.temp IS NULL THEN
                SET NEW.temp = @result;
             ELSEIF NEW.temp > @result * 1.2 OR NEW.temp < @result * 0.8 THEN
                SET NEW.temp = ROUND(@result * (-0.8+0.4*RAND()), 1);
             END IF;

             SELECT ROUND(SUM(lastValues.dew_point_temp) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
             IF NEW.dew_point_temp IS NULL THEN
                SET NEW.dew_point_temp = @result;
             ELSEIF NEW.dew_point_temp > @result * 1.2 OR NEW.dew_point_temp < @result * 0.8 THEN
                SET NEW.dew_point_temp = ROUND(@result * (-0.8+0.4*RAND()), 1);
             END IF;

             IF NEW.station_air_pressure IS NULL THEN
                SELECT ROUND(SUM(lastValues.station_air_pressure) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.station_air_pressure = @result;
             END IF;

             IF NEW.sea_level_air_pressure IS NULL THEN
                SELECT ROUND(SUM(lastValues.sea_level_air_pressure) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.sea_level_air_pressure = @result;
             END IF;

             IF NEW.visibility IS NULL THEN
                SELECT ROUND(SUM(lastValues.visibility) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.visibility = @result;
             END IF;

             IF NEW.wind_speed IS NULL THEN
                SELECT ROUND(SUM(lastValues.wind_speed) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.wind_speed = @result;
             END IF;

             IF NEW.precipitation IS NULL THEN
                SELECT ROUND(SUM(lastValues.precipitation) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.precipitation = @result;
             END IF;

             IF NEW.snow_depth IS NULL THEN
                SELECT ROUND(SUM(lastValues.snow_depth) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.snow_depth = @result;
             END IF;

             IF NEW.cloud_cover_percentage IS NULL THEN
                SELECT ROUND(SUM(lastValues.cloud_cover_percentage) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.cloud_cover_percentage = @result;
             END IF;

             IF NEW.wind_direction IS NULL THEN
                SELECT ROUND(SUM(lastValues.wind_direction) / COUNT(*), 1) INTO @result FROM (SELECT * FROM weather_data WHERE station_name = NEW.station_name ORDER BY id DESC LIMIT 30) AS lastValues;
                SET NEW.wind_direction = @result;
             END IF;
        END;
";

        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $db_name = config('database.connections.mysql.database');
        DB::statement("DROP TRIGGER IF EXISTS " . $db_name . ".correct_measurement;");
    }
};
