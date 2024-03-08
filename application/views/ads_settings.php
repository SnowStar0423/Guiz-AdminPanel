<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ads. Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Ads. Settings for App <small class="text-small">Note that this will directly reflect the changes in App</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <form method="post" class="needs-validation" novalidate="">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">
                                                    <div class="col-md-2 col-sm-6">
                                                        <label class="control-label">In App Ads.</label>
                                                        <label class="custom-switch d-block pl-0">
                                                            <input type="checkbox" id="in_app_ads_mode_btn"  data-plugin="switchery" <?php
                                                            if (!empty($in_app_ads_mode) && $in_app_ads_mode['message'] == '1') {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                                                        </label>
                                                        <input type="hidden" id="in_app_ads_mode" name="in_app_ads_mode" value="<?= ($in_app_ads_mode) ? $in_app_ads_mode['message'] : 0; ?>">
                                                    </div> 
                                                    <div class="col-sm-12 adsHide">  
                                                        <label class="control-label">&nbsp;</label>
                                                        <div>
                                                            <div class="form-check-inline bg-light p-2">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="ads_type" value="1" required <?php
                                                                    if (!empty($ads_type) && $ads_type['message'] == '1') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>Google AdMob
                                                                </label>
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="ads_type" value="3" required  <?php
                                                                    if (!empty($ads_type) && $ads_type['message'] == '3') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>Unity Ads.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="adsgoogle"> 
                                                    <div class="form-group row">
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Android Banner Id</label>
                                                            <input type="text" id="android_banner_id" name="android_banner_id" class="form-control googleAtt" value="<?= (!empty($android_banner_id['message'])) ? $android_banner_id['message'] : "" ?>">
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Android Interstitial Id</label>
                                                            <input type="text" id="android_interstitial_id" name="android_interstitial_id" class="form-control googleAtt" value="<?= (!empty($android_interstitial_id['message'])) ? $android_interstitial_id['message'] : "" ?>">
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Android Rewarded Id</label>
                                                            <input type="text" id="android_rewarded_id" name="android_rewarded_id" class="form-control googleAtt" value="<?= (!empty($android_rewarded_id['message'])) ? $android_rewarded_id['message'] : "" ?>">
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-group row">
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">IOS Banner Id</label>
                                                            <input type="text" id="ios_banner_id" name="ios_banner_id" class="form-control googleAtt" value="<?= (!empty($ios_banner_id['message'])) ? $ios_banner_id['message'] : "" ?>">
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">IOS Interstitial Id</label>
                                                            <input type="text" id="ios_interstitial_id" name="ios_interstitial_id" class="form-control googleAtt" value="<?= (!empty($ios_interstitial_id['message'])) ? $ios_interstitial_id['message'] : "" ?>">
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">IOS Rewarded Id</label>
                                                            <input type="text" id="ios_rewarded_id" name="ios_rewarded_id" class="form-control googleAtt" value="<?= (!empty($ios_rewarded_id['message'])) ? $ios_rewarded_id['message'] : "" ?>">
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="adsunity"> 
                                                    <div class="form-group row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Android Game Id</label>
                                                            <input type="text" id="android_game_id" name="android_game_id" class="form-control unityAtt" value="<?= (!empty($android_game_id['message'])) ? $android_game_id['message'] : "" ?>">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">IOS Game Id</label>
                                                            <input type="text" id="ios_game_id" name="ios_game_id" class="form-control unityAtt" value="<?= (!empty($ios_game_id['message'])) ? $ios_game_id['message'] : "" ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <label class="control-label">Rewards Ads Coins</label>
                                                        <input type="number" id="reward_coin" min="0" name="reward_coin" required class="form-control" value="<?php echo ($reward_coin) ? $reward_coin['message'] : ""; ?>">
                                                    </div>
                                                </div>

                                                <div class="row form-group daily-ads-div">
                                                    <hr class="col-12">
                                                    <div class="col-md-12 col-sm-12 mb-4">
                                                        <h5 class="font-weight-bold">Daily Watch Ads Settings</h6>
                                                    </div>
                                                    <div class="form-group col-md-2 col-sm-12">
                                                        <label class="control-label">Visibility</label>
                                                        <label class="custom-switch d-block pl-0">
                                                            <input type="checkbox" id="daily-ads-visibility-btn"  data-plugin="switchery" <?php
                                                            if (isset($daily_ads_visibility) && $daily_ads_visibility['message'] == '1') {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                                                        </label>
                                                        <input type="hidden" id="daily-ads-visibility-mode" name="daily_ads_visibility" value="<?= (isset($daily_ads_visibility)) ? $daily_ads_visibility['message'] : 0; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-2">
                                                        <label class="control-label">Coins</label>
                                                        <input type="number" name="daily_ads_coins" class="form-control" min="0" id="daily-ads-coins" placeholder="Enter Coins" value="<?= (isset($daily_ads_coins)) ? $daily_ads_coins['message'] : 5; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-2">
                                                        <label class="control-label">Total Counter<small class="text-danger"> (In 24 Hours)</small></label>
                                                        <input type="number" placeholder="Enter number of hours" min="0" name="daily_ads_counter" class="form-control" id="daily-cool-off-time" value="<?= (isset($daily_ads_counter)) ? $daily_ads_counter['message'] : 24; ?>">
                                                    </div>
                                                    <hr class="col-12">
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>"/>
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
            $(document).ready(function () {

                $('.adsHide').hide(100);
                $('.adsgoogle').hide(100);
                $('.adsunity').hide(100);
                $('.adsHide').hide(100);

              
                var que = $('#fix_question').val();
                if (que == '1') {
                    $('#fix_que').show(200);
                } else {
                    $('#fix_que').hide(100);
                }

                var ads = $('#in_app_ads_mode').val();




                
                if (ads === '1' || ads === 1) {
                    $('.adsHide').show(200);
                    var ads_type = $("input:radio[name=ads_type]:checked").val();
                    if (ads_type == undefined) {
                        $("input[name=ads_type][value=1]").prop('checked', true);
                    }
                } else if (ads === '2' || ads === 2) {
                    $('.adsHide').show(200);
                    var ads_type = $("input:radio[name=ads_type]:checked").val();
                    if (ads_type == undefined) {
                        $("input[name=ads_type][value=2]").prop('checked', true);
                    }
                } else if (ads === '3' || ads === 3) {
                    $('.adsHide').show(200);
                    var ads_type = $("input:radio[name=ads_type]:checked").val();
                    if (ads_type == undefined) {
                        $("input[name=ads_type][value=3]").prop('checked', true);
                    }
                } else {
                    $('.adsHide').hide(100);
                    $('.adsgoogle').hide(100);
                    $('.googleAtt').removeAttr('required');
                    $('.adsunity').hide(100);
                    $('.unityAtt').removeAttr('required');
                  
                }
                var ads_type = $("input:radio[name=ads_type]:checked").val();
                ads_type_manage(ads_type);
            
                
            });

            function ads_type_manage(ads_type) {

                var ads = $('#in_app_ads_mode').val();

                if(ads=="0" || ads==0){
                    $('.adsHide').hide(100);
                    $('.adsgoogle').hide(100);
                    $('.googleAtt').removeAttr('required');
                    $('.adsunity').hide(100);
                    $('.unityAtt').removeAttr('required');
                }else{
                    if (ads_type === '1' || ads_type === 1) {
                    $('.adsgoogle').show(200);
                    $('.googleAtt').attr('required', 'required');
                    $('.adsunity').hide(200);
                    $('.unityAtt').removeAttr('required');
                } else if (ads_type === '2' || ads_type === 2) {
                    $('.adsgoogle').hide(100);
                    $('.googleAtt').removeAttr('required');
                    $('.adsunity').hide(100);
                    $('.unityAtt').removeAttr('required');
                } else if (ads_type === '3' || ads_type === 3) {
                    $('.adsgoogle').hide(100);
                    $('.googleAtt').removeAttr('required');
                    $('.adsunity').show(200);
                    $('.unityAtt').attr('required', 'required');
                } else {
                    $('.adsHide').hide(100);
                    $('.adsgoogle').hide(100);
                    $('.googleAtt').removeAttr('required');
                    $('.adsunity').hide(100);
                    $('.unityAtt').removeAttr('required');
                }
                }

                
            }

            $(document).on('click', 'input[name="ads_type"]', function () {

           
                var ads_type = $(this).val();
                ads_type_manage(ads_type);
            });
        </script>

        <script type="text/javascript">
            $('[data-plugin="switchery"]').each(function (index, element) {
                var init = new Switchery(element, {
                    size: 'small', color: '#1abc9c', secondaryColor: '#f1556c'
                });
            });
        </script>

        <script type="text/javascript">
            /* on change of Ads mode btn - switchery js */
            var changeCheckbox = document.querySelector('#in_app_ads_mode_btn');
            changeCheckbox.onchange = function () {
                if (changeCheckbox.checked) {
                    $('#in_app_ads_mode').val(1);
                    $('.adsHide').show(200);
                    $("input[name=ads_type][value=1]").prop('checked', true);
                    var ads_type = $("input:radio[name=ads_type]:checked").val();
                    ads_type_manage(ads_type);
                    $('#daily-ads-visibility-mode').val(<?=(isset($daily_ads_visibility)) ? $daily_ads_visibility['message'] : 0?>);
                } else {
                    $('#in_app_ads_mode').val(0);
                    $('.adsHide').hide(100);
                    ads_type_manage(0);
                    $('#daily-ads-visibility-mode').val(0);
                }
            };
            var visibilityBtn = document.querySelector('#daily-ads-visibility-btn');
            visibilityBtn.onchange = function () {
                if (visibilityBtn.checked) {
                    $('#daily-ads-visibility-mode').val(1);
                } else {
                    $('#daily-ads-visibility-mode').val(0);
                }
            };
        </script>

    </body>
</html>