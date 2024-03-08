<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Questions for Maths Quiz | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

        <?php base_url() . include 'include.php'; ?>  
        <script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">
                <?php base_url() . include 'header.php'; ?>  

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>Create and Manage Maths Questions</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Maths Questions</h4>
                                        </div>
                                        <div class="card-body">
                                            <form id="frmQuestion" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                
                                                <?php
                                                $question_id = $this->uri->segment(2);                                               
                                                $sess_language_id = '0';
                                                $sess_category = '0';
                                                $sess_subcategory = '0';
                                                $sess_question_type = "";
                                                if($question_id != ''){
                                                    $sess_language_id = (!empty($data)) ? $data[0]->language_id : 0;
                                                    $sess_category = (!empty($data)) ? $data[0]->category : 0;
                                                    $sess_subcategory = (!empty($data)) ? $data[0]->subcategory : 0;
                                                    $sess_question_type = (!empty($data)) ? $data[0]->question_type : "";
                                                } else if ($this->session->userdata()) {
                                                    $type = $this->uri->segment(1);
                                                    $sess_data = $this->session->userdata("$type");
                                                    if (!empty($sess_data)) {
                                                        $sess_language_id = $sess_data['language_id'];
                                                        $sess_category = $sess_data['category'];
                                                        $sess_subcategory = $sess_data['subcategory'];
                                                    }
                                                }
                                                ?>
                                                   <?php if ($question_id != '') { ?>
                                                <input type="hidden" id="edit_id" name="edit_id" required value="<?= $question_id ?>" aria-required="true">
                                                <input type="hidden" id="image_url" name="image_url" value="<?= ($question_id != '') ? ((!empty($data)) ? (($data[0]->image != '') ? MATHS_QUESTION_IMG_PATH . $data[0]->image : '') : '') : '' ?>">
                                            <?php } ?> 
                                                <div class="form-group row">                                               
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Language</label>
                                                            <select name="language_id" id="language_id" class="form-control" required>
                                                                <option value="">Select Language</option>
                                                                <?php foreach ($language as $lang) { ?>
                                                                    <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                                <?php } ?> 
                                                            </select>
                                                        </div>    
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Main Category</label>
                                                            <select id="category" name="category" class="form-control" required>
                                                                <option value="">Select Main Category</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Sub Category</label>
                                                            <select id="subcategory" name="subcategory" class="form-control">
                                                                <option value="">Select Sub Category</option>
                                                            </select>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Main Category</label>
                                                            <select id="category" name="category" class="form-control" required>
                                                                <option value="">Select Main Category</option>
                                                                <?php foreach ($category as $cat) { ?>
                                                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php } ?> 
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Sub Category</label>
                                                            <select id="subcategory" name="subcategory" class="form-control">
                                                                <option value="">Select Sub Category</option>
                                                            </select>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Question</label>
                                                        <textarea id="question" name="question" class="form-control" required><?= ($question_id != '') ? ((!empty($data)) ? $data[0]->question : '') : '' ?></textarea>
                                                    </div>                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <?php if($question_id == ""){?>
                                                        <div class="col-md-6 col-sm-12">  
                                                            <label class="control-label">Question Type</label>
                                                            <div>
                                                                <div class="form-check-inline bg-light p-2">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="question_type" value="1" <?= ($question_id ==  '') ? 'checked' : '' ?> <?= (!empty($data)) ? (($data[0]->question_type == '1') ? 'checked' : '') : '' ?> required>Options
                                                                    </label>
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="question_type" value="2" <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->question_type == '2') ? 'checked' : '') : '') : '' ?> >True / False
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }else{?>
                                                        <input type="hidden" name="question_type" value="<?=$sess_question_type?>">
                                                    <?php } ?>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Image for Question <small>( if any )</small></label>
                                                        <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                        <small class="text-danger">Image type supported (png, jpg and jpeg)</small>
                                                        <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                    </div>     
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option A</label>                                                
                                                        <textarea class="form-control" id="a" name="a" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optiona : '') : '' ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option B</label>
                                                        <textarea class="form-control" id="b" name="b" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optionb : '') : '' ?></textarea>
                                                    </div>
                                                </div>
                                                <div id="tf">
                                                    <div class="form-group row">                                                   
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option C</label>
                                                            <textarea class="form-control" id="c" name="c" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optionc : '') : '' ?></textarea>
                                                        </div>                                                    
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option D</label>
                                                            <textarea class="form-control" id="d" name="d" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optiond : '') : '' ?></textarea>
                                                        </div>
                                                    </div>
                                                    <?php if (is_option_e_mode_enabled()) { ?>
                                                        <div class="form-group row">                                                        
                                                            <div class="col-md-6 col-sm-12">
                                                                <label class="control-label">Option E</label>
                                                                <textarea class="form-control" id="e" name="e" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optione : '') : '' ?></textarea>
                                                            </div> 
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Answer</label>                                                  
                                                        <select name='answer' id='answer' class='form-control' required>
                                                            <option value=''>Select Right Answer</option>
                                                            <option value='a' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'a') ? 'selected' : '') : '') : '' ?>>A</option>
                                                            <option value='b' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'b') ? 'selected' : '') : '') : '' ?>>B</option>
                                                            <option class='ntf' value='c' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'c') ? 'selected' : '') : '') : '' ?>>C</option>
                                                            <option class='ntf' value='d' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'd') ? 'selected' : '') : '') : '' ?>>D</option>
                                                            <?php if (is_option_e_mode_enabled()) { ?>
                                                                <option class='ntf' value='e' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'e') ? 'selected' : '') : '') : '' ?>>E</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="form-group row">                                                    
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <small>(this will be showing with review section only)</small>
                                                        <textarea name='note' id="note" class='form-control'><?= ($question_id != '') ? ((!empty($data)) ? $data[0]->note : '') : '' ?></textarea>
                                                    </div>
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
            MathJax = {
                tex: {
                    inlineMath: [['$', '$'], ['\\(', '\\)']]
                }
            };
        </script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml.js"></script>
        <script type="text/javascript">
            function ckeditor_initialize() {
                const CKEDITOR_CONFIG = {
                    extraPlugins: 'mathjax,notification',
                    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
                    height: 100,
                    removeButtons: 'PasteFromWord,Image,Anchor'
                    };

                    const requiredFieldWarning = 'This field is required.';

                    var editorIds;

                    <?php if (is_option_e_mode_enabled()) { ?>
                        editorIds = ['question', 'a', 'b', 'c', 'd', 'e', 'note'];
                    <?php }else{ ?>
                        editorIds = ['question', 'a', 'b', 'c', 'd', 'note'];
                    <?php } ?>


                    const editors = editorIds.map(id => {
                    const editor = CKEDITOR.replace(id, CKEDITOR_CONFIG);
                    editor.on('required', evt => {
                        editor.showNotification(requiredFieldWarning, 'warning');
                        evt.cancel();
                    });
                return editor;
                });
                if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
                    document.getElementById('ie8-warning').className = 'tip alert';
                }
            }
            ckeditor_initialize();
        </script>


        <script type="text/javascript">
            if(<?= json_encode($question_id)?>){
                var question_type = "<?= $sess_question_type?>"
                if (question_type == "2") {
                    $('#tf').hide('fast');
                    $('#c').removeAttr('required').hide('fast');
                    $('#d').removeAttr('required').hide('fast');
                    $('#e').removeAttr('required').hide('fast');
                    $('.ntf').hide('fast');

                    $(document).ready(function () {
                        ckeditor_initialize();
                    });

                    const requiredFieldWarning = 'This field is required.';
                
                    const editorIds = ['c', 'd', 'e'];
                    editorIds.forEach(id => {
                        const editor = CKEDITOR.instances[id];
                        if (editor) {
                            editor.removeAllListeners();
                        }
                    });
                }else{
                    $('#tf').show('fast');
                    $('.ntf').show('fast');
                    $('#c').attr("required", "required").show();
                    $('#d').attr("required", "required").show();
                    $('#e').attr("required", "required").show();

                    $(document).ready(function () {
                        ckeditor_initialize();
                    });

                    // Get the CKEditor instance
                    const editorIds = ['a', 'b', 'c', 'd', 'e','note'];    
                    const requiredFieldWarning = 'This field is required.';

                    editorIds.forEach(id => {
                        const editor = CKEDITOR.instances[id];
                        if (editor) {
                            editor.on('required', evt => {
                                editor.showNotification(requiredFieldWarning, 'warning');
                                evt.cancel();
                            });
                        }
                    });
                }
            }
        </script>
        
        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var type = 'maths-question-subcategory';
            var sess_language_id = '<?= $sess_language_id ?>';
            var sess_category = '<?= $sess_category ?>';
            var sess_subcategory = '<?= $sess_subcategory ?>';
            $(document).ready(function () {
                if (sess_language_id != '0' || sess_category != '0') {
<?php if (is_language_mode_enabled()) { ?>
                        $('#language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
<?php } else { ?>
                        $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
<?php } ?>
                }
            });
            $('#language_id').on('change', function (e, row_language_id, row_category, row_subcategory) {
                var language_id = $('#language_id').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#category').html(result).trigger("change");
                        if (language_id == row_language_id && (row_category != '0' || row_category != 0) )
                            $('#category').val(row_category).trigger("change", [row_category, row_subcategory]);
                    }
                });
            });
           
            category_options = '';
<?php
$category_options = "<option value=''>Select Category</option>";
foreach ($category as $cat) {
    $category_options .= "<option value=" . $cat->id . ">" . $cat->category_name . "</option>";
}
?>
            category_options = "<?= $category_options; ?>";

            $('#category').on('change', function (e, row_category, row_subcategroy) {
                var category_id = $('#category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#subcategory').html(result);
                        if (category_id == row_category && (row_subcategroy != "0" || row_subcategroy != 0))
                            $('#subcategory').val(row_subcategroy);
                    }
                });
            });           
            
        </script>

        <script type="text/javascript">
            $('input[name="question_type"]').on("click", function (e) {
                var question_type = $(this).val();
                if (question_type == "2") {
                    $('#tf').hide('fast');
                    $('#a').val("<?= is_settings('true_value') ?>");
                    $('#b').val("<?= is_settings('false_value') ?>");
                    $('#c').removeAttr('required');
                    $('#d').removeAttr('required');
                    $('#e').removeAttr('required');
                    $('.ntf').hide('fast');

                    $(document).ready(function () {
                        ckeditor_initialize();
                    });
                    const editorIds = ['c', 'd', 'e'];
                    editorIds.forEach(id => {
                        const editor = CKEDITOR.instances[id];
                        if (editor) {
                            editor.removeAllListeners();
                        }
                    });
                } else {
                    $('#a').val('');
                    $('#b').val('');
                    $('#tf').show('fast');
                    $('.ntf').show('fast');
                    $('#c').attr("required", "required");
                    $('#d').attr("required", "required");
                    $('#e').attr("required", "required");

                    $(document).ready(function () {
                        ckeditor_initialize();
                    });
                    
                    // Get the CKEditor instance
                    const editorIds = ['a', 'b', 'c', 'd', 'e','note'];    
                    const requiredFieldWarning = 'This field is required.';

                    editorIds.forEach(id => {
                        const editor = CKEDITOR.instances[id];
                        if (editor) {
                            editor.on('required', evt => {
                                editor.showNotification(requiredFieldWarning, 'warning');
                                evt.cancel();
                            });
                        }
                    });
                }
            });
           
        </script>

        <script type="text/javascript">
            var _URL = window.URL || window.webkitURL;

            $("#file").change(function (e) {
                var file, img;

                if ((file = this.files[0])) {
                    img = new Image();
                    img.onerror = function () {
                        $('#file').val('');
                        $('#img_error_msg').html('<?= INVALID_IMAGE_TYPE; ?>');
                        $('#img_error_msg').show().delay(3000).fadeOut();
                    };
                    img.src = _URL.createObjectURL(file);
                }
            });

        </script>

        <script type="text/javascript">
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    "category": $('#filter_category').val(),
                    "subcategory": $('#filter_subcategory').val(),
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
        </script>

    </body>
</html>