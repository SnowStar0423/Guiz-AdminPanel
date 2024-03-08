<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <?php base_url() . include 'header.php'; ?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>System Settings for Web <small class="text-small">Note that this will directly reflect the changes in Web</small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <!-- Google Addsense Configuration -->
                                            <!-- <h4>
                                                    <label class="control-label"><b>Google Addsense</b></label>
                                                </h4>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="control-label">Data Ad Client</label>
                                                        <textarea id="data_ad_client" name="data_ad_client" required class="form-control" placeholder="Data Ad Client"><?= (!empty($data_ad_client['message'])) ? $data_ad_client['message'] : '' ?></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label">Data Ad Slot</label>
                                                        <textarea id="data_ad_slot" name="data_ad_slot" required class="form-control" placeholder="Data Ad Slot"><?= (!empty($data_ad_slot['message'])) ? $data_ad_slot['message'] : '' ?></textarea>
                                                    </div>
                                                </div> -->


                                            <!-- Firebase Configuration -->
                                            <h4 class='mt-4'>
                                                <label class="control-label"><b>Firebase Configuration</b></label>
                                            </h4>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">apiKey</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_api_key" name="firebase_api_key" required class="form-control" placeholder="apiKey" value="<?php echo (!empty($firebase_api_key['message'])) ? $firebase_api_key['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">authDomain</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_auth_domain" name="firebase_auth_domain" required class="form-control" placeholder="authDomain" value="<?php echo (!empty($firebase_auth_domain['message'])) ? $firebase_auth_domain['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">databaseURL</label> <small class="text-danger">(optional)</small>
                                                    <input type="text" id="firebase_database_url" name="firebase_database_url" class="form-control" placeholder="databaseURL" value="<?php echo (!empty($firebase_database_url['message'])) ? $firebase_measurement_id['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">projectId</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_project_id" name="firebase_project_id" required class="form-control" placeholder="projectId" value="<?php echo (!empty($firebase_project_id['message'])) ? $firebase_project_id['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">storageBucket</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_storage_bucket" name="firebase_storage_bucket" required class="form-control" placeholder="storageBucket" value="<?php echo (!empty($firebase_storage_bucket['message'])) ? $firebase_storage_bucket['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">messagingSenderId</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_messager_sender_id" name="firebase_messager_sender_id" required class="form-control" placeholder="messagingSenderId" value="<?php echo (!empty($firebase_messager_sender_id['message'])) ? $firebase_messager_sender_id['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">appId</label> <small class="text-danger">*</small>
                                                    <input type="text" id="firebase_app_id" name="firebase_app_id" required class="form-control" placeholder="appId" value="<?php echo (!empty($firebase_app_id['message'])) ? $firebase_app_id['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">measurementId</label> <small class="text-danger">(optional)</small>
                                                    <input type="text" id="firebase_measurement_id" name="firebase_measurement_id" class="form-control" placeholder="measurementId" value="<?php echo (!empty($firebase_measurement_id['message'])) ? $firebase_measurement_id['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <!-- Header Configuration -->
                                            <hr>
                                            <h4 class='mt-4'>
                                                <label class="control-label"><b>Header Configuration</b></label>
                                            </h4>
                                            <ul>
                                                <div class="text-danger text-small">
                                                    <li> Favicon icon Recommended Size :- width:- 16px , height:-16px</li>
                                                </div>
                                                <div class="text-danger text-small">
                                                    <li> Logo Recommended Size :- width:- 200px , height:-70px</li>
                                                </div>
                                                <div class="text-danger text-small">
                                                    <li> File type supported (svg,png, jpg and jpeg)</li>
                                                </div>
                                            </ul>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Meta Description</label> <small class="text-danger">*</small>
                                                    <textarea id="meta_description" name="meta_description" placeholder="Meta Description" required class="form-control"><?= (!empty($meta_description['message'])) ? $meta_description['message'] : '' ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Meta Keywords</label> <small class="text-danger">*</small>
                                                    <textarea id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" required class="form-control"><?= (!empty($meta_keywords['message'])) ? $meta_keywords['message'] : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <!-- checks the favicon exists or not  -->
                                                    <?php
                                                    if (!empty($favicon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Favicon</label>
                                                            <input class="form-control favicon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="favicon">
                                                            <p style="display: none" id="favicon_img_error_msg" class="alert alert-danger"></p>
                                                            <div><a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $favicon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $favicon['message'] ?>' height=50, width=50></a></div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Favicon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control favicon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="favicon" required>
                                                            <p style="display: none" id="favicon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- checks the header logo exists or not  -->
                                                    <?php
                                                    if (!empty($header_logo['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Header Logo</label>
                                                            <input class="form-control header_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="header_logo">
                                                            <p style="display: none" id="header_logo_img_error_msg" class="alert alert-danger"></p>
                                                            <div><a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $header_logo['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $header_logo['message'] ?>' height=50, width=50></a></div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Header Logo</label> <small class="text-danger"> * </small>
                                                            <input class="form-control header_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="header_logo" required>
                                                            <p style="display: none" id="header_logo_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- checks the Footer logo exists or not  -->
                                                    <?php
                                                    if (!empty($footer_logo['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Footer Logo</label>
                                                            <input class="form-control footer_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="footer_logo">
                                                            <p style="display: none" id="header_logo_img_error_msg" class="alert alert-danger"></p>
                                                            <div><a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $footer_logo['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $footer_logo['message'] ?>' height=50, width=50></a></div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Footer Logo</label> <small class="text-danger"> * </small>
                                                            <input class="form-control footer_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="footer_logo" required>
                                                            <p style="display: none" id="header_logo_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!---------------->
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- checks the Sticky header logo exists or not  -->
                                                    <?php
                                                    if (!empty($sticky_header_logo['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Sticky Header Logo</label>
                                                            <input class="form-control sticky_header_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="sticky_header_logo">
                                                            <p style="display: none" id="sticky_header_logo_img_error_msg" class="alert alert-danger"></p>
                                                            <div><a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $sticky_header_logo['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $sticky_header_logo['message'] ?>' height=50, width=50></a></div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Sticky Header Logo</label> <small class="text-danger"> * </small>
                                                            <input class="form-control sticky_header_logo" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="sticky_header_logo" required>
                                                            <p style="display: none" id="sticky_header_logo_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                            </div>

                                            <!-- Features Icons  -->
                                            <hr>
                                            <h4 class='mt-4'>
                                                <label class="control-label"><b>Features Icons</b></label>
                                            </h4>
                                            <ul>
                                                <div class="text-danger text-small">
                                                    <li>Recommended size :- width:- 80px height:- 80px</li>
                                                </div>
                                                <div class="text-danger text-small">
                                                    <li> File type supported (svg,png, jpg and jpeg)</li>
                                                </div>
                                            </ul>
                                            <div class="form-group row mt-3">
                                                <div class="col-md-2">
                                                    <!-- checks the Quiz Zone Icon exists or not  -->
                                                    <?php
                                                    if (!empty($quiz_zone_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Quiz Zone Icon</label>
                                                            <input class="form-control quiz_zone_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="quiz_zone_icon">
                                                            <p style="display: none" id="quiz_zone_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $quiz_zone_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $quiz_zone_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Quiz Zone Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control quiz_zone_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="quiz_zone_icon" required>
                                                            <p style="display: none" id="quiz_zone_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Daily Quiz Icon exists or not  -->
                                                    <?php
                                                    if (!empty($daily_quiz_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Daily Quiz Icon</label>
                                                            <input class="form-control daily_quiz_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="daily_quiz_icon">
                                                            <p style="display: none" id="daily_quiz_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $daily_quiz_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $daily_quiz_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Daily Quiz Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control daily_quiz_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="daily_quiz_icon" required>
                                                            <p style="display: none" id="daily_quiz_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the True & False Icon exists or not  -->
                                                    <?php
                                                    if (!empty($true_false_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">True & False Icon</label>
                                                            <input class="form-control true_false_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="true_false_icon">
                                                            <p style="display: none" id="true_false_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $true_false_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $true_false_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">True & False Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control true_false_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="true_false_icon" required>
                                                            <p style="display: none" id="true_false_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!---------------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Fun & Learn Icon exists or not  -->
                                                    <?php
                                                    if (!empty($fun_learn_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Fun & Learn Icon</label>
                                                            <input class="form-control fun_learn_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="fun_learn_icon">
                                                            <p style="display: none" id="fun_learn_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $fun_learn_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $fun_learn_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Fun & Learn Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control fun_learn_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="fun_learn_icon" required>
                                                            <p style="display: none" id="fun_learn_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Self Challange Icon exists or not  -->
                                                    <?php
                                                    if (!empty($self_challange_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Self Challange Icon</label>
                                                            <input class="form-control self_challange_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="self_challange_icon">
                                                            <p style="display: none" id="self_challange_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $self_challange_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $self_challange_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Self Challange Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control self_challange_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="self_challange_icon" required>
                                                            <p style="display: none" id="self_challange_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Contest Play exists or not  -->
                                                    <?php
                                                    if (!empty($contest_play_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Contest Play Icon</label>
                                                            <input class="form-control contest_play_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="contest_play_icon">
                                                            <p style="display: none" id="contest_play_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $contest_play_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $contest_play_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Contest Play</label> <small class="text-danger"> * </small>
                                                            <input class="form-control contest_play_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="contest_play_icon" required>
                                                            <p style="display: none" id="contest_play_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                            </div>
                                            <div class="form-group row mt-4">
                                                <div class="col-md-2">
                                                    <!-- checks the 1 vs 1 Battle Icon exists or not  -->
                                                    <?php
                                                    if (!empty($one_one_battle_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">1 vs 1 Battle Icon</label>
                                                            <input class="form-control one_one_battle_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="one_one_battle_icon">
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $one_one_battle_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $one_one_battle_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">1 vs 1 Battle Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control one_one_battle_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="one_one_battle_icon" required>
                                                            <p style="display: none" id="one_one_battle_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Group Battle Icon exists or not  -->
                                                    <?php
                                                    if (!empty($group_battle_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Group Battle Icon</label>
                                                            <input class="form-control group_battle_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="group_battle_icon">
                                                            <p style="display: none" id="group_battle_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $group_battle_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $group_battle_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Group Battle Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control group_battle_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="group_battle_icon" required>
                                                            <p style="display: none" id="group_battle_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!----------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Audio Questions Icon exists or not  -->
                                                    <?php
                                                    if (!empty($audio_question_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Audio Questions Icon</label>
                                                            <input class="form-control audio_question_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="audio_question_icon">
                                                            <p style="display: none" id="audio_question_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $audio_question_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $audio_question_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Audio Questions Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control audio_question_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="audio_question_icon" required>
                                                            <p style="display: none" id="audio_question_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!---------------->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Math Mania Icon exists or not  -->
                                                    <?php
                                                    if (!empty($math_mania_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Math Mania Icon</label>
                                                            <input class="form-control math_mania_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="math_mania_icon">
                                                            <p style="display: none" id="math_mania_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $math_mania_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $math_mania_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Math Mania Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control math_mania_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="math_mania_icon" required>
                                                            <p style="display: none" id="math_mania_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Exam Icon exists or not  -->
                                                    <?php
                                                    if (!empty($exam_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Exam Icon</label>
                                                            <input class="form-control exam_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="exam_icon">
                                                            <p style="display: none" id="exam_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $exam_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $exam_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Exam Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control exam_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="exam_icon" required>
                                                            <p style="display: none" id="exam_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- checks the Guess The Word Icon exists or not  -->
                                                    <?php
                                                    if (!empty($guess_the_word_icon['message'])) { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Guess The Word Icon</label>
                                                            <input class="form-control guess_the_word_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="guess_the_word_icon">
                                                            <p style="display: none" id="guess_the_word_icon_img_error_msg" class="alert alert-danger"></p>
                                                            <a href='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $guess_the_word_icon['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_SETTINGS_LOGO_PATH . $guess_the_word_icon['message'] ?>' height=50, width=50></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="control-label">Guess The Word Icon</label> <small class="text-danger"> * </small>
                                                            <input class="form-control guess_the_word_icon" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="guess_the_word_icon" required>
                                                            <p style="display: none" id="guess_the_word_icon_img_error_msg" class="alert alert-danger"></p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- ------------------------------- -->
                                                </div>
                                            </div>

                                            <!-- Footer Configuration -->
                                            <hr>
                                            <h4 class='mt-4'>
                                                <label class="control-label"><b>Footer Configuration</b></label>
                                            </h4>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label class="control-label">Company Name</label>
                                                    <input type="text" id="company_name_footer" name="company_name_footer" placeholder="Company Name" class="form-control" value="<?php echo (!empty($company_name_footer['message'])) ? $company_name_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" id="email_footer" name="email_footer" placeholder="Email" class="form-control" value="<?php echo (!empty($email_footer['message'])) ? $email_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" id="phone_number_footer" name="phone_number_footer" placeholder="Phone Number" class="form-control" value="<?php echo (!empty($phone_number_footer['message'])) ? $phone_number_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Web Link</label>
                                                    <input type="text" id="web_link_footer" name="web_link_footer" placeholder="Web Link" class="form-control" value="<?php echo (!empty($web_link_footer['message'])) ? $web_link_footer['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label class="control-label">Facebook Link</label>
                                                    <input type="text" id="facebook_link_footer" name="facebook_link_footer" placeholder="Facebook Link" class="form-control" value="<?php echo (!empty($facebook_link_footer['message'])) ? $facebook_link_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Instagram Link</label>
                                                    <input type="text" id="instagram_link_footer" name="instagram_link_footer" placeholder="Instagram Link" class="form-control" value="<?php echo (!empty($instagram_link_footer['message'])) ? $instagram_link_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">linkedin Link</label>
                                                    <input type="text" id="linkedin_link_footer" name="linkedin_link_footer" placeholder="Linkedin Link" class="form-control" value="<?php echo (!empty($linkedin_link_footer['message'])) ? $linkedin_link_footer['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Youtube Link</label>
                                                    <input type="text" id="youtube_link_footer" name="youtube_link_footer" placeholder="Youtube Link" class="form-control" value="<?php echo (!empty($playstore_link_footer['message'])) ? $playstore_link_footer['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Company Text</label>
                                                    <textarea id="company_text" name="company_text" placeholder="Company Text" class="form-control"><?= (!empty($company_text['message'])) ? $company_text['message'] : '' ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Address Text</label>
                                                    <textarea id="address_text" name="address_text" placeholder="Address Text" class="form-control"><?= (!empty($address_text['message'])) ? $address_text['message'] : '' ?></textarea>
                                                </div>
                                            </div>

                                            <!-- Other Configuration -->
                                            <hr>
                                            <h4 class='mt-4'>
                                                <label class="control-label"><b>Other Configuration</b></label>
                                            </h4>
                                            <div class="form-group row">
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">RTL Support</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="rtl_support_btn" data-plugin="switchery" <?php if (!empty($rtl_support) && $rtl_support['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                                    </label>
                                                    <input type="hidden" id="rtl_support" name="rtl_support" value="<?= ($rtl_support) ? $rtl_support['message'] : 0; ?>">
                                                </div>

                                                <!-- Toggle Other Home Details for WEB -->
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Toggle Extra Details</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="extra-home-details-switch" data-plugin="switchery" <?php if (!empty($toggle_web_home_settings) && $toggle_web_home_settings['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                                    </label>
                                                    <input type="hidden" id="extra-home-details-value" name="toggle_web_home_settings" value="<?= ($toggle_web_home_settings) ? $toggle_web_home_settings['message'] : 0; ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-md-2 col-sm-6">
                                                    <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?> mt-4" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php base_url() . include 'footer.php'; ?>

    <!-- <script type="text/javascript">
            $(document).ready(function () {
                tinymce.init({
                    selector: '#message',
                    height: 250,
                    menubar: true,
                    plugins: [
                        'advlist autolink lists link charmap print preview anchor textcolor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime table contextmenu paste code help wordcount'
                    ],
                    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                    setup: function (editor) {
                        editor.on("change keyup", function (e) {
                            editor.save();
                            $(editor.getElement()).trigger('change');
                        });
                    }
                });
            });
        </script> -->
    <script type="text/javascript">
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });

        var changeCheckbox2 = document.querySelector('#rtl_support_btn');
        changeCheckbox2.onchange = function() {
            if (changeCheckbox2.checked)
                $('#rtl_support').val(1);
            else
                $('#rtl_support').val(0);
        };

        var toggleExtraHomeSettings = document.querySelector('#extra-home-details-switch');
        toggleExtraHomeSettings.onchange = function() {
            console.log(toggleExtraHomeSettings.checked);
            if (toggleExtraHomeSettings.checked)
                $('#extra-home-details-value').val(1);
            else
                $('#extra-home-details-value').val(0);
        };
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        // get the value of all the logos and icons 
        let logos = ['favicon', 'header_logo', 'footer_logo', 'sticy_header_logo', 'quiz_zone_icon', 'daily_quiz_icon', 'true_false_icon', 'fun_learn_icon', 'self_challange_icon', 'contest_play_icon', 'one_one_battle_icon', 'group_battle_icon', 'audio_question_icon', 'math_mania_icon', 'exam_icon', 'guess_the_word_icon'];

        //added in loop to check the upload file validation
        $.each(logos, function(index, value) {
            $("." + value).change(function(e) {
                var file, img;

                if ((file = this.files[0])) {
                    img = new Image();

                    //checks only image which are not png or jpg
                    if (file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'image/jpg' && file.type !== 'image/svg+xml') {
                        $('.' + value).val('');
                        $('#' + value + '_img_error_msg').html('<?= IMAGE_ALLOW_PNG_JPG_SVG_MSG; ?>');
                        $('#' + value + '_img_error_msg').show().delay(3000).fadeOut();
                    }

                    //gets error when uploading any file rather than image
                    img.onerror = function() {
                        $('.' + value + '_icon').val('');
                        $('#' + value + '_icon_img_error_msg').html('<?= INVALID_IMAGE_TYPE; ?>');
                        $('#' + value + '_icon_img_error_msg').show().delay(3000).fadeOut();
                    };
                    img.src = _URL.createObjectURL(file);
                }
            });
        });
    </script>
</body>

</html>