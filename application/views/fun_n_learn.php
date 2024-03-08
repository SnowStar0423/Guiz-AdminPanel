<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create and Manage Fun 'N' Learn | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Create and Manage Fun 'N' Learn</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Fun 'N' Learn</h4>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <?php
                                                $sess_language_id = '0';
                                                $sess_category = '0';
                                                $sess_subcategory = '0';
                                                if ($this->session->userdata()) {
                                                    $type = $this->uri->segment(1);
                                                    $sess_data = $this->session->userdata("$type");
                                                    if (!empty($sess_data)) {
                                                        $sess_language_id = $sess_data['language_id'];
                                                        $sess_category = $sess_data['category'];
                                                        $sess_subcategory = $sess_data['subcategory'];
                                                    }
                                                }
                                                ?>
                                                <div class="form-group row">
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Language</label>
                                                            <select name="language_id" id="create_language_id" class="form-control" required>
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
                                                        <label class="control-label">Title</label>
                                                        <input name="title" type="text" class="form-control" placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Detail</label>
                                                        <textarea id="detail" name="detail" class="form-control"></textarea>
                                                        <input name="img" type="file" accept="image/*" id="upload" style="display: none" onchange="">
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
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Fun 'N' Learn <small>View / Update / Delete</small></h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>
                                                    <div class='col-md-3'>
                                                        <select id='filter_language' class='form-control' required>
                                                            <option value="">Select language</option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select id="filter_category" class="form-control" required>
                                                            <option value="">Select Main Category</option>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-3">
                                                        <select id="filter_category" class="form-control" required>
                                                            <option value="">Select Main Category</option>
                                                            <?php foreach ($category as $cat) { ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                                <div class='col-md-3'>
                                                    <select id='filter_subcategory' class='form-control' required>
                                                        <option value=''>Select Sub Category</option>
                                                    </select>
                                                </div>
                                                <div class='col-md-3'>
                                                    <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'>Filter Data</button>
                                                </div>
                                            </div>
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'fun_n_learn')) { ?>						
                                                    <button class="btn btn-danger" id="delete_multiple_fun_n_learn" title="Delete Selected Fun 'N' Learn"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div>
                                            <table aria-describedby="mydesc" class='table-striped' id='fun_n_learn_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/fun_n_learn' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"   
                                                   data-pagination-successively-size="3" data-maintain-selected="true" 
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "fun-n-learn-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="status" data-sortable="false">Status</th>
                                                        <th scope="col" data-field="category" data-sortable="true" data-visible='false'>Category</th>
                                                        <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'>Sub Category</th>
                                                        <?php if (is_language_mode_enabled()) { ?>
                                                            <th scope="col" data-field="language_id" data-sortable="true" data-visible="false">Language ID</th>
                                                            <th scope="col" data-field="language" data-sortable="true">Language</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                        <th scope="col" data-field="detail" data-sortable="false" data-visible='false'>Detail</th>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false">Total Question</th>
                                                        <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents">Operate</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Fun 'N' Learn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />
                                <div class="form-group row">
                                    <?php if (is_language_mode_enabled()) { ?>                                    
                                        <div class="col-md-6 col-sm-12">
                                            <label class="control-label">Language</label>
                                            <select id="language_id" name="language_id" class="form-control" required>
                                                <?php foreach ($language as $lang) { ?>
                                                    <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>                                    
                                        <div class="col-md-6 col-sm-12">
                                            <label class="control-label">Main Category</label>
                                            <select id="edit_category" name="category" class="form-control" required>
                                                <option value="">Select Main Category</option>
                                            </select>
                                        </div>                                                                  
                                    <?php } else { ?>
                                        <div class="col-md-12 col-sm-12">
                                            <label class="control-label">Main Category</label>
                                            <select id="edit_category" name="category" class="form-control" required>
                                                <option value="">Select Main Category</option>
                                                <?php foreach ($category as $cat) { ?>
                                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>     
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Sub Category</label>
                                        <select id="edit_subcategory" name="subcategory" class="form-control">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Title</label>
                                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter Title" required>
                                    </div>                                   
                                </div>

                                <div class="form-group row">                                                 
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Detail</label>
                                        <textarea id="edit_detail" name="detail" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="float-right">                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input name="btnupdate" type="submit" value="Save changes" class="<?= BUTTON_CLASS ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editStatusModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="update_id" id="update_id" value="" />

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Status</label>                                      
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-default">
                                                <input type="radio" name="status" value="1"> Active
                                            </label>
                                            <label class="btn btn-danger">
                                                <input type="radio" name="status" value="0"> Deactive
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="float-right">                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input name="btnupdatestatus" type="submit" value="Save changes" class="<?= BUTTON_CLASS ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php base_url() . include 'footer.php'; ?>



        <script type="text/javascript">
            $('#filter_btn').on('click', function (e) {
                $('#fun_n_learn_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_fun_n_learn').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_fun_n_learn';
                is_image = 0;
                table = $('#fun_n_learn_list');
                delete_button = $('#delete_multiple_fun_n_learn');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some fun-n-learn to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected fun-n-learn?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("fun-n-learn deleted successfully");
                                } else {
                                    alert("Could not delete fun-n-learn. Try again!");
                                }
                                delete_button.html('<i class="fa fa-trash"></i>');
                                table.bootstrapTable('refresh');
                            }
                        });
                    }
                }
            });
        </script>

        <script type="text/javascript">
            window.actionEvents = {
                'click .edit-data': function (e, value, row, index) {
                    $('#edit_id').val(row.id);
<?php if (is_language_mode_enabled()) { ?>
                        if (row.language_id == 0) {
                            $('#language_id').val(row.language_id);
                            $('#edit_category').html(category_options);
                            $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                        } else {
                            $('#language_id').val(row.language_id).trigger("change", [row.language_id, row.category, row.subcategory]);
                        }
<?php } else { ?>
                        $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
<?php } ?>
                    $('#title').val(row.title);
                    var detail = tinyMCE.get('edit_detail').setContent(row.detail);
                    $('#edit_detail').val(detail);
                    $('#edit_subcategory').val(row.subcategory);
                },
                'click .edit-status': function (e, value, row, index) {
                    $('#update_id').val(row.id);
                    $("input[name=status][value=1]").prop('checked', true);
                    if ($(row.status).text() == 'Deactive')
                        $("input[name=status][value=0]").prop('checked', true);
                }
            };
        </script>

        <script type="text/javascript">
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete fun-n-learn? All related questions will also be deleted')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    $.ajax({
                        url: base_url + 'delete_fun_n_learn',
                        type: "POST",
                        data: 'id=' + id,
                        success: function (result) {
                            if (result) {
                                $('#fun_n_learn_list').bootstrapTable('refresh');
                            } else {
                                var PERMISSION_ERROR_MSG = "<?= PERMISSION_ERROR_MSG; ?>";
                                ErrorMsg(PERMISSION_ERROR_MSG);
                            }
                        }
                    });
                }
            });
        </script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var type = 'fun-n-learn-subcategory';

            var sess_language_id = '<?= $sess_language_id ?>';
            var sess_category = '<?= $sess_category ?>';
            var sess_subcategory = '<?= $sess_subcategory ?>';
            $(document).ready(function () {
                if (sess_language_id != '0' || sess_category != '0') {
<?php if (is_language_mode_enabled()) { ?>
                        $('#create_language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
<?php } else { ?>
                        $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
<?php } ?>
                }
            });

            $('#create_language_id').on('change', function (e, row_language_id, row_category, row_subcategory) {
                var language_id = $('#create_language_id').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#category').html(result).trigger("change");
                        if (language_id == row_language_id && row_category != 0)
                            $('#category').val(row_category).trigger("change", [row_category, row_subcategory]);
                    }
                });
            });

            $('#language_id').on('change', function (e, row_language_id, row_category, row_subcategory) {
                var language_id = $('#language_id').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#edit_category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#edit_category').html(result);
                        if (language_id == row_language_id && row_category != 0)
                            $('#edit_category').val(row_category).trigger("change", [row_category, row_subcategory]);
                    }
                });
            });

            $('#filter_language').on('change', function (e) {
                var language_id = $('#filter_language').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#filter_category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#filter_category').html(result);
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
                        if (category_id == row_category && row_subcategroy != 0)
                            $('#subcategory').val(row_subcategroy);
                    }
                });
            });

            $('#edit_category').on('change', function (e, row_category, row_subcategroy) {
                var category_id = $('#edit_category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#edit_subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#edit_subcategory').html(result);
                        if (category_id == row_category && row_subcategroy != 0)
                            $('#edit_subcategory').val(row_subcategroy);
                    }
                });
            });

            $('#filter_category').on('change', function (e) {
                var category_id = $('#filter_category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#filter_subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#filter_subcategory').html(result);
                    }
                });
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

        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('focusin', function (e) {
                    if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
                        e.stopImmediatePropagation();
                    }
                });

                var base_url = "<?php echo base_url(); ?>";
                tinymce.init({
                    selector: '#detail',
                    height: 150,
                    menubar: true,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor textcolor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime table contextmenu paste code help wordcount'
                    ],
                    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image removeformat | help',
                    image_advtab: true,
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
                                    url: base_url + "fun_learn_upload_img",
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
                                    callback("images/fun-n-learn/" + filename);
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

        <script type="text/javascript">
            $(document).on('focusin', function (e) {
                if ($(event.target).closest(".mce-window").length) {
                    e.stopImmediatePropagation();
                }
            });
            var base_url = "<?php echo base_url(); ?>";
            tinymce.init({
                selector: '#edit_detail',
                height: 150,
                menubar: true,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image removeformat | help',
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
                                url: base_url + "fun_learn_upload_img",
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
                                callback("images/fun-n-learn/" + filename);
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
        </script>

    </body>
</html>