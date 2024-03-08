<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Import Questions | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Import Questions <small class="text-small">upload using CSV file</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">  
                                                    <div class="col-md-6 col-sm-10 offset-2">
                                                        <label>CSV Questions file</label>   
                                                        <input type="file" name="file" id="questions_file" required class="form-control" accept=".csv" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3 col-sm-6 offset-2 my-1">
                                                        <input type="submit" name="btnadd" value="Upload CSV file" class="<?= BUTTON_CLASS ?>"/>

                                                    </div>
                                                    <div class="col-md-4 col-sm-6 my-1">
                                                        <a class="btn btn-primary" href='<?= base_url(); ?>assets/data-format.csv' target="_blank" download> <em class='fas fa-download'></em> Download Sample File Here</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="mt-4">
                                                <h5 class="text-danger">How to convert CSV in to Unicode (For Non English)</h5>
                                                <p>1. Fill the data in excel sheet which formate we given<p>
                                                <p>2. SAVE AS this file <strong>Unicode Text (*.txt)</strong></p>
                                                <p>3. Open .txt file in Notepad.</p>
                                                <p>4. Replace Tab space(    ) with ( , )comma.</p>
                                                <p>5. Save as this file with .txt extension and change the encoding : <b>UTF-8</b>.</p>
                                                <p>6. Change the file extension .txt to .csv.</p>
                                                <p>7. Now this file use import question.</p>
                                                <p><a href="https://www.ablebits.com/office-addins-blog/2014/04/24/convert-excel-csv/" target="_blank">For more info</a></p>
                                            </div>
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