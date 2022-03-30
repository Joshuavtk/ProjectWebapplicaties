TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`%` TRIGGER trigger_insert_validate_code_after_insert AFTER INSERT ON `users` FOR EACH ROW BEGIN update `users` set `validation_code` = LPAD(FLOOR(RAND() * 999999.99), 6, "0") where `id` = new.id; END'
sql_modes=1168113696
definers='root@%'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=164621333025
