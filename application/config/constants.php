<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//other customer define constant
define("LAYOUT_HEADER_SIGN", "layout/header/header_sign");
define("LAYOUT_FOOTER_SIGN", "layout/footer/footer_sign");

define("LAYOUT_FOOTER_ADMIN", "layout/footer/footer");
define("LAYOUT_HEADER_ADMIN", "layout/header/header");

define('LAYOUT_FRONTEND_HEADER', 'layout/frontend/header');
define('LAYOUT_FRONTEND_FOOTER', 'layout/frontend/footer');

define("URL_HACKED", md5(sha1("12345678910abcdefghijklmnopqrstuvwxyz_didigantengs")));
define("URL_ENCODE", md5(sha1("antihackerhackerclub")));
define("IS_LOGIN", "IS_LOGIN");

define('ASSETS_FRONTEND_VENDOR_CSS', 'assets/frontend/vendor/');
define('ASSETS_FRONTEND_VENDOR_JS', 'assets/frontend/vendor/');
define('ASSETS_FRONTEND_JS', 'assets/frontend/js/');
define('ASSETS_FRONTEND_CSS', 'assets/frontend/css/');
define('ASSETS_FRONTEND_IMAGE', 'assets/frontend/img/');

define("ACTIVITY_LOGIN", "User telah login pada sistem");
define("ACTIVITY_LOGOUT", "User telah logout pada sistem");

//crud
define("GET_ALL_DATA", "all_data");
define("SINGLE_ROW", "single_row");
define("INSERT_DATA", "insert");
define("INSERT_NO_DATE", "insert_no_date");
define("UPDATE_DATA", "update");
define("DELETE_DATA", "delete");


//-- FILES UPLOAD
define("FILE_TYPE_UPLOAD", "*");

define("MAX_UPLOAD_IMAGE_SIZE", 10485760);
define("MAX_UPLOAD_IMAGE_SIZE_IN_KB", 10240);
define("WORDS_MAX_UPLOAD_IMAGE_SIZE", "10 MB");

define("MAX_UPLOAD_FILE_SIZE", 104857600);
define("MAX_UPLOAD_FILE_SIZE_IN_KB", 102400);
define("WORDS_MAX_UPLOAD_FILE_SIZE", "100 MB");

define('ACTIVE', 1);
define('NOTACTIVE', 0);
define('SELLER', 1);
define('BUYER', 2);
define('CANCEL_REQUEST', 0);
define('REQUESTED', 1);
define('INPROGRESS', 2);
define('WAITINGSIGN', 3);
define('SIGNCOMPLETE', 4);
define('REJECTED', 5);
define('API', 1);
define('WHITELABEL', 2);
define('TRAVELAGENT', 3);
define('PERMANENT', 1);
define('TEMPORARY', 2);
define('BUYER_API', 21);
define('BUYER_WHITELABEL', 22);
define('BUYER_TRAVELAGENT', 23);

define('NOW', date('Y-m-d H:i:s'));