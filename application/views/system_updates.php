<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>System Update | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>System Update <small class="text-danger"> Current Version <?php echo (!empty($system_version['message'])) ? $system_version['message'] : "" ?></small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body mt-4">
                                            <form method="post" class="needs-validation" novalidate=""  enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <?php
                                                $quiz_url = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                                                ?>
                                                <input type="hidden" name="quiz_url" value="<?= $quiz_url; ?>" required/>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label>Purchase Code</label>
                                                        <input type="text" name="purchase_code" required placeholder="Enter Purchase Code" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">                                                   
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Update Zip <small class="text-danger">Only zip file allow</small></label>
                                                        <input id="file" name="file" type="file" accept=".zip,.rar" required class="form-control">
                                                        <small class="text-danger">Your Current Version is <?php echo (!empty($system_version['message'])) ? $system_version['message'] : "" ?> , Please update nearest version here if available</small>
                                                    </div>  
                                                </div> 
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
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

                <!-- Button For Modal Trigger -->
                <button type="button" class="btn btn-primary" data-toggle="modal" id="openModalButton" data-target="#exampleModal">
            </div>
        </div>

        <?php base_url() . include 'footer.php'; ?>

        <?php
            $json_file = 'assets/firebase_config.json';
            if (!file_exists($json_file)) {
                redirect('firebase-configurations');
            }
        ?>


            <!-- for giving the instruction to Update Data after updating version 2.1.5 -->
            <?php
                $res = $this->db->query("SELECT * From tbl_settings where type = 'system_version'")->row();
                if($res->type == 'system_version'){
                    if($res->message == '2.1.5'){
                        $categoryDataCount = $this->db->query("SELECT COUNT(*) as totalCategoryData FROM tbl_category")->row();
                        if($categoryDataCount->totalCategoryData > 0){
                            $categoryExistsSlug = $this->db->query("SELECT COUNT(*) as slugExists FROM tbl_category where slug is not null")->row();
                            $categoryExistsSlug = $categoryExistsSlug->slugExists;
                        }

                        $subCategoryDataCount = $this->db->query("SELECT COUNT(*) as totalSubCategoryData FROM tbl_subcategory")->row();
                        if($subCategoryDataCount->totalSubCategoryData > 0){
                            $subCategoryExistsSlug = $this->db->query("SELECT COUNT(*) as slugExists FROM tbl_subcategory where slug is not null")->row();
                            $subCategoryExistsSlug = $subCategoryExistsSlug->slugExists;
                        } 
                        
                        if((isset($categoryExistsSlug) && $categoryExistsSlug == 0 ) || (isset($subCategoryExistsSlug) && $subCategoryExistsSlug == 0)) { ?>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" data-keyboard="false"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Important Notes</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="alert alert-info"><strong>NOTE</strong> :- These changes are required for WEB Product Only</p> 
                                            <ol>
                                                <h6>Please Update Slug For Category and Subcategory</h6>
                                                <hr>
                                                <h6>
                                                    List Of Modes
                                                </h6>
                                                <li> Quiz Zone </li>
                                                <li> Fun N Learn Zone </li>
                                                <li> Guess The Word Zone </li>
                                                <li> Audio Quiz Word Zone </li>
                                                <li> Maths Quiz Zone </li>
                                                <hr>
                                                <p>
                                                    <span class="d-block">Example Link Category Data's Slug</span>
                                                    <span class="d-block"><strong>Quiz Zone </strong> :- <a href="<?= base_url() ?>/main-category">Click Here to Redirect to Category Page</a></span>
                                                    <span class="d-block"><strong>Fun N Learn Zone </strong> :- <a href="<?= base_url() ?>/fun-n-learn-category">Click Here to Redirect to Category Page</a></span>
                                                    <span class="d-block"><strong>Guess The Word Zone </strong> :- <a href="<?= base_url() ?>/guess-the-word-category">Click Here to Redirect to Category Page</a></span>
                                                    <span class="d-block"><strong>Audio Zone </strong> :- <a href="<?= base_url() ?>/audio-question-category">Click Here to Redirect to Category Page</a></span>
                                                    <span class="d-block"><strong>Maths Zone </strong> :- <a href="<?= base_url() ?>/maths-question-category">Click Here to Redirect to Category Page</a></span>
                                                </p>
                                                <p>
                                                    <span class="d-block">Example Link Quiz Zone's Sub-Category Data's Slug</span>
                                                    <span class="d-block"><strong> Quiz Zone </strong> :- <a href="<?= base_url() ?>/sub-category">Click Here to Redirect to Sub-Category Page</a></span>
                                                    <span class="d-block"><strong> Fun N Learn Zone </strong> :- <a href="<?= base_url() ?>/fun-n-learn-subcategory">Click Here to Redirect to Sub-Category Page</a></span>
                                                    <span class="d-block"><strong> Guess The Word Zone </strong> :- <a href="<?= base_url() ?>/guess-the-word-subcategory">Click Here to Redirect to Sub-Category Page</a></span>
                                                    <span class="d-block"><strong> Audio Zone </strong> :- <a href="<?= base_url() ?>/audio-question-subcategory">Click Here to Redirect to Sub-Category Page</a></span>
                                                    <span class="d-block"><strong> Maths Zone </strong> :- <a href="<?= base_url() ?>/maths-question-subcategory">Click Here to Redirect to Sub-Category Page</a></span>
                                                </p> 
                                            </ol>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php 
                        }   
                    }
                }
            ?>

    </body>
    <script>
        $(document).ready(function() {
            // Trigger the modal to open after a delay (e.g., 1 second)
            $("#openModalButton").click();
        });
    </script>
</html>