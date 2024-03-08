<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Send Notifications | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Send Notifications to Users <small>To all or selected</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="card-body">
                                                    <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                        <textarea id="selected_list" name="selected_list" style='display:none'></textarea>
                                                        <div class="form-group">
                                                            <label class="control-label">Select Users</label>
                                                            <select name='users' id='users' class='form-control' >
                                                                <option value='all'>All</option>
                                                                <option value='selected'>Selected only</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Type</label>
                                                            <select name="type" id="type" class="form-control" required>
                                                                <option value="default">Default</option>
                                                                <option value="main-category">Quiz Zone Category</option>
                                                                <option value="fun-n-learn-category">Fun 'N' Learn Category</option>
                                                                <option value="guess-the-word-category">Guess The Word Category</option>
                                                                <option value="audio-question-category">Audio Questions Category</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <input type="text" name="title" required class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Message</label>
                                                            <textarea id="message" name="message" required class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="include_image" id="include_image"  type="checkbox" > Include image
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="file" name="file" id="file" accept="image/*" style='display:none;' class="form-control"> 
                                                        </div>

                                                        <div class="form-group row float-right">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="submit" name="btnadd" class="<?= BUTTON_CLASS ?> btn-block" value="Submit"/>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="card-body">
                                                    <button type='button' id='get_selections' class='<?= BUTTON_CLASS ?>'>Get Selected Users</button>
                                                    <div id="toolbar">
                                                        <select name="filter_status" id="filter_status" class="form-control">
                                                            <option value="">All</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">De-active</option>
                                                        </select>
                                                    </div>
                                                    <table aria-describedby="mydesc" class='table-striped' id='users_list' 
                                                           data-toggle="table" data-url="<?= base_url() . 'Table/users' ?>"
                                                           data-click-to-select="true" data-side-pagination="server" 
                                                           data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" 
                                                           data-search="true" data-toolbar="#toolbar" 
                                                           data-show-columns="true" data-show-refresh="true" 
                                                           data-fixed-columns="true" data-fixed-number="1" data-fixed-right-number="1"
                                                           data-trim-on-search="false" 
                                                           data-sort-name="id" data-sort-order="desc" 
                                                           data-pagination-successively-size="3"
                                                           data-mobile-responsive="true" data-maintain-selected="true" 
                                                           data-show-export="false" data-export-types='["txt","excel"]' 
                                                           data-export-options='{ "fileName": "user-list-<?= date('d-m-y') ?>" }'
                                                           data-query-params="queryParams_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" data-field="state" data-events="inputEvent" data-checkbox="true"></th>
                                                                <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                                <th scope="col" data-field="name" data-sortable="true">Name</th>
                                                                <th scope="col" data-field="email" data-sortable="true">Email</th>
                                                                <th scope="col" data-field="status" data-sortable="false">Status</th>
                                                            </tr>
                                                        </thead>
                                                    </table>  
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Notifications <small>View / Update / Delete</small></h4>
                                        </div>
                                        <div class="card-body">  
                                            <div id="toolbar1">
                                                <?php if (has_permissions('delete', 'send_notification')) { ?>
                                                    <button class="btn btn-danger" id="delete_multiple_notifications" title="Delete Selected Notifications"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div> 
                                            <table aria-describedby="mydesc" class='table-striped' id='notification_list' 
                                                   data-toggle="table" 
                                                   data-url="<?= base_url() . 'Table/notification' ?>"
                                                   data-click-to-select="true" 
                                                   data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar1" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" 
                                                   data-sort-name="id" data-sort-order="desc" 
                                                   data-mobile-responsive="true" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "notification-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                        <th scope="col" data-field="message" data-sortable="true">Message</th>
                                                        <th scope="col" data-field="image" data-sortable="false">Image</th>
                                                        <th scope="col" data-field="users" data-sortable="true" data-visible="false" >Users</th>
                                                        <th scope="col" data-field="type" data-sortable="true">Type</th>
                                                        <th scope="col" data-field="type_id" data-sortable="true">Main Category ID</th>
                                                        <th scope="col" data-field="date_sent" data-sortable="true">Date Sent</th>
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


        <?php base_url() . include 'footer.php'; ?>

        <!-- jQuery -->


        <script type="text/javascript">
            function queryParams_1(p) {
                return {
                    "status": $('#filter_status').val(),
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
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
            $table = $('#users_list');
            var checkedID= [];
            window.inputEvent = {
                    'change :checkbox': function (e, value, row, index) {
                        row.state = $(e.target).prop('checked')
                        if($(e.target).is(":checked")){
                            checkedID.push(row.fcm_id);
                        }else{
                            checkedID = checkedID.filter(function(data){
                                return data !== row.fcm_id;
                            });
                        }
                    }
                }
            $(function () {
                $('#get_selections').click(function () {
                    selected = $table.bootstrapTable('getSelections');
                    var arr = Object.values(selected);
                    var i;
                    var final_selection = [];
                    for (i = 0; i < arr.length; ++i) {
                        final_selection.push(arr[i]['fcm_id']);
                    }
                    let mArray = [...final_selection, ...checkedID];
                    let mergedArr = [...new Set(mArray)]
                    $('textarea#selected_list').val(final_selection);
                });
                
                
                $('#users_list').on('load-success.bs.table', function (e,data,status) {
                    $.each(checkedID,function(element,ID){
                        let row = data.rows.find(function(row){
                            return ID==row.fcm_id;
                        });
                        let index = data.rows.indexOf(row);
                        if(index > -1){
                            row.state = true;
                              $('#users_list').bootstrapTable('updateRow', {
                                index: index,
                                row: row
                            })
                        }
                    });
                })
            });
        </script>

        <script type="text/javascript">
            $('#delete_multiple_notifications').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_notifications';
                is_image = 1;
                table = $('#notification_list');
                delete_button = $('#delete_multiple_notifications');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some languages to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected notifications?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("Languages deleted successfully");
                                } else {
                                    alert("Could not delete languages. Try again!");
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
            };
        </script>

        <script type="text/javascript">            
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete notification')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: base_url + 'delete_notification',
                        type: "POST",
                        data: 'id=' + id + '&image=' + image,
                        success: function (result) {
                            if (result) {
                                $('#notification_list').bootstrapTable('refresh');
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
            $("#filter_status").change(function () {
                $('#users_list').bootstrapTable('refresh');
            });
            $("#include_image").change(function () {
                if (this.checked) {
                    $('#file').show('fast');
                } else {
                    $('#file').val('');
                    $('#file').hide('fast');
                }
            });
        </script>

    </body>
</html>