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
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* * ************************ Application Configuration ******************* */
define('ALLOW_MODIFICATION', 1);
//define('PERMISSION_ERROR_MSG', 'You are not authorize to operate on the module');
define('PERMISSION_ERROR_MSG','Modification in demo version is not allowed.');

//Image paths
define('IMG_ALLOWED_TYPES', 'jpg|png|jpeg|JPG|PNG|JPEG|webp');
define('IMG_ALLOWED_WITH_SVG_TYPES', 'jpg|png|jpeg|svg');

define('CATEGORY_IMG_PATH', 'images/category/');
define('SUBCATEGORY_IMG_PATH', 'images/subcategory/');
define('QUESTION_IMG_PATH', 'images/questions/');
define('NOTIFICATION_IMG_PATH', 'images/notifications/');
define('CONTEST_IMG_PATH', 'images/contest/');
define('CONTEST_QUESTION_IMG_PATH', 'images/contest-question/');
define('GUESS_WORD_IMG_PATH', 'images/guess-word/');
define('USER_IMG_PATH', 'images/profile/');
define('LOGO_IMG_PATH', 'images/');
define('BADGE_IMG_PATH', 'images/badges/');
define('FUN_LEARN_IMG_PATH', 'images/fun-n-learn/');
define('EXAM_QUESTION_IMG_PATH', 'images/exam-question/');
define('MATHS_QUESTION_IMG_PATH', 'images/maths-questions/');
define('SLIDER_IMG_PATH', 'images/slider/');
define('WEB_SETTINGS_LOGO_PATH', 'images/web-settings/');
define('WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES', 'jpg|png|jpeg|svg');
define('WEB_HOME_SETTINGS_LOGO_PATH', 'images/web-home-settings/');
define('LANGUAGE_FILE_PATH', 'upload/languages/');
define('LANGUAGE_FILE_ALLOWED_TYPES', 'json');
define('COIN_STORE_IMG_PATH', 'images/coin-store/');

//audio path
define('QUESTION_AUDIO_PATH', 'images/audio/');
define('AUDIO_ALLOWED_TYPES', 'mp3|mp4|ogv|wav|aac|msv|wav|wma|ogg|MP3|MP4|OGV|WAV|AAC|MSV|WAV|WMA|OGG');

//button class
define('BUTTON_CLASS', 'btn btn-primary');
define('SUCCESS_MSG_CLASS', 'alert alert-success');
define('ERROR_MSG_CLASS', 'alert alert-danger');

//constant messgae
define('IMAGE_ALLOW_MSG', 'Only png, jpg and jpeg or webp image allow..!');
define('IMAGE_ALLOW_PNG_JPG_MSG', 'Only png, jpg or jpeg image allow..!');
define('IMAGE_ALLOW_PNG_JPG_SVG_MSG', 'Only png, jpg ,jpeg or svg image allow..!');
define('INVALID_IMAGE_TYPE', 'Invalid Image Type');
define('AUDIO_ALLOW_MSG', 'Only Audio allow..!');
define('INVALID_AUDIO_TYPE', 'Invalid Audio Type');
define('INVALID_FILE_TYPE', 'Invalid File Type');
define('AUDIO_TIME_ERROR', 'Audio file length is too long to upload');

//API constant messgae
define('INVALID_KEY_MSG', 'invalid access key');
define('NO_DATA_MSG', 'data not found');
define('PLEASE_FILL_MSG', 'please fill all the data and submit');
define('CONTEST_PLAYED_MSG', 'contest you have played');
define('DATA_INSERT_MSG', 'data insert successfully');
define('DATA_UPDATE_MSG', 'data update successfully');
