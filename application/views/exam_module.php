<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create and Manage Exam Module | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Create and Manage Exam Module</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Exam Module</h4>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
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
                                                            <label class="control-label">Title</label>
                                                            <input name="title" type="text" class="form-control" placeholder="Enter Title" required>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Date</label>
                                                            <input type="date" name="date" class="form-control" required/>
                                                        </div> 
                                                    <?php } else { ?>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Title</label>
                                                            <input name="title" type="text" class="form-control" placeholder="Enter Title" required>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Date</label>
                                                            <input type="date" name="date" class="form-control" required/>
                                                        </div> 
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">                                                   
                                                    <div class="col-md-4 col-sm-12">
                                                        <label class="control-label">Exam Key</label>
                                                        <input type="number" name="exam_key" min="1000" max="9999" class="form-control" required/>
                                                        <div class="text-small text-danger">(Minimum 1000 and Maxmimum 9999)</div>
                                                    </div> 
                                                    <div class="col-md-4 col-sm-12">
                                                        <label class="control-label">Duration <small class="text-danger">(in minutes)</small></label>
                                                        <input type="number" name="duration" min="1" max="180" class="form-control" required/>
                                                        <div class="text-small text-danger">(Minimum 1 and Maxmimum 180)</div>
                                                    </div> 
                                                    <div class="col-md-4 col-sm-12">
                                                        <label class="control-label">Can rechange anwser while in exam</label><br/>
                                                        <div id="status" class="btn-group">
                                                            <label class="btn btn-success">
                                                                <input type="radio" name="answer_again" value="1"> Yes
                                                            </label>
                                                            <label class="btn btn-danger">
                                                                <input type="radio" name="answer_again" value="0" checked> No
                                                            </label>
                                                        </div>
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
                                            <h4>Exam Module <small>View / Update / Delete</small></h4>
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
                                                    <div class='col-md-3'>
                                                        <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'>Filter Data</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'exam_module')) { ?>						
                                                    <button class="btn btn-danger" id="delete_multiple_exam_module" title="Delete Selected Exam Module"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div>
                                            <table aria-describedby="mydesc" class='table-striped' id='exam_module_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/exam_module' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"   
                                                   data-pagination-successively-size="3" data-maintain-selected="true" 
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "exam-module-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="status" data-sortable="false">Status</th>
                                                        <?php if (is_language_mode_enabled()) { ?>
                                                            <th scope="col" data-field="language_id" data-sortable="true" data-visible="false">Language ID</th>
                                                            <th scope="col" data-field="language" data-sortable="true">Language</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                        <th scope="col" data-field="date" data-sortable="false">Date</th>
                                                        <th scope="col" data-field="exam_key" data-sortable="false">Exam Key</th>
                                                        <th scope="col" data-field="duration" data-sortable="false">Duration</th>
                                                        <th scope="col" data-field="answer_again" data-sortable="false">Is Exam Again</th>
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
                        <h5 class="modal-title">Edit Exam Module</h5>
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
                                        <div class="col-md-12 col-sm-12">
                                            <label class="control-label">Language</label>
                                            <select id="language_id" name="language_id" class="form-control" required>
                                                <?php foreach ($language as $lang) { ?>
                                                    <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>                                    

                                    <?php } ?>
                                </div>  
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Title</label>
                                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter Title" required>
                                    </div>                                   
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Date</label>
                                        <input type="date" id="date" name="date" class="form-control" required/>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Exam Key</label>
                                        <input type="text" id="exam_key" name="exam_key" class="form-control" required/>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Duration <small class="text-danger">(in minutes)</small></label>
                                        <input type="number" id="duration" name="duration" min="0" class="form-control" required/>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Is Exam again</label><br/>
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-success">
                                                <input type="radio" name="edit_answer_again" value="1"> Yes
                                            </label>
                                            <label class="btn btn-danger">
                                                <input type="radio" name="edit_answer_again" value="0" checked> No
                                            </label>
                                        </div>
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
                $('#exam_module_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_exam_module').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_exam_module';
                is_image = 0;
                table = $('#exam_module_list');
                delete_button = $('#delete_multiple_exam_module');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some exam module to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected exam module?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("exam-module deleted successfully");
                                } else {
                                    alert("Could not delete exam module. Try again!");
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
                    <?php if (is_language_mode_enabled()) { ?>
                        $('#language_id').val(row.language_id);
                    <?php } ?>
                    $('#edit_id').val(row.id);
                    $('#title').val(row.title);
                    $('#date').val(row.date);//                  
                    $('#exam_key').val(row.exam_key);
                    $('#duration').val(row.duration);
                    $("input[name=edit_answer_again][value=1]").prop('checked', true);
                    if ($(row.answer_again).text() == 'No')
                        $("input[name=edit_answer_again][value=0]").prop('checked', true);

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
                if (confirm('Are you sure? Want to delete exam module? All related questions will also be deleted')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    $.ajax({
                        url: base_url + 'delete_exam_module',
                        type: "POST",
                        data: 'id=' + id,
                        success: function (result) {
                            if (result) {
                                $('#exam_module_list').bootstrapTable('refresh');
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
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
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