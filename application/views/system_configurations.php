<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>System Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

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
                        <h1>System Settings for App <small class="text-small">Note that this will directly reflect the changes in App</small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="form-group row">
                                                <div class="col-md-12 col-sm-12">
                                                    <label class="control-label">System Timezone</label>
                                                    <input type="hidden" id="system_timezone_gmt" name="system_timezone_gmt" value="<?php echo (!empty($system_timezone_gmt['message'])) ? $system_timezone_gmt['message'] : '-11:00'; ?>" aria-required="true">
                                                    <?php $options = getTimezoneOptions(); ?>
                                                    <select id="system_timezone" name="system_timezone" required class="form-control">
                                                        <?php foreach ($options as $option) { ?>
                                                            <option value="<?= $option[2] ?>" data-gmt="<?= $option['1']; ?>" <?= (isset($system_timezone['message']) && $system_timezone['message'] == $option[2]) ? 'selected' : ''; ?>><?= $option[2] ?> - GMT <?= $option[1] ?> - <?= $option[0] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label">App Link</label>
                                                    <input type="url" id="app_link" name="app_link" required class="form-control" value="<?php echo (!empty($app_link['message'])) ? $app_link['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label">More Apps Link ( Your Google / iOS Market place URL )</label>
                                                    <input type="url" id="more_apps" name="more_apps" required class="form-control" value="<?php echo (!empty($more_apps['message'])) ? $more_apps['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label">iOS App Link</label>
                                                    <input type="url" id="ios_app_link" name="ios_app_link" class="form-control" value="<?php echo (!empty($ios_app_link['message'])) ? $ios_app_link['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label">More Apps Link ( Your iOS Market place URL )</label>
                                                    <input type="url" id="ios_more_apps" name="ios_more_apps" class="form-control" value="<?php echo (!empty($ios_more_apps['message'])) ? $ios_more_apps['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">Refer Coin</label>
                                                    <input type="number" id="refer_coin" min="0" name="refer_coin" required class="form-control" value="<?php echo ($refer_coin) ? $refer_coin['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">Earn Coin</label>
                                                    <input type="number" id="earn_coin" min="0" name="earn_coin" required class="form-control" value="<?php echo ($earn_coin) ? $earn_coin['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">App Version (Android)</label>
                                                    <input type="text" id="app_version" name="app_version" required class="form-control" value="<?php echo (!empty($app_version['message'])) ? $app_version['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">App Version (iOS)</label>
                                                    <input type="text" id="app_version_ios" name="app_version_ios" required class="form-control" value="<?php echo (!empty($app_version_ios['message'])) ? $app_version_ios['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Force Update App</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="force_update_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($force_update) && $force_update['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="force_update" name="force_update" value="<?= ($force_update) ? $force_update['message'] : 0; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">True Value</label>
                                                    <input type="text" id="true_value" name="true_value" required class="form-control" value="<?php echo ($true_value) ? $true_value['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <label class="control-label">False Value</label>
                                                    <input type="text" id="false_value" name="false_value" required class="form-control" value="<?php echo ($false_value) ? $false_value['message'] : "" ?>">
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <label class="control-label">Share App Text</label>
                                                    <textarea id="shareapp_text" name="shareapp_text" required class="form-control"><?= (!empty($shareapp_text['message'])) ? $shareapp_text['message'] : '' ?></textarea>
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">App Maintenance</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="app_maintenance_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($app_maintenance) && $app_maintenance['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="app_maintenance" name="app_maintenance" value="<?= ($app_maintenance) ? $app_maintenance['message'] : 0; ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-md-12 col-xs-12">
                                                    <h6 class="inner_heading"><strong>Quiz Mode</strong></h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Answer Display</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="answer_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($answer_mode) && $answer_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="answer_mode" name="answer_mode" value="<?= ($answer_mode) ? $answer_mode['message'] : 0; ?>">
                                                </div>



                                                <!-- <div class="col-md-2 col-sm-6">
                                                        <label class="control-label">Battle Mode -One </label>
                                                        <label class="custom-switch d-block pl-0">
                                                            <input type="checkbox" id="battle_mode_btn"  data-plugin="switchery" <?php
                                                                                                                                    if (!empty($battle_mode_one) && $battle_mode_one['message'] == '1') {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                                                        </label>
                                                        <input type="hidden" id="answer_mode" name="answer_mode" value="<?= ($answer_mode) ? $answer_mode['message'] : 0; ?>">
                                                    </div>  -->



                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Language Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="language_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($language_mode) && $language_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="language_mode" name="language_mode" value="<?= ($language_mode) ? $language_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Option E Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="option_e_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($option_e_mode) && $option_e_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="option_e_mode" name="option_e_mode" value="<?= ($option_e_mode) ? $option_e_mode['message'] : 0; ?>">
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Quiz Zone Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="quiz_zone_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($quiz_zone_mode) && $quiz_zone_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="quiz_zone_mode" name="quiz_zone_mode" value="<?= ($quiz_zone_mode) ? $quiz_zone_mode['message'] : 0; ?>">
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Daily Quiz Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="daily_quiz_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($daily_quiz_mode) && $daily_quiz_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="daily_quiz_mode" name="daily_quiz_mode" value="<?= ($daily_quiz_mode) ? $daily_quiz_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Contest Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="contest_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($contest_mode) && $contest_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="contest_mode" name="contest_mode" value="<?= ($contest_mode) ? $contest_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Self Challenge Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="self_challenge_mode_btn" data-plugin="switchery" <?php
                                                                                                                                    if (!empty($self_challenge_mode) && $self_challenge_mode['message'] == '1') {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                                                    </label>
                                                    <input type="hidden" id="self_challenge_mode" name="self_challenge_mode" value="<?= ($self_challenge_mode) ? $self_challenge_mode['message'] : 0; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-3 col-xs-12">
                                                    <label class="control-label">Battle Random Category Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="battle_random_category_mode_btn" data-plugin="switchery" <?php
                                                                                                                                            if (!empty($battle_random_category_mode) && $battle_random_category_mode['message'] == '1') {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="battle_random_category_mode" name="battle_random_category_mode" value="<?= ($battle_random_category_mode) ? $battle_random_category_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <label class="control-label">Battle Group Category Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="battle_group_category_mode_btn" data-plugin="switchery" <?php
                                                                                                                                            if (!empty($battle_group_category_mode) && $battle_group_category_mode['message'] == '1') {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="battle_group_category_mode" name="battle_group_category_mode" value="<?= ($battle_group_category_mode) ? $battle_group_category_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Fun N Learn</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="fun_n_learn_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($fun_n_learn_question) && $fun_n_learn_question['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="fun_n_learn_question" name="fun_n_learn_question" value="<?= ($fun_n_learn_question) ? $fun_n_learn_question['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Guess the Word</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="guess_the_word_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($guess_the_word_question) && $guess_the_word_question['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="guess_the_word_question" name="guess_the_word_question" value="<?= ($guess_the_word_question) ? $guess_the_word_question['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Exam Module</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="exam_module_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($exam_module) && $exam_module['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="exam_module" name="exam_module" value="<?= ($exam_module) ? $exam_module['message'] : 0; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Maths Quiz Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="maths_quiz_mode_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($maths_quiz_mode) && $maths_quiz_mode['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="maths_quiz_mode" name="maths_quiz_mode" value="<?= ($maths_quiz_mode) ? $maths_quiz_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Fix Question in Level</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="fix_question_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($fix_question) && $fix_question['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="fix_question" name="fix_question" value="<?= ($fix_question) ? $fix_question['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6" id="fix_que">
                                                    <label class="control-label">Total Question per Level</label>
                                                    <input type="number" min="1" id="total_question" name="total_question" required class="form-control" value="<?php echo ($total_question) ? $total_question['message'] : '1' ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Audio Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="audio_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($audio_mode_question) && $audio_mode_question['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="audio_mode_question" name="audio_mode_question" value="<?= ($audio_mode_question) ? $audio_mode_question['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6" id="fix_audio_time">
                                                    <label class="control-label">Total Audio Time <small class="text-danger">( In Second )</small></label>
                                                    <input type="number" min="1" id="total_audio_time" name="total_audio_time" required class="form-control" value="<?php echo ($total_audio_time) ? $total_audio_time['message'] : '1' ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">In App Purchase</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="in_app_purchase_mode_btn" data-plugin="switchery" <?php
                                                                                                                                        if (!empty($in_app_purchase_mode) && $in_app_purchase_mode['message'] == '1') {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                        ?>>
                                                    </label>
                                                    <input type="hidden" id="in_app_purchase_mode" name="in_app_purchase_mode" value="<?= ($in_app_purchase_mode) ? $in_app_purchase_mode['message'] : 0; ?>">
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Battle Mode - One</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="battle_mode_one_btn" data-plugin="switchery" <?php
                                                                                                                                if (!empty($battle_mode_one) && $battle_mode_one['message'] == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                                                    </label>
                                                    <input type="hidden" id="battle_mode_one" name="battle_mode_one" value="<?= ($battle_mode_one) ? $battle_mode_one['message'] : 0; ?>">
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">Battle Mode - Group</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="battle_mode_group_btn" data-plugin="switchery" <?php
                                                                                                                                    if (!empty($battle_mode_group) && $battle_mode_group['message'] == '1') {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                                                    </label>
                                                    <input type="hidden" id="battle_mode_group" name="battle_mode_group" value="<?= ($battle_mode_group) ? $battle_mode_group['message'] : 0; ?>">
                                                </div>


                                                <div class="col-md-2 col-sm-6">
                                                    <label class="control-label">True/false Mode</label>
                                                    <label class="custom-switch d-block pl-0">
                                                        <input type="checkbox" id="true_false_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($true_false_mode) && $true_false_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    </label>
                                                    <input type="hidden" id="true_false_btn1" name="true_false_mode" value="<?= ($true_false_mode) ? $true_false_mode['message'] : 0; ?>">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>" />
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

    <script type="text/javascript">
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });
    </script>

    <script type="text/javascript">
        $('#system_timezone').on('change', function(e) {
            gmt = $(this).find(':selected').data('gmt');
            $('#system_timezone_gmt').val(gmt);

        });

        /* on change of language mode btn - switchery js */
        var changeCheckbox = document.querySelector('#language_mode_btn');
        changeCheckbox.onchange = function() {
            if (changeCheckbox.checked)
                $('#language_mode').val(1);
            else
                $('#language_mode').val(0);
        };
        /* on change of option e mode btn - switchery js */
        var changeCheckbox1 = document.querySelector('#option_e_mode_btn');
        changeCheckbox1.onchange = function() {
            if (changeCheckbox1.checked)
                $('#option_e_mode').val(1);
            else
                $('#option_e_mode').val(0);
        };

        /* on change of answer mode btn - switchery js */
        var changeCheckbox2 = document.querySelector('#answer_mode_btn');
        changeCheckbox2.onchange = function() {
            if (changeCheckbox2.checked)
                $('#answer_mode').val(1);
            else
                $('#answer_mode').val(0);
        };
        /* on change of fix question btn - switchery js */
        var changeCheckbox3 = document.querySelector('#fix_question_btn');
        changeCheckbox3.onchange = function() {
            if (changeCheckbox3.checked) {
                $('#fix_question').val(1);
                $('#fix_que').show();
            } else {
                $('#fix_question').val(0);
                $('#fix_que').hide();
            }
        };
        /* on change of force update btn - switchery js */
        var changeCheckbox4 = document.querySelector('#force_update_btn');
        changeCheckbox4.onchange = function() {
            if (changeCheckbox4.checked)
                $('#force_update').val(1);
            else
                $('#force_update').val(0);
        };
        /* on change of daily quiz mode btn - switchery js */
        var changeCheckbox5 = document.querySelector('#daily_quiz_mode_btn');
        changeCheckbox5.onchange = function() {
            if (changeCheckbox5.checked)
                $('#daily_quiz_mode').val(1);
            else
                $('#daily_quiz_mode').val(0);
        };
        /* on change of contest mode btn - switchery js */




        var changeCheckbox6 = document.querySelector('#contest_mode_btn');
        changeCheckbox6.onchange = function() {
            if (changeCheckbox6.checked)
                $('#contest_mode').val(1);
            else
                $('#contest_mode').val(0);
        };

        /* on change of battle category mode btn - switchery js */
        var changeCheckbox7 = document.querySelector('#battle_random_category_mode_btn');
        changeCheckbox7.onchange = function() {
            if (changeCheckbox7.checked)
                $('#battle_random_category_mode').val(1);
            else
                $('#battle_random_category_mode').val(0);
        };

        /* on change of room category mode btn - switchery js */
        var changeCheckbox8 = document.querySelector('#battle_group_category_mode_btn');
        changeCheckbox8.onchange = function() {
            if (changeCheckbox8.checked)
                $('#battle_group_category_mode').val(1);
            else
                $('#battle_group_category_mode').val(0);
        };

        /* on change of fun n learn mode btn - switchery js */
        var changeCheckbox9 = document.querySelector('#fun_n_learn_btn');
        changeCheckbox9.onchange = function() {
            if (changeCheckbox9.checked)
                $('#fun_n_learn_question').val(1);
            else
                $('#fun_n_learn_question').val(0);
        };

        /* on change of guess the word mode btn - switchery js */
        var changeCheckbox10 = document.querySelector('#guess_the_word_btn');
        changeCheckbox10.onchange = function() {
            if (changeCheckbox10.checked)
                $('#guess_the_word_question').val(1);
            else
                $('#guess_the_word_question').val(0);
        };

        /* on change of audio mode btn - switchery js */
        var changeCheckbox11 = document.querySelector('#audio_mode_btn');
        changeCheckbox11.onchange = function() {
            if (changeCheckbox11.checked)
                $('#audio_mode_question').val(1);
            else
                $('#audio_mode_question').val(0);
        };

        /* on change of exam module mode btn - switchery js */
        var changeCheckbox12 = document.querySelector('#exam_module_btn');
        changeCheckbox12.onchange = function() {
            if (changeCheckbox12.checked)
                $('#exam_module').val(1);
            else
                $('#exam_module').val(0);
        };

        /* on change of self challenge mode btn - switchery js */
        var changeCheckbox13 = document.querySelector('#self_challenge_mode_btn');
        changeCheckbox13.onchange = function() {
            if (changeCheckbox13.checked)
                $('#self_challenge_mode').val(1);
            else
                $('#self_challenge_mode').val(0);
        };

        /* on change of self challenge mode btn - switchery js */
        var changeCheckbox14 = document.querySelector('#in_app_purchase_mode_btn');
        changeCheckbox14.onchange = function() {
            if (changeCheckbox14.checked)
                $('#in_app_purchase_mode').val(1);
            else
                $('#in_app_purchase_mode').val(0);
        };

        /* on change of app maintenance btn - switchery js */
        var changeCheckbox15 = document.querySelector('#app_maintenance_btn');
        changeCheckbox15.onchange = function() {
            if (changeCheckbox15.checked)
                $('#app_maintenance').val(1);
            else
                $('#app_maintenance').val(0);
        };

        /* on change of daily quiz mode btn - switchery js */
        var changeCheckbox16 = document.querySelector('#maths_quiz_mode_btn');
        changeCheckbox16.onchange = function() {
            if (changeCheckbox16.checked)
                $('#maths_quiz_mode').val(1);
            else
                $('#maths_quiz_mode').val(0);
        };





        /* on change of daily quiz mode btn - switchery js */
        var changeCheckbox17 = document.querySelector('#battle_mode_one_btn');
        changeCheckbox17.onchange = function() {
            if (changeCheckbox17.checked)
                $('#battle_mode_one').val(1);
            else
                $('#battle_mode_one').val(0);
        };


        /* on change of daily quiz mode btn - switchery js */
        var changeCheckbox18 = document.querySelector('#battle_mode_group_btn');
        changeCheckbox18.onchange = function() {
            if (changeCheckbox18.checked)
                $('#battle_mode_group').val(1);
            else
                $('#battle_mode_group').val(0);
        };

        /* on change of true false mode btn - switchery js */
        var changeCheckbox19 = document.querySelector('#true_false_btn');
        changeCheckbox19.onchange = function() {
            if (changeCheckbox19.checked)
                $('#true_false_btn1').val(1);
            else
                $('#true_false_btn1').val(0);
        };

        /* on change of quiz zone mode btn - switchery js */
        var changeCheckbox20 = document.querySelector('#quiz_zone_mode_btn');
        changeCheckbox20.onchange = function() {
            if (changeCheckbox20.checked)
                $('#quiz_zone_mode').val(1);
            else
                $('#quiz_zone_mode').val(0);
        };
    </script>




    <?php

    function getTimezoneOptions()
    {
        $list = DateTimeZone::listAbbreviations();
        $idents = DateTimeZone::listIdentifiers();

        $data = $offset = $added = array();
        foreach ($list as $abbr => $info) {
            foreach ($info as $zone) {
                if (!empty($zone['timezone_id']) and !in_array($zone['timezone_id'], $added) and in_array($zone['timezone_id'], $idents)) {
                    $z = new DateTimeZone($zone['timezone_id']);
                    $c = new DateTime('', $z);
                    $zone['time'] = $c->format('H:i a');
                    $offset[] = $zone['offset'] = $z->getOffset($c);
                    $data[] = $zone;
                    $added[] = $zone['timezone_id'];
                }
            }
        }

        array_multisort($offset, SORT_ASC, $data);
        $i = 0;
        $temp = array();
        foreach ($data as $key => $row) {
            $temp[0] = $row['time'];
            $temp[1] = formatOffset($row['offset']);
            $temp[2] = $row['timezone_id'];
            $options[$i++] = $temp;
        }
        return $options;
    }

    function formatOffset($offset)
    {
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 and $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0');
    }
    ?>

</body>

</html>