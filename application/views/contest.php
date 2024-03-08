<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create and Manage Contest | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Create and Manage Contest</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Contest</h4>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Name</label>
                                                        <input name="name" type="text" class="form-control" placeholder="Enter Contest Name" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Image</label>
                                                        <input id="file" name="file" type="file" accept="image/*" required class="form-control">
                                                        <small class="text-danger">Image type supported (png, jpg and jpeg)</small>
                                                        <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                    </div> 
                                                </div>   
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Contest Start & End Date</label>
                                                        <input type="text" id="date" name="date" required class="form-control">
                                                        <input type="hidden" id="start_date" name="start_date" required="" value="">
                                                        <input type="hidden" id="end_date" name="end_date" required="" value="">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Entry Fee Points</label>
                                                        <input type="number" id="entry" name="entry" required class="form-control" placeholder="These points will be deducted from users wallet" min='0'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="top_users">Distribute Prize to Top Users</label>
                                                        <input type="number" id="top_users" name="top_users" required class="form-control" placeholder="For Instance Top 10 users will be getting prize" min='1'>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="description">Description</label>
                                                        <textarea id="description" name="description" required class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="top_winner">

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
                                            <h4>Contests <small>View / Update / Delete</small></h4>
                                        </div>

                                        <div class="card-body">                                         
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'manage_contest')) { ?>
                                                    <button class="btn btn-danger"  id="delete_multiple_contests" title="Delete Selected Contests"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div> 
                                            <table aria-describedby="mydesc" class='table-striped' id='contest_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/contest' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"  
                                                   data-pagination-successively-size="3" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]' 
                                                   data-export-options='{ "fileName": "contest-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="status" data-sortable="false">Status</th>
                                                        <th scope="col" data-field="name" data-sortable="true">Name</th>
                                                        <th scope="col" data-field="start_date" data-sortable="true">Start Date</th>
                                                        <th scope="col" data-field="end_date" data-sortable="true">End Date</th>
                                                        <th scope="col" data-field="image" data-sortable="false">Image</th>
                                                        <th scope="col" data-field="description" data-sortable="false" data-visible="false">Description</th>
                                                        <th scope="col" data-field="entry" data-sortable="true">Entry</th>
                                                        <th scope="col" data-field="top_users" data-sortable="true">Top Users</th>
                                                        <th scope="col" data-field="participants" data-sortable="true">Participants</th>
                                                        <th scope="col" data-field="total_question" data-sortable="true">Questions</th>
                                                        <th scope="col" data-field="prize_status" data-sortable="false">Prize Status</th>
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
                        <h5 class="modal-title">Edit Contest</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />
                                <input type="hidden" name='image_url' id="image_url" value="" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="update_name" placeholder="Category Name" class='form-control' required>
                                </div>
                                <div class="form-group">
                                    <label for="update_date">Contest Start & End Date</label>
                                    <input type="text" id="update_date" name="date" required class="form-control">
                                    <input type='hidden' name="start_date" id="update_start_date" value=''/>
                                    <input type='hidden' name="end_date" id="update_end_date" value=''/>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="update_description" placeholder="Short Description" class='form-control' required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image <small>( Leave it blank for no change )</small></label>
                                    <input type="file" name="update_file" id="update_file" class="form-control" accept="image/*" aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label for="entry">Entry Fee Points</label>
                                    <input type="number" id="update_entry" name="entry" required class="form-control" placeholder="These points will be deducted from users wallet" min='0'>
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
            $('#delete_multiple_contests').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_contest';
                is_image = 1;
                table = $('#contest_list');
                delete_button = $('#delete_multiple_contests');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some contest to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected contests?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("Contests deleted successfully");
                                } else {
                                    alert("Could not delete contest. Try again!");
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
                if (confirm('Are you sure? Want to delete Contest? All related questions & leaderboard details will also be deleted')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: base_url + 'delete_contest',
                        type: "POST",
                        data: 'id=' + id + '&image_url=' + image,
                        success: function (result) {
                            if (result) {
                                $('#contest_list').bootstrapTable('refresh');
                            } else {
                                var PERMISSION_ERROR_MSG = "<?= PERMISSION_ERROR_MSG; ?>";
                                ErrorMsg(PERMISSION_ERROR_MSG);
                            }
                        }
                    });
                }
            });
        </script>

        <script>
            window.actionEvents = {
                'click .edit-data': function (e, value, row, index) {
                    $('#edit_id').val(row.id);
                    $('#image_url').val(row.image_url);
                    $('#update_name').val(row.name);
                    $('#update_description').val(row.description);
                    $('#update_start_date').val(row.start_date);
                    $('#update_end_date').val(row.end_date);
                    $('#update_entry').val(row.entry);
                    $('#update_date').data('daterangepicker').setStartDate(row.start_date);
                    $('#update_date').data('daterangepicker').setEndDate(row.end_date);

                },
                'click .edit-status': function (e, value, row, index) {
                    $('#update_id').val(row.id);
                    $("input[name=status][value=1]").prop('checked', true);
                    if ($(row.status).text() == 'Deactive')
                        $("input[name=status][value=0]").prop('checked', true);
                }
            };
        </script>

        <script>
            $('#top_users').on('blur input', function () {
                var no_of = $(this).val();
                var myHtml = "";

                $('div#top_winner').empty();
                for (var i = 1; i <= no_of; i++) {
                    myHtml = "<div class='col-md-2 col-sm-4 col-xs-12'>";
                    myHtml += "<input name='points[]' type='number' placeholder='" + i + " winner Prize' min='0' required class='form-control'>";
                    myHtml += "<input name='winner[]' type='hidden' value=" + i + ">";
                    myHtml += "<div>";
                    for (var j = 6; j <= no_of; j++) {
                        if (i == j) {
                            myHtml += "<br/>";
                        }
                    }
                    $('div#top_winner').append(myHtml);
                }
            });
        </script>

        <script>
            $('#date, #update_date').daterangepicker({
                "showDropdowns": true,
                timePicker: true,
                alwaysShowCalendars: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Tommorow': [moment().add(1, 'days'), moment().add(1, 'days')],
                    'Coming 7 Days': [moment(), moment().add(6, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                },
                startDate: moment(),
                endDate: moment().add(6, 'days'),
                "locale": {
                    "format": "DD/MM/YYYY h:m:s A",
                    "separator": " - "
                }
            });
            $('#update_date').daterangepicker({
                "showDropdowns": true,
                alwaysShowCalendars: true,
                timePicker: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Tommorow': [moment().add(1, 'days'), moment().add(1, 'days')],
                    'Coming 7 Days': [moment(), moment().add(6, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                },
                "locale": {
                    "format": "YYYY/MM/DD h:m:s A",
                    "separator": " - "
                }
            });
            var drp = $('#date').data('daterangepicker');
            $('#start_date').val(drp.startDate.format('YYYY-MM-DD h:m:s A'));
            $('#end_date').val(drp.endDate.format('YYYY-MM-DD h:m:s A'));
        </script>
        <script>
            $('#date').on('apply.daterangepicker', function (ev, picker) {
                var drp = $('#date').data('daterangepicker');
                $('#start_date').val(drp.startDate.format('YYYY-MM-DD HH:mm:ss'));
                $('#end_date').val(drp.endDate.format('YYYY-MM-DD HH:mm:ss'));
            });
            $('#update_date').on('apply.daterangepicker', function (ev, picker) {
                var udrp = $('#update_date').data('daterangepicker');
                $('#update_start_date').val(udrp.startDate.format('YYYY-MM-DD HH:mm:ss' ));
                $('#update_end_date').val(udrp.endDate.format('YYYY-MM-DD HH:mm:ss'));
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
            $("#update_file").change(function (e) {
                var file, img;
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onerror = function () {
                        $('#update_file').val('');
                        $('#up_img_error_msg').html('<?= INVALID_IMAGE_TYPE; ?>');
                        $('#up_img_error_msg').show().delay(3000).fadeOut();
                    };
                    img.src = _URL.createObjectURL(file);
                }
            });
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
    </body>
</html>