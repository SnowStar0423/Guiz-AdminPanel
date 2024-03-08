<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

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
                        <h1>Home Settings for Web <small class="text-small">Note that this will directly reflect the changes in Web</small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="text-sm text-danger mb-4"><strong>Note :- </strong> Description Recommended Content is 120 words and Ttile Recommended is 50 words.</div>
                                    <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">


                                        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                        <!-- Section 1  -->
                                        <h4>
                                            <label class="control-label"><b>Section 1</b></label>
                                        </h4>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="control-label">Heading</label>
                                                <input name="section1_heading" type="text" minlength=1 maxlength="50" class="form-control"  value="<?php echo (isset($section1_heading) && !empty($section1_heading['message'])) ? $section1_heading['message'] : ""?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Title 1</label>
                                                <input name="section1_title1" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (isset($section1_title1) && !empty($section1_title1['message'])) ? $section1_title1['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Title 2</label>
                                                <input name="section1_title2" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (isset($section1_title2) && !empty($section1_title2['message'])) ? $section1_title2['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Title 3</label>
                                                <input name="section1_title3" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (isset($section1_title3) && !empty($section1_title3['message'])) ? $section1_title3['message'] : "" ?>' required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Image 1</label>
                                                <?php if(isset($section1_image1['message']) && !empty($section1_image1['message'])) { ?>
                                                    <input class="form-control section1_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image1">
                                                    <p style="display: none" id="section1_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image1['message'] ?>' height=50, width=50></a></div>
                                                <?php }else{?>
                                                    <input class="form-control section1_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image1" required>
                                                    <p style="display: none" id="section1_image1_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Image 2</label>
                                                <?php if(isset($section1_image2['message']) && !empty($section1_image2['message'])) { ?>
                                                    <input class="form-control section1_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image2">
                                                    <p style="display: none" id="section1_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image2['message'] ?>' height=50, width=50></a></div>
                                                <?php } else { ?>
                                                    <input class="form-control section1_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image2" required>
                                                    <p style="display: none" id="section1_image2_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Image 3</label>
                                                <?php if(isset($section1_image3['message']) && !empty($section1_image3['message'])) { ?>
                                                    <input class="form-control section1_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image3">
                                                    <p style="display: none" id="section1_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image3['message'] ?>' height=50, width=50></a></div>
                                                <?php } else { ?>
                                                    <input class="form-control section1_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image3" required>
                                                    <p style="display: none" id="section1_image3_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-4">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Description 1</label>
                                                <textarea name="section1_desc1" class="form-control" id="section1_desc1" cols="20" rows="5" placeholder="Enter Description for Title 1"><?php echo (isset($section1_desc1) && !empty($section1_desc1['message'])) ? $section1_desc1['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Description 2</label>
                                                <textarea name="section1_desc2" class="form-control" id="section1_desc2" cols="20" rows="5" placeholder="Enter Description for Title 2"><?php echo (isset($section1_desc2) && !empty($section1_desc2['message'])) ? $section1_desc2['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label">Description 3</label>
                                                <textarea name="section1_desc3" class="form-control" id="section1_desc3" cols="20" rows="5" placeholder="Enter Description for Title 3"><?php echo (isset($section1_desc3) && !empty($section1_desc3['message'])) ? $section1_desc3['message'] : ""?></textarea>
                                            </div>
                                        </div>



                                        <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                        <!-- Section 2  -->
                                        <hr class="mt-4 mb-4">
                                        <h4>
                                            <label class="control-label"><b>Section 2</b></label>
                                        </h4>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="control-label">Heading</label>
                                                <input name="section2_heading" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo ( isset($section2_heading) && !empty($section2_heading['message'])) ? $section2_heading['message'] : ""?>' required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 1</label>
                                                <input name="section2_title1" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo ( isset($section2_title1) && !empty($section2_title1['message'])) ? $section2_title1['message'] :"" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 2</label>
                                                <input name="section2_title2" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo ( isset($section2_title2) && !empty($section2_title2['message'])) ? $section2_title2['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 3</label>
                                                <input name="section2_title3" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo ( isset($section2_title3) && !empty($section2_title3['message'])) ? $section2_title3['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 
                                                <input name="section2_title4" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo ( isset($section2_title4) && !empty($section2_title4['message'])) ? $section2_title4['message'] : "" ?>' required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 1</label>
                                                <textarea name="section2_desc1" class="form-control" id="section2_desc1" cols="20" rows="5" placeholder="Enter Description for Title 1"><?php echo (isset($section2_desc1) && !empty($section2_desc1['message'])) ? $section2_desc1['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 2</label>
                                                <textarea name="section2_desc2" class="form-control" id="section2_desc2" cols="20" rows="5" placeholder="Enter Description for Title 2"><?php echo (isset($section2_desc2) && !empty($section2_desc2['message'])) ? $section2_desc2['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 3</label>
                                                <textarea name="section2_desc3" class="form-control" id="section2_desc3" cols="20" rows="5" placeholder="Enter Description for Title 3"><?php echo (isset($section2_desc3) && !empty($section2_desc3['message'])) ? $section2_desc3['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 4</label>
                                                <textarea name="section2_desc4" class="form-control" id="section2_desc4" cols="20" rows="5" placeholder="Enter Description for Title 4"><?php echo (isset($section2_desc4) && !empty($section2_desc4['message'])) ? $section2_desc4['message'] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 1</label>
                                                <?php if(isset($section2_image1['message']) && !empty($section2_image1['message'])) { ?>
                                                    <input class="form-control section2_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image1">
                                                    <p style="display: none" id="section2_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image1['message'] ?>' height=50, width=50></a></div>
                                                <?php }else{?>
                                                    <input class="form-control section2_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image1" required>
                                                    <p style="display: none" id="section2_image1_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 2</label>
                                                <?php if(isset($section2_image2['message']) && !empty($section2_image2['message'])) { ?>
                                                    <input class="form-control section2_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image2">
                                                    <p style="display: none" id="section2_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image2['message'] ?>' height=50, width=50></a></div>
                                                <?php }else{?>
                                                    <input class="form-control section2_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image2" required>
                                                    <p style="display: none" id="section2_image2_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 3</label>
                                                <?php if(isset($section2_image3['message']) && !empty($section2_image3['message'])) { ?>
                                                    <input class="form-control section2_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image3">
                                                    <p style="display: none" id="section2_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image3['message'] ?>' height=50, width=50></a></div>
                                                <?php }else{?>
                                                    <input class="form-control section2_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image3" required>
                                                    <p style="display: none" id="section2_image3_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 4</label>
                                                <?php if(isset($section2_image4['message']) && !empty($section2_image4['message'])) { ?>
                                                    <input class="form-control section2_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image4">
                                                    <p style="display: none" id="section2_image4_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image4['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image4['message'] ?>' height=50, width=50></a></div>
                                                <?php }else{?>
                                                    <input class="form-control section2_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image4" required>
                                                    <p style="display: none" id="section2_image4_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                        <!-- Section 3  --> 
                                        <hr class="mt-4 mb-4">
                                        <h4>
                                            <label class="control-label"><b>Section 3</b></label>
                                        </h4>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="control-label">Heading</label>
                                                <input name="section3_heading" type="text" minlength=1 maxlength="50" class="form-control"  value="<?php echo (!empty($section3_heading['message'])) ? $section3_heading['message'] : "" ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 1</label>
                                                <input name="section3_title1" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (!empty($section3_title1['message'])) ? $section3_title1['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 2</label>
                                                <input name="section3_title2" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (!empty($section3_title2['message'])) ? $section3_title2['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 3</label>
                                                <input name="section3_title3" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (!empty($section3_title3['message'])) ? $section3_title3['message'] : "" ?>' required>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Title 4</label>
                                                <input name="section3_title4" type="text" minlength=1 maxlength="50" class="form-control"  value='<?php echo (!empty($section3_title4['message'])) ? $section3_title4['message'] : "" ?>' required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 1</label>
                                                <?php if(isset($section3_image1['message']) && !empty($section3_image1['message'])) { ?>
                                                    <input class="form-control section3_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image1">
                                                    <p style="display: none" id="section3_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image1['message'] ?>' height=50, width=50></a></div>
                                                <?php } else { ?>
                                                    <input class="form-control section3_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image1" required>
                                                    <p style="display: none" id="section3_image1_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 2</label>
                                                <?php if(isset($section3_image2['message']) && !empty($section3_image2['message'])) { ?>
                                                    <input class="form-control section3_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image2">
                                                    <p style="display: none" id="section3_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image2['message'] ?>' height=50, width=50></a></div>
                                                <?php } else { ?>
                                                    <input class="form-control section3_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image2" required>
                                                    <p style="display: none" id="section3_image2_img_error_msg" class="alert alert-danger"></p>
                                                <?php }?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 3</label>
                                                <?php if(isset($section3_image3['message']) && !empty($section3_image3['message'])) { ?>
                                                    <input class="form-control section3_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image3">
                                                    <p style="display: none" id="section3_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image3['message'] ?>' height=50, width=50></a></div>
                                                <?php } else {?>
                                                    <input class="form-control section3_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image3" required>
                                                    <p style="display: none" id="section3_image3_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Image 4</label>
                                                <?php if(isset($section3_image4['message']) && !empty($section3_image4['message'])) { ?>
                                                    <input class="form-control section3_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image4">
                                                    <p style="display: none" id="section3_image4_img_error_msg" class="alert alert-danger"></p>
                                                    <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image4['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image4['message'] ?>' height=50, width=50></a></div>
                                                <?php } else { ?>
                                                    <input class="form-control section3_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image4" required>
                                                    <p style="display: none" id="section3_image4_img_error_msg" class="alert alert-danger"></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 1</label>
                                                <textarea name="section3_desc1" class="form-control" id="section3_desc1" cols="20" rows="5" placeholder="Enter Description for Title 1"><?php echo (isset($section3_desc1) && !empty($section3_desc1['message'])) ? $section3_desc1['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 2</label>
                                                <textarea name="section3_desc2" class="form-control" id="section3_desc2" cols="20" rows="5" placeholder="Enter Description for Title 2"><?php echo (isset($section3_desc2) && !empty($section3_desc2['message'])) ? $section3_desc2['message'] : "" ?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 3</label>
                                                <textarea name="section3_desc3" class="form-control" id="section3_desc3" cols="20" rows="5" placeholder="Enter Description for Title 3"><?php echo (isset($section3_desc3) && !empty($section3_desc3['message'])) ? $section3_desc3['message'] : ""?></textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="control-label">Description 4</label>
                                                <textarea name="section3_desc4" class="form-control" id="section3_desc4" cols="20" rows="5" placeholder="Enter Description for Title 4"><?php echo (isset($section3_desc4) && !empty($section3_desc4['message'])) ? $section3_desc4['message'] : ""?></textarea>
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
                </section>
            </div>
        </div>
    </div>

    <?php base_url() . include 'footer.php'; ?>


    <script>
        // get the value of all the images
        let images = ['section1_image1','section1_image2','section1_image3','section2_image1','section2_image2','section2_image3','section2_image4',,'section3_image1','section3_image1','section3_image2','section3_image3','section3_image4'];

        //added in loop to check the upload file validation
        $.each(images, function(index, value) {
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
