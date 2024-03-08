<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Firebase Configurations | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Firebase Configurations </h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body mt-4">
                                            <form method="post" class="needs-validation" novalidate=""  enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">                                                
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <?php
                                                        $target_path = getcwd() . DIRECTORY_SEPARATOR;
                                                        $file_name = $target_path . 'assets/firebase_config.json';
                                                        $is_file = 0;
                                                        if (file_exists($file_name)) {
                                                            $is_file = 1;                                                           
                                                        }
                                                         ?>
                                                         <label class="control-label">Current File Status : <?= ($is_file) ? '<small class="badge badge-success">File Exists</small>' : '<small class="badge badge-danger">File Not Exists, Please Upload</small>' ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">                                                   
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Update File <small class="text-danger">Only json file allow</small></label>
                                                        <input id="file" name="file" type="file" accept=".json" required class="form-control">
                                                    </div>  
                                                </div> 
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>"/>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr/>
                                            <ol>
                                                <li>Open <a href="https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk" target="_blank">https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk </a> and select the project you want to generate a private key file for.</li>
                                                <li>Click Generate New Private Key, then confirm by clicking Generate Key, then <b>upload generated .json file</b>.
                                                    <img src="<?= base_url().'assets/generate-key.png'?>" width="100%"/>
                                                </li>
                                            </ol>
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