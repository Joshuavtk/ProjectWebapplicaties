TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`%` trigger trigger_validate_temperature_before_insert before insert ON `measurements`\n    for each row\nbegin\n    set @stationID = null;\n    set @newThmperature = 0.0;\n    call validTemperatureCheck(\n            new.station_id,\n            new.temperature,\n            @valid\n        );\n\n    if(@valid < 0) then\n        signal sqlstate \'45000\' set message_text = \'Invalid record\';\n    end if;\nend'
sql_modes=1411383296
definers='root@%'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='utf8mb4_general_ci'
created=164621486601
