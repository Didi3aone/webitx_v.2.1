<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-18 08:18:47 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 08:18:58 --> Query error: Unknown column 'user_login_time' in 'field list' - Invalid query: INSERT INTO `t_log_activityuser` (`username`, `user_login_time`, `user_activity`, `activity_date`, `user_ip_address`) VALUES ('root', '2019-04-18 08:18:58', 'User telah login pada sistem', '2019-04-18 08:18:58', '::1')
ERROR - 2019-04-18 08:23:52 --> 404 Page Not Found: /index
ERROR - 2019-04-18 08:23:53 --> 404 Page Not Found: /index
ERROR - 2019-04-18 08:53:13 --> 404 Page Not Found: /index
ERROR - 2019-04-18 08:53:22 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 08:53:29 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 08:53:47 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `tm_user` SET `created_at` = 1555552427, `created_by` = NULL, `updated_at` = 1555552427, `updated_by` = NULL
WHERE `user_id` IS NULL
ERROR - 2019-04-18 08:54:06 --> Query error: Unknown column 'updated_by' in 'field list' - Invalid query: UPDATE `tm_user` SET `created_at` = 1555552446, `created_by` = NULL, `updated_at` = 1555552446, `updated_by` = NULL
WHERE `id` IS NULL
ERROR - 2019-04-18 08:55:21 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 150
ERROR - 2019-04-18 08:55:21 --> Query error: Unknown column 'created_at' in 'field list' - Invalid query: INSERT INTO `t_log_activityuser` (`created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (1555552521, NULL, 1555552521, NULL)
ERROR - 2019-04-18 09:03:36 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 151
ERROR - 2019-04-18 09:03:36 --> Query error: Unknown column 'is_date' in 'field list' - Invalid query: INSERT INTO `t_log_activityuser` (`is_date`, `username`, `userlogout_time`, `user_activity`, `activity_date`, `user_ip_address`, `user_device`, `user_city_activity`, `user_agent`) VALUES (0, NULL, '2019-04-18 09:03:36', 'User telah logout pada sistem', '2019-04-18 09:03:36', '::1', NULL, NULL, NULL)
ERROR - 2019-04-18 09:05:06 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 151
ERROR - 2019-04-18 09:05:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' 2019-04-18 09:05:06, User telah logout pada sistem, 2019-04-18 09:05:06, ::1, ,' at line 1 - Invalid query: INSERT INTO t_log_activityuser (username, userlogout_time, user_activity, activity_date, user_ip_address, user_device, user_city_activity, user_agent) VALUES (, 2019-04-18 09:05:06, User telah logout pada sistem, 2019-04-18 09:05:06, ::1, , , )
ERROR - 2019-04-18 09:05:49 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 151
ERROR - 2019-04-18 09:05:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' 2019-04-18 09:05:49, User telah logout pada sistem, 2019-04-18 09:05:49, ::1, ,' at line 1 - Invalid query: INSERT INTO t_log_activityuser (username, userlogout_time, user_activity, activity_date, user_ip_address, user_device, user_city_activity, user_agent) VALUES (, 2019-04-18 09:05:49, User telah logout pada sistem, 2019-04-18 09:05:49, ::1, , , )
ERROR - 2019-04-18 09:05:54 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 151
ERROR - 2019-04-18 09:05:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' 2019-04-18 09:05:54, User telah logout pada sistem, 2019-04-18 09:05:54, ::1, ,' at line 1 - Invalid query: INSERT INTO t_log_activityuser (username, userlogout_time, user_activity, activity_date, user_ip_address, user_device, user_city_activity, user_agent) VALUES (, 2019-04-18 09:05:54, User telah logout pada sistem, 2019-04-18 09:05:54, ::1, , , )
ERROR - 2019-04-18 09:05:57 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 09:06:06 --> Query error: Unknown column 'user_name' in 'where clause' - Invalid query: SELECT *
FROM `tm_user` `tu`
JOIN `tm_user_role` `tur` ON `tur`.`role_id` = `tu`.`user_role_id`
WHERE `user_name` = 'root'
ERROR - 2019-04-18 09:06:13 --> Query error: Unknown column 'tur.role_id' in 'on clause' - Invalid query: SELECT *
FROM `tm_user` `tu`
JOIN `tm_user_role` `tur` ON `tur`.`role_id` = `tu`.`user_role_id`
WHERE `username` = 'root'
ERROR - 2019-04-18 09:06:22 --> Query error: Unknown column 'tur.role_id' in 'on clause' - Invalid query: SELECT *
FROM `tm_user` `tu`
JOIN `tm_user_role` `tur` ON `tur`.`role_id` = `tu`.`role_id`
WHERE `username` = 'root'
ERROR - 2019-04-18 09:06:32 --> Severity: Notice --> Undefined index: user_password /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 64
ERROR - 2019-04-18 09:06:48 --> Severity: Notice --> Undefined index: user_id /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 75
ERROR - 2019-04-18 09:06:48 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `tm_user` SET `created_at` = 1555553208, `created_by` = NULL, `updated_at` = 1555553208, `updated_by` = NULL
WHERE `user_id` IS NULL
ERROR - 2019-04-18 09:07:01 --> Severity: Notice --> Undefined index: user_id /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 75
ERROR - 2019-04-18 09:07:01 --> Severity: Notice --> Undefined index: user_name /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 76
ERROR - 2019-04-18 09:07:01 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 222
ERROR - 2019-04-18 09:07:01 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 231
ERROR - 2019-04-18 09:07:01 --> Query error: Column 'username' cannot be null - Invalid query: INSERT INTO `t_log_activityuser` (`username`, `userlogin_time`, `user_activity`, `activity_date`, `user_ip_address`, `user_device`, `user_city_activity`, `user_agent`) VALUES (NULL, '2019-04-18 09:07:01', 'User telah login pada sistem', '2019-04-18 09:07:01', '::1', NULL, NULL, NULL)
ERROR - 2019-04-18 09:07:15 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 222
ERROR - 2019-04-18 09:07:15 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 231
ERROR - 2019-04-18 09:07:15 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:07:32 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:07:37 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:42 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:42 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:44 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:44 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:49 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:49 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:07:57 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 222
ERROR - 2019-04-18 09:07:57 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 231
ERROR - 2019-04-18 09:07:58 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:08:04 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 222
ERROR - 2019-04-18 09:08:04 --> Severity: Notice --> Undefined index: is_date /var/www/html/booking-room/application/models/Global_model.php 231
ERROR - 2019-04-18 09:08:06 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:28:59 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:29:05 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:29:53 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:29:54 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:29:56 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:29:59 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:35:42 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:35:46 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: SELECT *
FROM `tm_user`
WHERE `user_id` = '1'
ERROR - 2019-04-18 09:37:13 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:37:13 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:38:26 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:38:26 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:38:30 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 09:38:50 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:38:50 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:38:53 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:39:20 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:39:20 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:39:23 --> Severity: Notice --> Undefined variable: username /var/www/html/booking-room/application/modules/index/controllers/Index_admin.php 155
ERROR - 2019-04-18 09:39:23 --> Query error: Unknown column 'created_at' in 'field list' - Invalid query: INSERT INTO `t_log_activityuser` (`created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (1555555163, '1', 1555555163, '1')
ERROR - 2019-04-18 09:40:13 --> Query error: Unknown column 'created_at' in 'field list' - Invalid query: INSERT INTO `t_log_activityuser` (`created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (1555555213, '1', 1555555213, '1')
ERROR - 2019-04-18 09:44:29 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:44:29 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:45:21 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:45:21 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:49:26 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:49:26 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:49:49 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:49:49 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:50:04 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:50:05 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:52:17 --> 404 Page Not Found: /index
ERROR - 2019-04-18 09:52:17 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:36:47 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:36:47 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:40:31 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:40:31 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:40:48 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:40:48 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:41:19 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:41:20 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:41:47 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:41:47 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:12 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 11:42:16 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:16 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:41 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:41 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:43 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:42:43 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:22 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:22 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:24 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:24 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:41 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:43:42 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:45:22 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:45:22 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:45:30 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:45:30 --> 404 Page Not Found: /index
ERROR - 2019-04-18 11:47:05 --> 404 Page Not Found: ../modules/index/controllers//index
ERROR - 2019-04-18 12:45:47 --> 404 Page Not Found: /index
ERROR - 2019-04-18 12:45:47 --> 404 Page Not Found: /index
