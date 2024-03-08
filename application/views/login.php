<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Admin Login | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

        <?php base_url() . include 'include.php'; ?>
    </head>

    <body >
        <div class="login" style="background-image: url(<?= isset($background_file['message']) && !empty($background_file['message']) ? base_url() . LOGO_IMG_PATH . $background_file['message'] : base_url() . LOGO_IMG_PATH .'background-image-stock.png'; ?>); background-position: center;">
            <div class="overlay">
                <div id="app">
                    <section class="login-section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 col-lg-7"></div>
                                <div class="col-md-8 col-lg-4">
                                    <div class="card login_card">
                                        <div class="login-brand">
                                            <?php if (!empty($full_logo)) { ?>
                                                <img src="<?= base_url() . LOGO_IMG_PATH . $full_logo['message']; ?>" alt="logo" width="150">
                                            <?php } ?>
                                        </div>
                                        <div class="login-welcome-text">
                                            <h3>Sign In</h3>
                                            <p>Welcome! Let's get started. Sign in to explore</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="<?= base_url() ?>loginMe" class="needs-validation" novalidate="">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group">
                                                    <label for="email">Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Enter Username" required autofocus>
                                                    <div class="invalid-feedback">
                                                        Please fill in your Username
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="d-block">
                                                        <label for="password" class="control-label">Password</label>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                                    <div class="invalid-feedback">
                                                        Please fill in your Password
                                                    </div>
                                                </div>

                                                <label class="checkbox">
                                                    <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
                                                </label>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                        Login
                                                    </button>
                                                </div>
                                            </form>

                                            <?php $footer_copyrights_text = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array(); ?>
                                            <div class="text-center mt-4 pb-3">
                                            <?php
                                                if(isset($footer_copyrights_text) && !empty($footer_copyrights_text['message'])){?>
                                                    <div class="text-muted"> <?= $footer_copyrights_text['message'] ?> </div>
                                                <?php }else{?>
                                                    <div class="text-muted"> Copyright &copy; WRTeam <?= date('Y') ?></div>
                                                <?php }
                                            ?>
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

        <!-- General JS Scripts -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Template JS File -->
        <script src="<?= base_url(); ?>assets/js/stisla.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/scripts.js" type="text/javascript"></script>

        <!-- Toast JS -->
        <script src="<?= base_url(); ?>assets/js/iziToast.min.js"></script>

        <?php if ($this->session->flashdata('error')) { ?>
            <script type='text/javascript'>
                iziToast.error({
                    message: '<?= $this->session->flashdata('error'); ?>',
                    position: 'topRight'
                });
            </script>
        <?php } ?>
    </body>

</html>
