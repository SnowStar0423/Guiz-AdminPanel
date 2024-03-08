<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>How to Play | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>How to Play <small class="text-small">Update How to Play here</small></h1>
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
                                                        <input name="img" type="file" accept="image/*" id="upload" style="display: none" onchange="">
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

        <script>
            $(document).ready(function () {
                $(document).on('focusin', function (e) {
                    if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
                        e.stopImmediatePropagation();
                    }
                });

                var base_url = "<?php echo base_url(); ?>";
                tinymce.init({
                    selector: "#message",
                    height: 250,
                    plugins: [
                        "advlist autolink lists link image charmap preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor colorpicker textpattern"
                    ],
                    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview | forecolor backcolor emoticons",
                    image_advtab: true,
                    images_upload_url: base_url + "upload_img",
                    relative_urls: false,
                    remove_script_host: false,
                    file_picker_callback: function (callback, value, meta) {
                        if (meta.filetype == "media" || meta.filetype == "image") {

                            jQuery("#upload").trigger("click");
                            $("#upload").unbind('change');

                            jQuery("#upload").on("change", function () {
                                var file = this.files[0];
                                var reader = new FileReader();

                                var fd = new FormData();
                                var files = file;
                                fd.append("file", files);
                                fd.append('filetype', meta.filetype);

                                var filename = "";
                                jQuery.ajax({
                                    url: base_url + "upload_img",
                                    type: "post",
                                    data: fd,
                                    contentType: false,
                                    processData: false,
                                    async: false,
                                    success: function (response) {
                                        filename = response;
                                    }
                                });

                                reader.onload = function (e) {
                                    callback("images/instruction/" + filename);
                                };
                                reader.readAsDataURL(file);
                            });
                        }
                    },
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