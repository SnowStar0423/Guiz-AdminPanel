<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */

$route['default_controller'] = 'Login';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;


/* * ********* USER DEFINED ROUTES FOR ADMIN PANEL ****************** */
$route['loginMe'] = 'Login/loginMe';

$route['resetpassword'] = 'Login/resetpassword';
$route['checkOldPass'] = 'Login/checkOldPass';

$route['logout'] = 'Login/logout';

$route['Dashboard'] = 'Dashboard';
$route['dashboard-year/(:num)'] = 'Dashboard/getYearForMonthChart/$1';

$route['users'] = 'Dashboard/users';
$route['battle-statistics/(:num)'] = 'Dashboard/battle_statistics/$1';

$route['global-leaderboard'] = 'Dashboard/global_leaderboard';
$route['monthly-leaderboard'] = 'Dashboard/monthly_leaderboard';
$route['monthly-leaderboard/(:num)'] = 'Dashboard/monthly_leaderboard/$1';
$route['daily-leaderboard'] = 'Dashboard/daily_leaderboard';

$route['delete_multiple'] = 'Dashboard/delete_multiple';

$route['get_categories_of_language'] = 'Dashboard/get_categories_of_language';
$route['get_subcategories_of_category'] = 'Dashboard/get_subcategories_of_category';

$route['user-accounts-rights'] = 'Dashboard/users_accounts_rights';
$route['delete_accounts_rights'] = 'Dashboard/delete_accounts_rights';
$route['edit_accounts_rights'] = 'Dashboard/edit_accounts_rights';

$route['languages'] = 'Languages';
$route['delete_language'] = 'Languages/delete_language';

$route['main-category'] = 'Category';
$route['delete_category'] = 'Category/delete_category';
$route['category-order'] = 'Category/category_order';
$route['get-category-slug'] = 'Category/get_slug';
$route['verify-category-slug'] = 'Category/verify_slug';

$route['sub-category'] = 'Subcategory';
$route['get-subcategory-slug'] = 'Subcategory/get_slug';
$route['verify-subcategory-slug'] = 'Subcategory/verify_slug';
$route['delete_subcategory'] = 'Subcategory/delete_subcategory';

$route['create-questions'] = 'Questions';
$route['create-questions/(:num)'] = 'Questions/edit_questions/$1';
$route['manage-questions'] = 'Questions/manage_questions';
$route['delete_questions'] = 'Questions/delete_questions';
$route['daily-quiz'] = 'Questions/daily_quiz';
$route['get_daily_quiz'] = 'Questions/get_daily_quiz';
$route['add_daily_quiz'] = 'Questions/add_daily_quiz';
$route['question-reports'] = 'Questions/question_reports';
$route['question-reports/(:num)'] = 'Questions/edit_question_reports/$1';
$route['delete_question_report'] = 'Questions/delete_question_report';
$route['import-questions'] = 'Questions/import_questions';

$route['contest'] = 'Contest';
$route['delete_contest'] = 'Contest/delete_contest';
$route['contest-prize/(:num)'] = 'Contest/contest_prize/$1';
$route['delete_contest_prize'] = 'Contest/delete_contest_prize';
$route['contest-leaderboard/(:num)'] = 'Contest/contest_leaderboard/$1';
$route['contest-prize-distribute/(:num)'] = 'Contest/contest_prize_distribute/$1';
$route['contest-questions'] = 'Contest/contest_questions';
$route['delete_contest_questions'] = 'Contest/delete_contest_questions';
$route['contest-questions-import'] = 'Contest/contest_questions_import';

$route['fun-n-learn-category'] = 'Category';
$route['fun-n-learn-subcategory'] = 'Subcategory';
$route['fun-n-learn-category-order'] = 'Category/category_order';
$route['fun-n-learn'] = 'Fun_N_Learn';
$route['fun_learn_upload_img'] = 'Fun_N_Learn/upload_img';
$route['delete_fun_n_learn'] = 'Fun_N_Learn/delete_fun_n_learn';
$route['fun-n-learn-questions/(:num)'] = 'Fun_N_Learn/fun_n_learn_questions/$1';
$route['delete_fun_n_learn_questions'] = 'Fun_N_Learn/delete_fun_n_learn_questions';

// $route['guess-the-word-category'] = 'Guess_Word/get_main_category_index';
$route['guess-the-word-category'] = 'Category';
// $route['guess-the-word-subcategory'] = 'Guess_Word/get_sub_category_index';
$route['guess-the-word-subcategory'] = 'Subcategory';
// $route['guess-the-word-category-order'] = 'Guess_Word/category_order';
$route['guess-the-word-category-order'] = 'Category/category_order';
$route['guess-the-word'] = 'Guess_Word';
$route['delete_guess_word'] = 'Guess_Word/delete_guess_word';

$route['audio-question-category'] = 'Category';
$route['audio-question-subcategory'] = 'Subcategory';
$route['audio-question-category-order'] = 'Category/category_order';
$route['audio-question'] = 'Audio';
$route['delete_audio_question'] = 'Audio/delete_audio_question';

$route['system-utilities'] = 'Settings/system_utilities';

$route['send-notifications'] = 'Settings/send_notifications';
$route['delete_notification'] = 'Settings/delete_notification';
$route['system-configurations'] = 'Settings/system_configurations';
$route['ads-settings'] = 'Settings/ads_settings';
$route['notification-settings'] = 'Settings/notification_settings';
$route['about-us'] = 'Settings/about_us';
$route['instructions'] = 'Settings/instructions';
$route['upload_img'] = 'Settings/upload_img';
$route['privacy-policy'] = 'Settings/privacy_policy';
$route['play-store-privacy-policy'] = 'Settings/play_store_privacy_policy';
$route['terms-conditions'] = 'Settings/terms_conditions';
$route['play-store-terms-conditions'] = 'Settings/play_store_terms_conditions';
$route['contact-us'] = 'Settings/contact_us';
$route['play-store-contact-us'] = 'Settings/play_store_contact_us';
$route['profile'] = 'Settings/profile';
$route['badges-settings'] = 'Badges';
$route['firebase-configurations'] = 'Settings/firebase_configurations';

$route['system-updates'] = 'System_Update';
$route['set_setting'] = 'System_Update/set_setting';

$route['exam-module'] = 'Exam_Module';
$route['delete_exam_module'] = 'Exam_Module/delete_exam_module';
$route['exam-module-questions/(:num)'] = 'Exam_Module/exam_module_questions/$1';
$route['exam-module-questions-edit/(:num)'] = 'Exam_Module/exam_module_questions_edit/$1';
$route['exam-module-questions-list/(:num)'] = 'Exam_Module/exam_module_questions_list/$1';
$route['delete_exam_module_questions'] = 'Exam_Module/delete_exam_module_questions';
$route['exam-module-result/(:num)'] = 'Exam_Module/exam_module_result/$1';
$route['exam-module-questions-import'] = 'Exam_Module/import_questions';

$route['activity-tracker'] = 'Payments/activity_tracker';
$route['activity-tracker/(:num)'] = 'Payments/activity_tracker';
$route['payment-settings'] = 'Payments/payment_settings';
$route['payment-requests'] = 'Payments/payment_requests';
$route['payment-requests/(:num)'] = 'Payments/payment_requests';

$route['maths-question-category'] = 'Category';
$route['maths-question-subcategory'] = 'Subcategory';
$route['maths-question-category-order'] = 'Category/category_order';
$route['create-maths-questions'] = 'Maths_Question';
$route['create-maths-questions/(:num)'] = 'Maths_Question/edit_questions/$1';
$route['manage-maths-questions'] = 'Maths_Question/manage_questions';
$route['delete_maths_questions'] = 'Maths_Question/delete_questions';

$route['sliders'] = 'Slider';
$route['delete_sliders'] = 'Slider/delete_sliders';

$route['web-settings'] = 'Settings/web_settings';
$route['web-home-settings'] = 'Settings/web_home_settings';
// $route['upload-languages'] = 'Upload_Languages';
// $route['delete-upload-languages'] = 'Upload_Languages/delete_language_data';

$route['coin-store-settings'] = 'CoinStore';
$route['delete-coin-store-data'] = 'CoinStore/deleteCoinStoreData';
// $route['payment-requests'] = 'Payments/payment_requests';
// $route['payment-requests/(:num)'] = 'Payments/payment_requests';