<?php

defined('BASEPATH') or exit('No direct script access allowed');

$config['system_modules'] = [
    'users' => array('read', 'update'),
    'languages' => array('create', 'read', 'update', 'delete'),
    'categories' => array('create', 'read', 'update', 'delete'),
    'subcategories' => array('create', 'read', 'update', 'delete'),
    'category_order' => array('read', 'update'),
    'questions' => array('create', 'read', 'update', 'delete'),
    'daily_quiz' => array('read', 'update'),
    'manage_contest' => array('create', 'read', 'update', 'delete'),
    'manage_contest_question' => array('create', 'read', 'update', 'delete'),
    'import_contest_question' => array('update'),
    'fun_n_learn' => array('create', 'read', 'update', 'delete'),
    'guess_the_word' => array('create', 'read', 'update', 'delete'),
    'audio_question' => array('create', 'read', 'update', 'delete'),
    'maths_questions' => array('create', 'read', 'update', 'delete'),
    'exam_module' => array('create', 'read', 'update', 'delete'),
    'question_report' => array('read', 'update', 'delete'),
    'send_notification' => array('create', 'read', 'delete'),
    'import_question' => array('update'),
    'system_configuration' => array('read', 'update'),
    'upload_languages' => array('create','update' ,'delete'),
    'coin_store_settings' => array('create','update' ,'delete'),
];

$config['category_type'] = [
    'main-category' => 1,
    'fun-n-learn-category' => 2,
    'guess-the-word-category' => 3,
    'audio-question-category' => 4,
    'maths-question-category' => 5,
    'sub-category' => 1,
    'fun-n-learn-subcategory' => 2,
    'guess-the-word-subcategory' => 3,
    'audio-question-subcategory' => 4,
    'maths-question-subcategory' => 5,
    'category-order' => 1,
    'fun-n-learn-category-order' => 2,
    'guess-the-word-category-order' => 3,
    'audio-question-category-order' => 4,
    'maths-question-category-order' => 5,
];
?>
