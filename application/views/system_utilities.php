<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>System Utility | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

        <?php base_url() . include 'include.php';?>
    </head>

    <body>



        <div id="app">
            <div class="main-wrapper">
                <?php base_url() . include 'header.php';?>




                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>System Utilities <small class="text-small">System utilities for App</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        <div class="card-body mt-4">
                                        <h4>
                                            <label class="control-label"><b>General Settings</b></label>
                                            <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Please enter a value greater than or equal to 1."></i>
                                        </h4>
                                        <form method="post" class="needs-validation" novalidate="">
                                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">

                                                <div class="form-group row">


                                                    <div class="col-md-3 col-sm-12">

                                                            <label class="control-label">Maximum Winning Coins</label>


                                                        <input name="maximum_winning_coins" type="number" min=1 class="form-control"  value="<?php echo (!empty($maximum_winning_coins['message'])) ? $maximum_winning_coins['message'] : 4 ?>"required>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Minimum Winning Percentage</label>
                                                        <input name="minimum_coins_winning_percentage" type="number" min=1 class="form-control"  value="<?php echo (!empty($minimum_coins_winning_percentage['message'])) ? $minimum_coins_winning_percentage['message'] : 70 ?>"required>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Quiz Winning Percentage</label>
                                                        <input name="quiz_winning_percentage" type="number" min=0 class="form-control"  value="<?php echo ($quiz_winning_percentage['message'] != null) ? $quiz_winning_percentage['message'] : 30 ?>"required>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Score</label>
                                                        <input name="score" type="number" min=1 class="form-control" value="<?php echo (!empty($score['message'])) ? $score['message'] : 4 ?>" required>
                                                    </div>



                                                </div>
                                                <hr>
                                                <h4 class="mt-4">
                                                    <label class="control-label"><b>Time Settings</b></label>
                                                    <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Please enter a value greater than or equal to 1."></i>
                                                 </h4>


                                                 <div class="form-group row">
                                                   <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Quiz Zone Duration</label>
                                                        <input name="quiz_zone_duration" type="number" min=1 class="form-control" value="<?php echo (!empty($quiz_zone_duration['message'])) ? $quiz_zone_duration['message'] : 30 ?>" required>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Self Challenge Max Minutes</label>
                                                        <input name="self_challange_max_minutes" type="number" min=1  class="form-control" value="<?php echo (!empty($self_challange_max_minutes['message'])) ? $self_challange_max_minutes['message'] : 30 ?>" required>
                                                    </div>


                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Guess The Word Seconds</label>
                                                        <input name="guess_the_word_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($guess_the_word_seconds['message'])) ? $guess_the_word_seconds['message'] : 60 ?>" required>
                                                    </div>




                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Maths Quiz Seconds</label>
                                                        <input name="maths_quiz_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($maths_quiz_seconds['message'])) ? $maths_quiz_seconds['message'] : 60 ?>" required>
                                                    </div>


                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label"> Fun & Learn Seconds</label>
                                                        <input name="fun_and_learn_time_in_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($fun_and_learn_time_in_seconds['message'])) ? $fun_and_learn_time_in_seconds['message'] : 60 ?>" required>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label"> Audio Timer</label>
                                                        <input name="audio_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($audio_seconds['message'])) ? $audio_seconds['message'] : 60 ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label"> Random Battle Seconds</label>
                                                        <input name="random_battle_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($random_battle_seconds['message'])) ? $random_battle_seconds['message'] : 60 ?>" required>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h4 class="mt-4">
                                                    <label class="control-label"><b>Coin Management</b></label>
                                                    <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Please enter a value greater than or equal to 1."></i>
                                                </h4>
                                                <div class="form-group row">
                                                    <div class="col-md-3 col-xs-12 mt-2">
                                                        <label class="control-label">Welcome Bonus</label>
                                                        <input type="number" min=1 id="welcome_bonus_coin" min="1" name="welcome_bonus_coin" required class="form-control" value="<?php echo isset($welcome_bonus_coin) ? $welcome_bonus_coin['message'] : "" ?>">
                                                    </div>
                                                    <div class="col-md-3 col-xs-12 mt-2">
                                                        <label class="control-label">Lifeline Deduct</label>
                                                        <input type="number" min=1 id="lifeline_deduct_coin" min="1" name="lifeline_deduct_coin" required class="form-control" value="<?php echo isset($lifeline_deduct_coin) ? $lifeline_deduct_coin['message'] : "" ?>">
                                                    </div>
                                                    <div class="col-md-3 col-xs-12 mt-2">
                                                        <label class="control-label">Random Battle Entery</label>
                                                        <input type="number" min=1 id="random_battle_entry_coin" min="1" name="random_battle_entry_coin" required class="form-control" value="<?php echo isset($random_battle_entry_coin) ? $random_battle_entry_coin['message'] : "" ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-3 col-xs-12 mt-2">
                                                        <label class="control-label">Guess The Word Max Winning</label>
                                                        <input type="number" min=1 id="guess_the_word_max_winning_coin" min="1" name="guess_the_word_max_winning_coin" required class="form-control" value="<?php echo isset($guess_the_word_max_winning_coin) ? $guess_the_word_max_winning_coin['message'] : "" ?>">
                                                    </div>
                                                    <div class="col-md-3 col-xs-12 mt-2">
                                                        <label class="control-label">Review Answers Deduct</label>
                                                        <input type="number" min=1 id="review_answers_deduct_coin" min="1" name="review_answers_deduct_coin" required class="form-control" value="<?php echo isset($review_answers_deduct_coin) ? $review_answers_deduct_coin['message'] : "" ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2 col-sm-6">
                                                        <input type="submit" name="btnadd" value="Submit" class="<?=BUTTON_CLASS?>"/>
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

        <?php base_url() . include 'footer.php';?>

        <script type="text/javascript">
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
        </script>

    </body>
</html>
