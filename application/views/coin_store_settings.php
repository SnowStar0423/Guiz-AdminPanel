<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coins Store Settings | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>

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
                        <h1>Coins Store Settings</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="control-label">Title</label><small class="text-danger">*</small>
                                                    <input type="text" name="title" required class="form-control" placeholder="Title" value="<?= $this->session->flashdata('title'); ?>"/>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="control-label">Coins</label><small class="text-danger">*</small>
                                                    <input type="number" min="0" name="coins" required class="form-control" placeholder="Coins" value="<?= $this->session->flashdata('coins'); ?>"/>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="control-label">Product ID</label><small class="text-danger">*</small>
                                                    <input type="text" name="product_id" required class="form-control" placeholder="Product ID" value="<?= $this->session->flashdata('product_id'); ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="control-label">Description</label><small class="text-danger">*</small>
                                                    <textarea name="description" cols="50" rows="2" required class="form-control" placeholder="Description"><?= $this->session->flashdata('description'); ?></textarea>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="control-label">Image</label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger">Image type supported (png, jpg, jpeg and svg)</small>
                                                    <p style="display: none" id="img_error_msg" class="alert alert-danger"></p>
                                                </div> 
                                            </div>

                                            <div class="form-group row mt-4">
                                                <div class="col-sm-12">
                                                    <input type="submit" name="btnadd" value="Submit"
                                                        class="<?= BUTTON_CLASS ?>" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Coin Store <small>View / Update / Delete</small></h4>
                                        </div>

                                        <div class="card-body">
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'coin_store')) { ?>						
                                                    <button class="btn btn-danger" id="delete_multiple_coin_store" title="Delete Selected Coin Store Data"><em class='fa fa-trash'></em></button>
                                                <?php } ?>
                                            </div>
                                            <table aria-describedby="mydesc" class='table-striped' id='coin_store_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/coin_store' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true" 
                                                   data-fixed-columns="true" data-fixed-number="1" 
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"    
                                                   data-pagination-successively-size="3" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "category-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                        <th scope="col" data-field="coins" data-sortable="true">Coins</th>
                                                        <th scope="col" data-field="product_id" data-sortable="true">Product ID</th>
                                                        <th scope="col" data-field="status" data-sortable="true">Status</th>
                                                        <th scope="col" data-field="image" data-sortable="false">Image</th>
                                                        <th scope="col" data-field="description" data-sortable="true">Description</th>
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
                        <h5 class="modal-title">Edit Coin Store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" id="edit-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit-id" value="" />
                                <input type="hidden" name='image_url' id="image-url" value="" />
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Title</label>
                                        <input id="edit-title" name="title" type="text" class="form-control" required placeholder="Title">
                                    </div>                                   
                                </div>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Coins</label>
                                        <input id="edit-coins" name="coins" type="text" class="form-control" required placeholder="Coins">
                                    </div>                                   
                                </div>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Product ID</label>
                                        <input id="edit-product-id" name="product_id" type="text" class="form-control" required placeholder="Product ID">
                                    </div>                                   
                                </div>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Description</label>
                                        <textarea id="edit-description" name="description" class="form-control" required placeholder="Description"></textarea>
                                    </div>                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Image</label>
                                        <input id="update_file" name="edit_file" type="file" accept="image/*" class="form-control">
                                        <small class="text-danger">Image type supported (png, jpg, jpeg and svg)</small>
                                        <p style="display: none" id="up_img_error_msg" class="alert alert-danger"></p>
                                    </div> 
                                </div>  
                                <div class="mt-1 mb-3" style="display: none;" id="image-tag-div">
                                    <img src=''  height=50, width=50 id="edit-image-tag">
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

        <div class="modal fade" tabindex="-1" role="dialog" id="updateStatusModal">
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
                            <form method="post" id="update-status-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit-coin-store-id" value="" />

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Status</label><br/>                                   
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

</body>
<script type="text/javascript">
    $('#filter_btn').on('click', function (e) {
        $('#slider_list').bootstrapTable('refresh');
    });
    $('#delete_multiple_coin_store').on('click', function (e) {
        var base_url = "<?php echo base_url(); ?>";
        sec = 'tbl_coin_store';
        is_image = 1;
        table = $('#coin_store_list');
        delete_button = $('#delete_multiple_coin_store');
        selected = table.bootstrapTable('getSelections');
        ids = "";
        $.each(selected, function (i, e) {
            ids += e.id + ",";
        });
        ids = ids.slice(0, -1);
        if (ids == "") {
            alert("Please select some data to delete!");
        } else {
            if (confirm("Are you sure you want to delete all selected data?")) {
                $.ajax({
                    type: "POST",
                    url: base_url + 'delete_multiple',
                    data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                    beforeSend: function () {
                        delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                    },
                    success: function (result) {
                        if (result == 1) {
                            alert("Data deleted successfully");
                        } else {
                            alert("Could not delete data. Try again!");
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
            $('#edit-id').val(row.id);
            $('#image-url').val(row.image_url);
            $('#edit-title').val(row.title);
            $('#edit-coins').val(row.coins);
            $('#edit-product-id').val(row.product_id);
            if(row.image_url){
                $('#image-tag-div').show().find('#edit-image-tag').attr('src',row.image_url);
            }else{
                $('#image-tag-div').hide().find('#edit-image-tag').attr('src','');
            }
            $('#edit-description').val(row.description);
        },
        'click .status-update': function (e, value, row, index) {
            $('#edit-coin-store-id').val(row.id);
            if(row.status_db == 1){
                // $("input[name=status][value=0]").prop('checked', false);
                $("input[name=status][value=1]").prop('checked', true);
            }else{
                // $("input[name=status][value=1]").prop('checked', false);
                $("input[name=status][value=0]").prop('checked', true);
            }
        }

    };
</script>

<script type="text/javascript">
    $(document).on('click', '.delete-data', function () {
        if (confirm('Are you sure? Want to delete data?')) {
            var base_url = "<?php echo base_url(); ?>";
            id = $(this).data("id");
            image = $(this).data("image");
            $.ajax({
                url: base_url + 'delete-coin-store-data',
                type: "POST",
                data: 'id=' + id + '&image_url=' + image,
                success: function (result) {
                    if (result) {
                        $('#coin_store_list').bootstrapTable('refresh');
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
</html>