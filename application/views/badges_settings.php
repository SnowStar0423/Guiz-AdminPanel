<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Badges Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Badges Settings</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Notification Settings</h6>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label class="control-label">Title</label>
                                                        <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $notification_title ? $notification_title['message'] : "Congratulations !"?>"/>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label class="control-label">Body</label>
                                                        <textarea name="body" class="form-control" rows="2" placeholder="Enter your notification message here..."><?php echo $notification_body ? $notification_body['message'] : "You have unlocked new badge"?></textarea>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Dashing Debut</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="dashing_debut_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($dashing_debut) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $dashing_debut['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>                                                    
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="dashing_debut_label" value="<?= (!empty($dashing_debut['badge_label'])) ? $dashing_debut['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="dashing_debut_note" required class="form-control"><?= (!empty($dashing_debut['badge_note'])) ? $dashing_debut['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="dashing_debut_reward" value="<?= (!empty($dashing_debut['badge_reward'])) ? $dashing_debut['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="dashing_debut_counter" value="<?= (!empty($dashing_debut['badge_counter'])) ? $dashing_debut['badge_counter'] : "1" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Combat Winner</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="combat_winner_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($combat_winner) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $combat_winner['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="combat_winner_label" value="<?= (!empty($combat_winner['badge_label'])) ? $combat_winner['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>                                                   
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="combat_winner_note" required class="form-control"><?= (!empty($combat_winner['badge_note'])) ? $combat_winner['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="combat_winner_reward" value="<?= (!empty($combat_winner['badge_reward'])) ? $combat_winner['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="combat_winner_counter" value="<?= (!empty($combat_winner['badge_counter'])) ? $combat_winner['badge_counter'] : "1" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Clash Winner</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="clash_winner_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($clash_winner) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $clash_winner['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="clash_winner_label" value="<?= (!empty($clash_winner['badge_label'])) ? $clash_winner['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="clash_winner_note" required class="form-control"><?= (!empty($clash_winner['badge_note'])) ? $clash_winner['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="clash_winner_reward" value="<?= (!empty($clash_winner['badge_reward'])) ? $clash_winner['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="clash_winner_counter" value="<?= (!empty($clash_winner['badge_counter'])) ? $clash_winner['badge_counter'] : "1" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Most Wanted Winner</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="most_wanted_winner_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($most_wanted_winner) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $most_wanted_winner['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="most_wanted_winner_label" value="<?= (!empty($most_wanted_winner['badge_label'])) ? $most_wanted_winner['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>                                                    
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="most_wanted_winner_note" required class="form-control"><?= (!empty($most_wanted_winner['badge_note'])) ? $most_wanted_winner['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="most_wanted_winner_reward" value="<?= (!empty($most_wanted_winner['badge_reward'])) ? $most_wanted_winner['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="most_wanted_winner_counter" value="<?= (!empty($most_wanted_winner['badge_counter'])) ? $most_wanted_winner['badge_counter'] : "1" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Ultimate Player</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="ultimate_player_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($ultimate_player) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $ultimate_player['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="ultimate_player_label" value="<?= (!empty($ultimate_player['badge_label'])) ? $ultimate_player['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="ultimate_player_note" required class="form-control"><?= (!empty($ultimate_player['badge_note'])) ? $ultimate_player['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="ultimate_player_reward" value="<?= (!empty($ultimate_player['badge_reward'])) ? $ultimate_player['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">

                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Quiz Warrior</h6>
                                                    </div>                                                   
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="quiz_warrior_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($quiz_warrior) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $quiz_warrior['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="quiz_warrior_label" value="<?= (!empty($quiz_warrior['badge_label'])) ? $quiz_warrior['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="quiz_warrior_note" required class="form-control"><?= (!empty($quiz_warrior['badge_note'])) ? $quiz_warrior['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="quiz_warrior_reward" value="<?= (!empty($quiz_warrior['badge_reward'])) ? $quiz_warrior['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="quiz_warrior_counter" value="<?= (!empty($quiz_warrior['badge_counter'])) ? $quiz_warrior['badge_counter'] : "3" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Super Sonic</h6>
                                                    </div>                                                    
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="super_sonic_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($super_sonic) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $super_sonic['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="super_sonic_label" value="<?= (!empty($super_sonic['badge_label'])) ? $super_sonic['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="super_sonic_note" required class="form-control"><?= (!empty($super_sonic['badge_note'])) ? $super_sonic['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="super_sonic_reward" value="<?= (!empty($super_sonic['badge_reward'])) ? $super_sonic['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter <small>(in seconds)</small></label>
                                                        <input type="number" min="1" name="super_sonic_counter" value="<?= (!empty($super_sonic['badge_counter'])) ? $super_sonic['badge_counter'] : "25" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Flashback</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="flashback_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($flashback) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $flashback['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="flashback_label" value="<?= (!empty($flashback['badge_label'])) ? $flashback['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="flashback_note" required class="form-control"><?= (!empty($flashback['badge_note'])) ? $flashback['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="flashback_reward" value="<?= (!empty($flashback['badge_reward'])) ? $flashback['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter <small>(in seconds)</small></label>
                                                        <input type="number" name="flashback_counter" value="<?= (!empty($flashback['badge_counter'])) ? $flashback['badge_counter'] : "4" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Brainiac</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="brainiac_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($brainiac) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $brainiac['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="brainiac_label" value="<?= (!empty($brainiac['badge_label'])) ? $brainiac['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="brainiac_note" required class="form-control"><?= (!empty($brainiac['badge_note'])) ? $brainiac['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="brainiac_reward" value="<?= (!empty($brainiac['badge_reward'])) ? $brainiac['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>                                                   
                                                    <div class="col-md-2 col-sm-12">

                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Big Thing</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="big_thing_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($big_thing) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $big_thing['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="big_thing_label" value="<?= (!empty($big_thing['badge_label'])) ? $big_thing['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>   
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="big_thing_note" required class="form-control"><?= (!empty($big_thing['badge_note'])) ? $big_thing['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="big_thing_reward" value="<?= (!empty($big_thing['badge_reward'])) ? $big_thing['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="big_thing_counter" value="<?= (!empty($big_thing['badge_counter'])) ? $big_thing['badge_counter'] : "5000" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Elite</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="elite_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($elite) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $elite['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="elite_label" value="<?= (!empty($elite['badge_label'])) ? $elite['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="elite_note" required class="form-control"><?= (!empty($elite['badge_note'])) ? $elite['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="elite_reward" value="<?= (!empty($elite['badge_reward'])) ? $elite['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter <small>(in coins)</small></label>
                                                        <input type="number" min="1" name="elite_counter" value="<?php echo (!empty($elite['badge_counter'])) ? $elite['badge_counter'] : "5000" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Thirsty</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="thirsty_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($thirsty) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $thirsty['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="thirsty_label" value="<?= (!empty($thirsty['badge_label'])) ? $thirsty['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="thirsty_note" required class="form-control"><?= (!empty($thirsty['badge_note'])) ? $thirsty['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="thirsty_reward" value="<?= (!empty($thirsty['badge_reward'])) ? $thirsty['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter <small>(in days)</small></label>
                                                        <input type="number" min="1" name="thirsty_counter" value="<?php echo (!empty($thirsty['badge_counter'])) ? $thirsty['badge_counter'] : "30" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Power Elite</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="power_elite_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($power_elite) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $power_elite['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="power_elite_label" value="<?= (!empty($power_elite['badge_label'])) ? $power_elite['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="power_elite_note" required class="form-control"><?= (!empty($power_elite['badge_note'])) ? $power_elite['badge_note'] : "" ?></textarea>
                                                    </div>   
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="power_elite_reward" value="<?= (!empty($power_elite['badge_reward'])) ? $power_elite['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="power_elite_counter" value="<?php echo (!empty($power_elite['badge_counter'])) ? $power_elite['badge_counter'] : "10" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Sharing is Caring</h6>
                                                    </div>                                                    
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="sharing_caring_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($sharing_caring) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $sharing_caring['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="sharing_caring_label" value="<?= (!empty($sharing_caring['badge_label'])) ? $sharing_caring['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="sharing_caring_note" required class="form-control"><?= (!empty($sharing_caring['badge_note'])) ? $sharing_caring['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="sharing_caring_reward" value="<?= (!empty($sharing_caring['badge_reward'])) ? $sharing_caring['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter</label>
                                                        <input type="number" min="1" name="sharing_caring_counter" value="<?php echo (!empty($sharing_caring['badge_counter'])) ? $sharing_caring['badge_counter'] : "50" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h6 class="font-weight-bold">Streak</h6>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Icon</label>
                                                        <input name="streak_file" type="file" accept="image/*" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1 col-sm-12 text-center">
                                                        <?php if ($streak) { ?>
                                                            <img src="<?= base_url() . BADGE_IMG_PATH . $streak['badge_icon'] ?>" width="100%"/>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Label</label>
                                                        <input name="streak_label" value="<?= (!empty($streak['badge_label'])) ? $streak['badge_label'] : "" ?>" type="text" required class="form-control"/>
                                                    </div>      
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <textarea name="streak_note" required class="form-control"><?= (!empty($streak['badge_note'])) ? $streak['badge_note'] : "" ?></textarea>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Reward <small>(coins)</small></label>
                                                        <input name="streak_reward" value="<?= (!empty($streak['badge_reward'])) ? $streak['badge_reward'] : "1" ?>" type="number" min="1" required class="form-control"/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label class="control-label">Counter <small>(in days)</small></label>
                                                        <input type="number" min="1" name="streak_counter" value="<?php echo (!empty($streak['badge_counter'])) ? $streak['badge_counter'] : "30" ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <hr>
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


    </body>
</html>