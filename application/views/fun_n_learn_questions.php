<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Questions for Fun 'N' Learn | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Create and Manage Questions for Fun 'N' Learn</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Questions </h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" id="fun_n_learn_id" name="fun_n_learn_id" value="<?= $this->uri->segment(2) ?>"/>

                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Question</label>
                                                        <textarea name="question" class="form-control" required></textarea>
                                                    </div>                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">  
                                                        <label class="control-label">Question Type</label>
                                                        <div>
                                                            <div class="form-check-inline bg-light p-2">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="question_type" value="1" checked required>Options
                                                                </label>
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="question_type" value="2">True / False
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>                                                     
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option A</label>                                                
                                                        <input class="form-control" type="text" id="a" name="a" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option B</label>
                                                        <input class="form-control" type="text" id="b" name="b" required>
                                                    </div>
                                                </div>
                                                <div id="tf">
                                                    <div class="form-group row">                                                   
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option C</label>
                                                            <input class="form-control" type="text" id="c" name="c" required>
                                                        </div>                                                    
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option D</label>
                                                            <input class="form-control" type="text" id="d" name="d" required>
                                                        </div>
                                                    </div>
                                                    <?php if (is_option_e_mode_enabled()) { ?>
                                                        <div class="form-group row">                                                        
                                                            <div class="col-md-6 col-sm-12">
                                                                <label class="control-label">Option E</label>
                                                                <input class="form-control" type="text" id="e" name="e" required>
                                                            </div> 
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Answer</label>                                                  
                                                        <select name='answer' id='answer' class='form-control' required>
                                                            <option value=''>Select Right Answer</option>
                                                            <option value='a'>A</option>
                                                            <option value='b'>B</option>
                                                            <option class='ntf' value='c'>C</option>
                                                            <option class='ntf' value='d'>D</option>
                                                            <?php if (is_option_e_mode_enabled()) { ?>
                                                                <option class='ntf' value='e'>E</option>
                                                            <?php } ?>
                                                        </select>
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
                                            <h4>Questions for Fun 'N' Learn <small>View / Update / Delete</small></h4>
                                        </div>

                                        <div class="card-body">
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'fun_n_learn')) { ?>
                                                    <button class="btn btn-danger"  id="delete_multiple_questions" title="Delete Selected Questions"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div> 
                                            <table aria-describedby="mydesc" class='table-striped' id='question_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/fun_n_learn_question' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"   
                                                   data-pagination-successively-size="3" data-maintain-selected="true" 
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "question-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="fun_n_learn_id" data-sortable="true" data-visible='false'>Fun N Learn ID</th>
                                                        <th scope="col" data-field="question" data-sortable="true">Question</th>
                                                        <th scope="col" data-field="question_type" data-sortable="true" data-visible='false' data-formatter="questionTypeFormatter">Question Type</th>
                                                        <th scope="col" data-field="optiona" data-sortable="true">Option A</th>
                                                        <th scope="col" data-field="optionb" data-sortable="true">Option B</th>
                                                        <th scope="col" data-field="optionc" data-sortable="true">Option C</th>
                                                        <th scope="col" data-field="optiond" data-sortable="true">Option D</th>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <th scope="col" data-field="optione" data-sortable="true">Option E</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="answer" data-sortable="true" data-visible='false'>Answer</th>
                                                        <th scope="col" data-field="note" data-sortable="true" data-visible='false'>Note</th>
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
                        <h5 class="modal-title">Edit Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />
                                <input type='hidden' name="edit_question_type" value="" />

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Question</label>
                                        <textarea id="edit_question" name="question" class="form-control" required></textarea>
                                    </div>                                                   
                                </div>
                                <!-- Removed Question Type Change in edit -->
                                <!-- <div class="form-group row">
                                    <div class="col-md-6 col-sm-12">  
                                        <label class="control-label">Question Type</label>
                                        <div>
                                            <div class="form-check-inline bg-light p-2">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="edit_question_type" value="1" checked required>Options
                                                </label>

                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="edit_question_type" value="2">True / False
                                                </label>
                                            </div>
                                        </div>                                                             
                                    </div>                                   
                                </div> -->
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Option A</label>                                                
                                        <input class="form-control" type="text" id="edit_a" name="a" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Option B</label>
                                        <input class="form-control" type="text" id="edit_b" name="b" required>
                                    </div>
                                </div>
                                <div id="edit_tf">
                                    <div class="form-group row">                                                   
                                        <div class="col-md-6 col-sm-6">
                                            <label class="control-label">Option C</label>
                                            <input class="form-control" type="text" id="edit_c" name="c" required>
                                        </div>                                                    
                                        <div class="col-md-6 col-sm-6">
                                            <label class="control-label">Option D</label>
                                            <input class="form-control" type="text" id="edit_d" name="d" required>
                                        </div>
                                    </div>
                                    <?php if (is_option_e_mode_enabled()) { ?>
                                        <div class="form-group row">                                                        
                                            <div class="col-md-6 col-sm-12">
                                                <label class="control-label">Option E</label>
                                                <input class="form-control" type="text" id="edit_e" name="e" required>
                                            </div> 
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Answer</label>                                                  
                                        <select name='answer' id='edit_answer' class='form-control' required>
                                            <option value=''>Select Right Answer</option>
                                            <option value='a'>A</option>
                                            <option value='b'>B</option>
                                            <option class='edit_ntf' value='c'>C</option>
                                            <option class='edit_ntf' value='d'>D</option>
                                            <?php if (is_option_e_mode_enabled()) { ?>
                                                <option class='edit_ntf' value='e'>E</option>
                                            <?php } ?>
                                        </select>
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
                    $('#edit_id').val(row.id);
                    $('#edit_question').val(row.question);
                    var question_type = row.question_type;
                    if (question_type == "2") {
                        $("input[name=edit_question_type]").val(2);
                        $('#edit_tf').hide('fast');
                        $('#edit_a').val(row.optiona);
                        $('#edit_b').val(row.optionb);
                        $('.edit_ntf').hide('fast');
                        $('#edit_c').removeAttr('required');
                        $('#edit_d').removeAttr('required');
                        $('#edit_e').removeAttr('required');
                    } else {
                        $("input[name=edit_question_type]").val(1);
                        $('#edit_a').val(row.optiona);
                        $('#edit_b').val(row.optionb);
                        $('#edit_c').val(row.optionc);
                        $('#edit_d').val(row.optiond);
<?php if (is_option_e_mode_enabled()) { ?>
                            $('#edit_e').val(row.optione);
<?php } ?>
                        $('#edit_tf').show('fast');
                        $('.edit_ntf').show('fast');
                        $('#edit_c').attr("required", "required");
                        $('#edit_d').attr("required", "required");
                        $('#edit_e').attr("required", "required");
                    }

                    $('#edit_a').val(row.optiona);
                    $('#edit_b').val(row.optionb);
                    $('#edit_c').val(row.optionc);
                    $('#edit_d').val(row.optiond);
<?php if (is_option_e_mode_enabled()) { ?>
                        $('#edit_e').val(row.optione);
<?php } ?>
                    $('#edit_answer').val(row.answer.toLowerCase());

                }
            };
        </script>

        <script type="text/javascript">
            $('#filter_btn').on('click', function (e) {
                $('#question_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_questions').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_fun_n_learn_question';
                is_image = 0;
                table = $('#question_list');
                delete_button = $('#delete_multiple_questions');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some questions to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected questions?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("Questions deleted successfully");
                                } else {
                                    alert("Could not delete Questions. Try again!");
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
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete question?')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    $.ajax({
                        url: base_url + 'delete_fun_n_learn_questions',
                        type: "POST",
                        data: 'id=' + id,
                        success: function (result) {
                            if (result) {
                                $('#question_list').bootstrapTable('refresh');
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
                    "fun_n_learn_id": $('#fun_n_learn_id').val(),
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
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
                    $('#answer').val('');
                } else {
                    $('#a').val('');
                    $('#b').val('');
                    $('#tf').show('fast');
                    $('.ntf').show('fast');
                    $('#c').attr("required", "required");
                    $('#d').attr("required", "required");
                    $('#e').attr("required", "required");
                    $('#answer').val('');
                }
            });
            $('input[name="edit_question_type"]').on("click", function (e) {
                var edit_question_type = $(this).val();
                if (edit_question_type == "2") {
                    $('#edit_tf').hide('fast');
                    $('#edit_a').val("<?= is_settings('true_value') ?>");
                    $('#edit_b').val("<?= is_settings('false_value') ?>");
                    $('#edit_c').removeAttr('required');
                    $('#edit_d').removeAttr('required');
                    $('#edit_e').removeAttr('required');
                    $('.edit_ntf').hide('fast');
                } else {
                    $('#edit_tf').show('fast');
                    $('.edit_ntf').show('fast');
                    $('#edit_c').attr("required", "required");
                    $('#edit_d').attr("required", "required");
                    $('#edit_e').attr("required", "required");
                }
            });
        </script>

    </body>
</html>