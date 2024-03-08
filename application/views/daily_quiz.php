<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daily Quiz | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

        <?php base_url() . include 'include.php'; ?>  
        
        <style>
            .test .cke_top,
            .test .cke_bottom{
                display: none;
            }
            .test .cke_chrome{
                border: none;
            }
        </style>
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
                            <h1>Create and Manage Daily Quiz </h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Daily Quiz <small>Create New Quiz</small></h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>                                                  
                                                    <div class="col-md-3">
                                                        <select id="filter_language" class="form-control" required>
                                                            <option value="">Select Language</option>
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
                                                            <?php foreach ($category as $cat) { 
                                                                if($cat->is_premium == 0){ ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } } ?> 
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
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="inner_heading"><strong>Select Questions for Daily Quiz</strong></h6>
                                                    <table aria-describedby="mydesc" class='table-striped' id='question_list' 
                                                           data-toggle="table" data-url="<?= base_url() . 'Table/question_without_premium' ?>"
                                                           data-click-to-select="true" data-side-pagination="server" 
                                                           data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" 
                                                           data-search="true" data-toolbar="#toolbar" 
                                                           data-show-columns="true" data-show-refresh="true"
                                                           data-trim-on-search="false" data-mobile-responsive="true"
                                                           data-sort-name="id" data-sort-order="desc"  
                                                           data-pagination-successively-size="3"
                                                           data-maintain-selected="true" data-export-types='["txt","excel"]' 
                                                           data-export-options='{ "fileName": "question-list-<?= date('d-m-y') ?>" }'
                                                           data-query-params="queryParams_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" data-field="state" data-checkbox="true"></th>
                                                                <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                                <th scope="col" data-field="category" data-sortable="true" data-visible='false'>Category</th>
                                                                <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'>Sub Category</th>
                                                                <?php if (is_language_mode_enabled()) { ?>
                                                                    <th scope="col" data-field="language_id" data-sortable="true" data-visible='false'>Language ID</th>
                                                                <?php } ?>
                                                                <th scope="col" data-class="test" data-field="question" data-sortable="true">Question</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="control-label" for="add_question">Add</label>
                                                    <a href="#" id="add_question" class="<?= BUTTON_CLASS ?> form-control"><em class="fa fa-chevron-circle-right"></em></a>
                                                </div>
                                                <div class='col-md-5'>
                                                    <h6 class="inner_heading"><strong>Selected Questions</strong></h6>

                                                    <form id="daily_quiz_form" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                        <input type="hidden" id="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                        <div class="form-group">
                                                            <?php if (is_language_mode_enabled()) { ?>
                                                                <label class="control-label">Language</label><br>
                                                                <div class='row'>
                                                                    <div class="col-md-12">
                                                                        <select id="language_id" name="language_id" required class="form-control">
                                                                            <?php foreach ($language as $lang) { ?>
                                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                <input type = "hidden" name="language_id" id="language_id" value="0" required/> 
                                                            <?php } ?>
                                                            <label class="control-label" for="add_question">Title</label>

                                                            <input type="date" id="daily_quiz_date" name="daily_quiz_date" value="<?= date('Y-m-d') ?>" class='form-control'/>

                                                            <div id='questions_block' class="form-group mt-4" style="overflow-y:scroll;height:500px;">
                                                                <input type = "hidden" name="question_ids" id="question_ids" required readonly/> 
                                                                <ol id="sortable-row">
                                                                </ol>
                                                            </div>
                                                            <div class="ln_solid"></div>
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input type="submit" id="submit_btn" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script>
            $(document).ready(function () {
                createCkeditor();
                var language_id = $('#language_id').val();
                load_sortable_ui('<?= date('Y-m-d') ?>', language_id);

		$('#question_list').on('post-body.bs.table', function() {
                    createCkeditor();
                })
            });

            $('#daily_quiz_date, #language_id').on('change', function (e) {
                e.preventDefault();
                date = $('#daily_quiz_date').val();
                var language_id = $('#language_id').val();
                load_sortable_ui(date, language_id);
            });

            function load_sortable_ui(date, language_id) {
                var selected_date = date;
                var base_url = "<?php echo base_url(); ?>";
                $.ajax({
                    type: "POST",
                    url: base_url + 'get_daily_quiz',
                    data: 'selected_date=' + selected_date + '&language_id=' + language_id,
                    beforeSend: function () {
                        $('#questions_block').block({message: '<h4>Please wait...</h4>'});
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        $('#sortable-row').html(obj.questions_list);
                        if (obj.language_id != '') {
                            $('#language_id').val(obj.language_id);
                        }
                        $('#questions_block').unblock();
                    }                    
                });
                createCkeditor();
            }
        </script>
        <script>
            $('#daily_quiz_form').on('submit', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                e.preventDefault();
                var selectedLanguage = new Array();
                $('ol#sortable-row li').each(function () {
                    selectedLanguage.push($(this).attr("id"));
                });
                $("#question_ids").val(selectedLanguage);

                if ($("#question_ids").val() == '') {
                    alert('Please Select some questions and proceed ');
                    return false;
                }
                var language_id = $('#language_id').val();
                var daily_quiz_date = $('#daily_quiz_date').val();
                var question_ids = $('#question_ids').val();
                $.ajax({
                    type: "POST",
                    url: base_url + 'add_daily_quiz',
                    data: 'language_id=' + language_id + '&daily_quiz_date=' + daily_quiz_date + '&question_ids=' + question_ids,
                    beforeSend: function () {
                        $('#submit_btn').html('Please wait..');
                    },
                    success: function (result) {
                        window.location = '';
                    }
                });

            });
        </script>
        <script>
            $(function () {
                $("#sortable-row").sortable({
                    placeholder: "ui-state-highlight"
                });
            });
            var $table = $('#question_list');
            $('#add_question').on('click', function (e) {                
                e.preventDefault();
                var questions = $table.bootstrapTable('getSelections');
                li = '';
                $.each(questions, function (i, v) {
                    li = $("<li id='" + questions[i].id + "' class='ui-state-default test'/>").html("<a class='btn btn-danger btn-sm remove-row float-right'>x</a>").append(questions[i].id + ". " + questions[i].question);
                    var pasteItem = checkList("sortable-row", li);
                    if (pasteItem) {
                        $("#sortable-row").append(li);
                        $("#sortable-row").sortable('refresh');
                    }
                });
                createCkeditor();
            });
            function checkList(listName, newItem) {
                let duplicate = false;
                $("#" + listName + " > li").each(function () {
                    if ($(this)[0] !== newItem[0]) {
                        if ($(this).attr('id') == newItem.attr('id')) {
                            duplicate = true;
                        }
                    }
                });
                return !duplicate;
            }
            $(document).on('click', '.remove-row', function (e) {
                e.preventDefault();
                $(this).closest('li').remove();
                $("#sortable-row").sortable('refresh');
            });
        </script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var type = 'main-category';
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
                        $('#filter_category option').each(function() {
                            if ($(this).data('is-premium') == 1) {
                                $(this).hide().remove()
                            }
                        });
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
                        $('#filter_subcategory option').each(function() {
                            if ($(this).data('is-premium') == 1) {
                                $(this).hide().remove()
                            }
                        });
                    }
                });
            });

        </script>       
        <script>
            $('#filter_btn').on('click', function (e) {
                $('#question_list').bootstrapTable('refresh');
            });

            function queryParams_1(p) {
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
