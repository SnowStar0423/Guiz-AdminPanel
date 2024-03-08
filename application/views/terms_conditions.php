<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Terms Conditions | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <div class="col-md-8">
                                <h1>Terms Conditions <small> Terms for App Usage</small></h1>
                            </div>
                            <div class="col-md-4 float-right">
                                <a href='play-store-terms-conditions' target='_blank' class='<?= BUTTON_CLASS ?> btn-sm'>Terms & Conditions Page for Play Store</a>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body mt-4">
                                            <form method="post" class="needs-validation" novalidate="">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">  
                                                    <div class="col-md-10 col-sm-10 offset-1">
                                                        <textarea id="message" name="message" class="form-control"><?php echo ($setting) ? $setting['message'] : '' ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10 offset-1">
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