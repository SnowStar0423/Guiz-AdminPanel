<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reset Password | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>        
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
                            <h1>Reset Password</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="password_form" method="post" class="needs-validation" novalidate="">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">                                                    
                                                    <div class="col-md-6 col-sm-8">
                                                        <label>Old Password <span class="required">*</span></label>
                                                        <input type="password" id="old_password" name="oldpassword" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-1">                                                        
                                                        <label id="old_status" class="mt-4"></label>
                                                    </div>                                                    
                                                </div>

                                                <div class="form-group row">                                                   
                                                    <div class="col-md-6 col-sm-8">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input type="password" id="new_password" name="newpassword" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">                                                    
                                                    <div class="col-md-6 col-sm-8">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input type="password" id="confirm_password" name="confirmpassword" class="form-control" required>
                                                        <div class="invalid-feedback">
                                                            Passwords do not match!
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-8">
                                                        <input name="btnchange" value="Submit" type="submit" id="submit" class="<?= BUTTON_CLASS ?>">
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
            $('#confirm_password').on('keyup', function () {
                if ($('#new_password').val() == $('#confirm_password').val()) {
                $('#confirm_password').removeClass('is-invalid');
                $('#confirm_password').addClass('is-valid');
                $('#submit').prop('disabled', false);
                } else {
                $('#confirm_password').removeClass('is-valid');
                $('#confirm_password').addClass('is-invalid');
                $('#submit').prop('disabled', true);
                }
            });
            $(document).ready(function () {
                $('#old_password').on('blur input', function () {
                    var old_password = $(this).val();
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: "checkOldPass",
                        data: {oldpass: old_password},
                        beforeSend: function () {
                            $('#old_status').html('Checking..');
                        },
                        success: function (result) {
                            if (result == 'True') {
                                $('#old_status').html("<i class='fa fa-check-circle fa-2x text-primary mt-2'></i>");
                                allowsubmit = true;
                            } else {
                                $('#old_status').html("<i class='fa fa-times-circle fa-2x text-danger mt-2'></i>");
                                $('#old_password').focus();
                                allowsubmit = false;
                            }
                        },
                        error: function (result) {
                            $('#old_status').html("Error" + result);
                        }
                    });
                });
            });
            $(document).ready(function () {
                $('#password_form').submit(function () {
                    if (allowsubmit) {
                        return true;
                    } else {
                        return false;
                    }
                });                
            });
        </script>

    </body>

</html>