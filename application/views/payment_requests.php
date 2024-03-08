<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Payment Requests | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Payment Requests <small> User's Payment Requests Details</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">                           
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body"> 
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="multiple_ids" id="multiple_ids"/>
                                                <div class="form-group row justify-content-center">
                                                    <div class="col-md-2 col-sm-12 text-right">
                                                        <a href="javascript:void(0)" class="btn btn-warning" id="get_multiple_data_btn">Get Selected Requests</a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <select id="multiple_status" name='status' class='form-control' required>
                                                            <option value=''>Select Status</option>
                                                            <option value='0'>Pending</option>
                                                            <option value='1'>Completed</option>
                                                        </select>
                                                    </div> 
                                                    <div class="col-md-3 col-sm-12">
                                                        <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>"/>
                                                    </div>
                                                </div>
                                            </form>
                                        <hr>
                                        
                                        <input type="hidden" id="user_id" name="user_id" value="<?= $this->uri->segment(2) ?>"/>
                                            <table aria-describedby="mydesc" class='table-striped' id='requests_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/payment_requests_list' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true"  data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"      
                                                   data-pagination-successively-size="3" data-maintain-selected="true" 
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "leaderboard-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="name" data-sortable="true">Name</th>
                                                        <th scope="col" data-field="uid" data-sortable="true" data-visible="false">UID</th>
                                                        <th scope="col" data-field="payment_type" data-sortable="true">Payment Type</th>
                                                        <th scope="col" data-field="payment_address" data-sortable="true">Payment Address</th>
                                                        <th scope="col" data-field="payment_amount" data-sortable="true">Payment Amount</th>
                                                        <th scope="col" data-field="coin_used" data-sortable="true">Coin Used</th>
                                                        <th scope="col" data-field="details" data-sortable="false">Details</th>
                                                        <th scope="col" data-field="status" data-sortable="false">Status</th>
                                                        <th scope="col" data-field="date" data-sortable="true">Date</th>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />     
                                <input type='hidden' name="edit_user_id" id="edit_user_id" value="" />  
                                <input type="hidden" name="uid" id="uid"/> 
                                <input type='hidden' name="coin_used" id="coin_used" value=''/>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Details</label>
                                        <textarea id="details" name="details" class="form-control" required></textarea>
                                    </div>
                                </div>                         

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Status</label><br/>                                        
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-warning">
                                                <input type="radio" name="status" value="0"> Pending
                                            </label>
                                            <label class="btn btn-success">
                                                <input type="radio" name="status" value="1"> Completed
                                            </label>                                            
                                            <label class="btn btn-danger">
                                                <input type="radio" name="status" value="2"> Invalid Details
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

        <?php base_url() . include 'footer.php'; ?>

        <script type="text/javascript">
              $('#get_multiple_data_btn').on('click', function (e) {
                table = $('#requests_list');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);     
                $('#multiple_ids').val(ids);           
            });
        </script>

        <script type="text/javascript">
            window.actionEvents = {
                'click .edit-data': function (e, value, row, index) {
                    $('#edit_id').val(row.id);
                    $("input[name=status][value="+row.status1+"]").prop('checked', true);
                    $("#details").val(row.details);
                    $('#coin_used').val(row.coin_used);
                    $('#edit_user_id').val(row.user_id);
                    $('#uid').val(row.uid);
                }
            };
        </script>
        <script type="text/javascript">
            function queryParams(p) {
                return {
                    'user_id':$('#user_id').val(),
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