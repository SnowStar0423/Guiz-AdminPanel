<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Languages for Web App | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Upload Languages for Web App</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add Languages</h4>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required/>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Language Name</label> <small class="text-danger">*</small>
                                                        <input name="language_name" type="text" class="form-control" placeholder="Enter Language Name" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">File</label>
                                                        <input id="file" name="file" type="file" accept="application/json" class="form-control" required>
                                                        <small class="text-danger">File type supported (json)</small>
                                                        <div><p style="display: none" id="file_error_msg" class="alert alert-danger"></p></div>
                                                    </div> 
                                                    <div class="col-md-6 col-sm-12">
                                                        <a class="btn btn-primary mt-4" href='<?= base_url();?>assets/en.json' target="_blank" download> <em class='fas fa-download'></em> Download Sample File Here</a>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
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
                                            <h4>List Langauges <small>View / Update / Delete</small></h4>
                                        </div>

                                        <div class="card-body">
                                            <!-- <div id="toolbar">
                                                <?php if (has_permissions('delete', 'categories')) { ?>						
                                                    <button class="btn btn-danger" id="delete_multiple_categories" title="Delete Selected Categories"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div> -->
                                            <table aria-describedby="mydesc" class='table-striped' id='upload_languages_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/upload_langauge' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="asc"    
                                                   data-pagination-successively-size="3" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "category-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="language_name" data-sortable="false">Language Name</th>
                                                        <th scope="col" data-field="file" data-sortable="false">File</th>
                                                        <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents" data-force-hide="true">Operate</th>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Main Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />
                                <input type="hidden" name='file_url' id="file_url" value="" />
                                <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required/>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Language Name</label>
                                        <input id="update_name" name="update_name" type="text" class="form-control" required placeholder="Enter Category Name">
                                    </div>                                   
                                </div>

                                <div class="form-group row">                                                 
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">File <small>( Leave it blank for no change )</small></label>
                                        <input id="update_file" name="update_file" type="file" accept="application/json" class="form-control">
                                        <small class="text-danger">File supported (json)</small>
                                        <div style="display: none" id="up_file_error_msg" class="alert alert-danger"></div>
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


        <?php base_url() . include 'footer.php'; ?>

        <script type="text/javascript">
            window.actionEvents = {
                'click .edit-data': function (e, value, row, index) {
                    console.log(row)
                    $('#edit_id').val(row.id);
                    $('#file_url').val(row.file_url);
                    $('#update_name').val(row.language_name);
                }
            };
        </script>

        <script type="text/javascript">
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete question?')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    file = $(this).data("file");
                    $.ajax({
                        url: base_url + 'delete-upload-languages',
                        type: "POST",
                        data: 'id=' + id + '&file_url=' + file,
                        success: function (result) {
                            if (result) {
                                $('#upload_languages_list').bootstrapTable('refresh');
                            } else {
                                var PERMISSION_ERROR_MSG = "<?= PERMISSION_ERROR_MSG; ?>";
                                ErrorMsg(PERMISSION_ERROR_MSG);
                            }
                        }
                    });
                }
            });
        </script>
        </script>

        <script type="text/javascript">
            function queryParams(p) {
                return {
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
        </script>

        <script type="text/javascript">
            var _URL = window.URL || window.webkitURL;

            $("#file").change(function (e) {
                var file, img;

                if ((file = this.files[0])) {
                    if (file.type !== 'application/json') {
                        $('#file').val('');
                        $('#file_error_msg').html('<?= INVALID_FILE_TYPE; ?>');
                        $('#file_error_msg').show().delay(3000).fadeOut();
                    }
                }
            });

            $("#update_file").change(function (e) {
                var file, img;

                if ((file = this.files[0])) {
                    if (file.type !== 'application/json') {
                        $('#update_file').val('');
                        $('#up_file_error_msg').html('<?= INVALID_FILE_TYPE; ?>');
                        $('#up_file_error_msg').show().delay(3000).fadeOut();
                    }
                }
            });
        </script>

    </body>
</html>